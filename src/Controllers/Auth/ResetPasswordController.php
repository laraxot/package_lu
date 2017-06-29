<?php

namespace XRA\LU\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

//--------- Models ------------
use XRA\LU\Models\User;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
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
     * Reset the given user's password.
     *
     * @param  \Illuminate\Contracts\Auth\CanResetPassword  $user
     * @param  string  $password
     * @return void
     * in user c'e' la criptazione che cambio solo in quel punto.. per non diventare matto,
     * il campo si chiama passwd non password
     */
    protected function resetPassword($user, $password)
    {
        $user->forceFill([
            //'passwd' => md5($password),
            'passwd' => $password,
            'remember_token' => Str::random(60),
        ])->save();

        $this->guard()->login($user);
    }

    /**
     * Display the password reset view for the given token.
     *
     * If no token is present, display the link request form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string|null  $token
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showResetForm(Request $request, $token = null){
        //qui da fare controllo se esiste pub_theme::auth.passwords.reset mostra quello
        //se no se esiste adm_theme::auth.passwords.reset mostra quello
        //altrimenti mostra 'lu::auth.passwords.reset' che esiste per forza
        $locz=['pub_theme','adm_theme','lu'];
        $tpl='auth.passwords.reset';
        if($request->ajax()){
            $tpl='auth.passwords.ajax_reset';
        }

        foreach($locz as $loc){
            $view=$loc.'::'.$tpl;
            if (\View::exists($view)) {
                return view($view)->with(
                            ['token' => $token, 'email' => $request->email]
                        );
            }
        }
        return '<h3>Non esiste la view ['.$view.']</h3>';
        /*
        return view('lu::auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
        */
    }

}
