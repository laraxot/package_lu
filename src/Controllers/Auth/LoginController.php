<?php

namespace XRA\LU\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

use Auth;
//use App\Http\Requests;
use XRA\LU\Models\User;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin'; // /home

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

     public function username(){
        //die('['.__LINE__.']['.__FILE__.']');
        return 'handle';
    }

    //--------------------
    public function password(){
        //die('['.__LINE__.']['.__FILE__.']');
        return 'passwd';
    }

    //public function authenticate(){ non viene chiamato
    //    die('['.__LINE__.']['.__FILE__.']');
    //}

    public function login(Request $request){
        //nel FORM : USERNAME,EMAIL E PASSWORD
        $data=$request->all();
        //$user=new User;
        $username_field=$this->username(); 
        //dd($data);
        if(isset($data['ente']) && isset($data['matr'])){
            $data['username']=$data['ente'].'-'.$data['matr'];
        }
        /*
        if (Auth::attempt(['handle' => $data['username'], 'passwo1rd' => $data['password'] ])) {
            return 'SI';
        }else{
            return 'NO';
        }
        //*/

        //dd($data);
        if(isset($data['username'])){
            $user = User::where($username_field, $data['username'])->first();
        }
        if(isset($data['email'])){
            $user = User::where('email', $data['email'])->first();
        }
        if(isset($data['user_email'])){
            $user = User::where('email', $data['user_email'])->first();
        }
        

        if ($user && $user->passwd == md5($data['password']) ){
            //dd($user);
            Auth::login($user,$request->has('remember'));
            $auth = Auth::loginUsingId($user->auth_user_id, $request->has('remember'));
            //return redirect()->intended('/admin');
            return redirect()->intended($this->redirectPath());
        }else{
            return redirect()->guest('login')
                ->withError('Qualcosa di errato !')
                ->withInput($request->all())
                ->withErrors([
                    'password' => 'user o password sbagliati',
                ]);
        }
    }



    /*
        funzione aggiuntiva per permettere l'invio della risposta json
        alla richiesta ajax di login, perchè di default laravel non
        ritorna dati alle chiamate ajax
    */
    protected function sendFailedLoginResponse(\Illuminate\Http\Request $request)
    {
        if ($request->ajax()) {
            return response()->json([
                'error' => "auth.failed"
            ], 401);
        }

        return redirect()->back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors([
                $this->username() => "auth.failed",
            ]);
    }
//------------------

}
