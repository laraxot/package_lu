<?php


namespace XRA\LU\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
//--------- Models ------------
use XRA\LU\Models\User;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            //'name' => 'required|max:255',
            'handle' => 'required|max:255',
            'email' => 'required|email|max:255', // |unique:users
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     *
     * @return User
     */
    protected function create(array $data)
    {
        if (!isset($data['handle'])) {
            $data['handle'] = $data['username']; //molti template precotti hanno username.. se non hanno neppure questo meglio avere errore
        }
        $user = User::create([
            //'name' => $data['name'],
            'handle' => $data['handle'],
            'email' => $data['email'],
            //'passwd' => md5($data['password']),
            'passwd' => $data['password'], //lo facciamo con il setattribute
            //'password' => bcrypt($data['password']),
        ]);

        //http://stackoverflow.com/questions/33562285/how-can-i-use-md5-hashing-for-passwords-in-laravel
        // email the user
        /*
        Mail::send('emails.register', ['user' => $user], function($message) use ($user)
        {
           $message->to($user->email, $user->name)->subject('Edexus - Welcome');
        });

        // email the admin
        Mail::send('emails.register-admin', ['user' => $user], function($message) use ($user)
        {
           $message->to('admins@***.com', 'Edexus')->subject('Edexus - New user sign up');
        });
        */
        return $user;
    }

    //---------------------------------------------------------------------------------------
    public function showRegistrationForm(Request $request)
    {
        $params = \Route::current()->parameters();
        $row = new User();
        $locz = ['pub_theme', 'adm_theme', 'lu'];
        $tpl = 'auth.register';
        if ($request->ajax()) {
            $tpl = 'auth.ajax_register';
        }

        foreach ($locz as $loc) {
            $view = $loc . '::' . $tpl;

            if (\View::exists($view)) {
                return view($view, ['action' => 'register'])
                    ->with('params', $params)
                    ->with('lang', \App::getLocale())
                    ->with('view', $view)
                    ->with('row', $row);
            }
        }

        return '<h3>Non esiste la view [' . $view . ']</h3>';
    }

    //--------------------------------------------------------------------------------

    /**
     * Handle a registration request for the application.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        /*
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
        */
        $data = $request->all();

        $rules = [
            //    'username' => 'required|alpha_num|min:3|max:32',
            'email' => 'required|email',
            'password' => 'required|min:3|confirmed',
            'password_confirmation' => 'required|min:3',
        ];

        // Create a new validator instance.
        $validator = Validator::make($data, $rules);
        $errors = $validator->errors();
        $msg = '';
        foreach ($errors->all() as $message) {
            $msg .= '<br/>' . $message;
        }
        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(['error' => $msg], 500);
            }

            return back()
                ->withError('Qualcosa di errato !')
                ->withInput($request->all())
                ->withErrors($validator->messages());
        }
        $user = $this->create($request->all());
        event(new Registered($user));
        $this->guard()->login($user);
        if ($request->ajax()) {
            return response()->json(['redirect' => $this->redirectPath(), 'msg' => 'registrato con successo']);
        }

        return redirect($this->redirectPath());
    }
}//end class
