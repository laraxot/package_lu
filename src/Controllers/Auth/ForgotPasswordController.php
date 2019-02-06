<?php
namespace XRA\LU\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;

//use XRA\Extend\Services\ThemeService; //mi serviva per debug

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLinkRequestForm(Request $request)
    {
        //return ThemeService::getView(); //lu::auth.forgot_password.show_link_request_form
        //return view('lu::auth.passwords.email');
        $lang=\App::getLocale();
        $locz = ['pub_theme', 'adm_theme', 'lu'];
        $tpl = 'auth.passwords.email';
        if ($request->ajax()) {
            $tpl = 'auth.passwords.ajax_email';
        }

        foreach ($locz as $loc) {
            $view = $loc.'::'.$tpl;
            if (\View::exists($view)) {
                return view($view)->with('lang',$lang)->with('title','Reset Password');
            }
        }

        return '<h3>Non esiste la view ['.$view.']</h3>';
    }
}
