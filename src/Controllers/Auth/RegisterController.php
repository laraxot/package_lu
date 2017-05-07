<?php

namespace XRA\LU\Controllers\Auth;



use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

//--------- Models ------------
use Xot\LU\Models\User;


class RegisterController extends Controller{
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
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
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
     * @param  array  $data
     * @return User
     */
    protected function create(array $data){
        $user= User::create([
            //'name' => $data['name'],
            'handle' => $data['handle'],
            'email' => $data['email'],
            //'passwd' => md5($data['password']),
            'passwd' => ($data['password']),
            //'password' => bcrypt($data['password']),
        ]);

        //http://stackoverflow.com/questions/33562285/how-can-i-use-md5-hashing-for-passwords-in-laravel
 // email the user
        Mail::send('emails.register', ['user' => $user], function($message) use ($user)
        {
            $message->to($user->email, $user->name)->subject('Edexus - Welcome');
        });

        // email the admin
        Mail::send('emails.register-admin', ['user' => $user], function($message) use ($user)
        {
            $message->to('admins@***.com', 'Edexus')->subject('Edexus - New user sign up');
        });

        return $user;




    }
//--------------------------    
}//end class
