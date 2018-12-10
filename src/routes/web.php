<?php
/*
+--------+----------+------------------------+------------------+------------------------------------------------------------------------+--------------+
| Domain | Method   | URI                    | Name             | Action                                                                 | Middleware   |
+--------+----------+------------------------+------------------+------------------------------------------------------------------------+--------------+
|        | GET|HEAD | login                  | login            | App\Http\Controllers\Auth\LoginController@showLoginForm                | web,guest    |
|        | POST     | login                  |                  | App\Http\Controllers\Auth\LoginController@login                        | web,guest    |
|        | POST     | password/email         | password.email   | App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail  | web,guest    |
|        | GET|HEAD | password/reset         | password.request | App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm | web,guest    |
|        | POST     | password/reset         |                  | App\Http\Controllers\Auth\ResetPasswordController@reset                | web,guest    |
|        | GET|HEAD | password/reset/{token} | password.reset   | App\Http\Controllers\Auth\ResetPasswordController@showResetForm        | web,guest    |
|        | GET|HEAD | register               | register         | App\Http\Controllers\Auth\RegisterController@showRegistrationForm      | web,guest    |
|        | POST     | register               |                  | App\Http\Controllers\Auth\RegisterController@register                  | web,guest    |
|        | POST     | logout                 | logout           | App\Http\Controllers\Auth\LoginController@logout                       | web          |
+--------+----------+------------------------+------------------+------------------------------------------------------------------------+--------------+
*/

//='XRA\LU\Controllers\Auth';
$namespace=$this->getNamespace();
$middleware=['web','guest'];
Route::group(
    [
        'prefix' => null, 
        'middleware' => $middleware, 
        'namespace' => $namespace.'\Controllers\Auth',
    ], 
    function () {
        Route::match(array('GET', 'HEAD'),  'login',                    ['as'=>'login',             'uses'=>'LoginController@showLoginForm']);
        Route::post(                        'login',                    ['as'=>null,                'uses'=>'LoginController@login']); // non serve 'as'
        Route::post(                        'password/email',           ['as'=>'password.email',    'uses'=>'ForgotPasswordController@sendResetLinkEmail']);
        Route::match(array('GET', 'HEAD'),  'password/reset',           ['as'=>'password.request',  'uses'=>'ForgotPasswordController@showLinkRequestForm']);
        Route::post(                        'password/reset',           ['as'=>null,                'uses'=>'ResetPasswordController@reset']);
        Route::match(array('GET', 'HEAD'),  'password/reset/{token}',   ['as'=>'password.reset',    'uses'=>'ResetPasswordController@showResetForm']);
        Route::match(array('GET', 'HEAD'),  'register',                 ['as'=>'register',          'uses'=>'RegisterController@showRegistrationForm']);
        Route::post(                        'register',                 ['as'=>null,                'uses'=>'RegisterController@register']);
        //--------- SOCIALITE ----------------
        Route::get(                         'login/{provider}',         ['as'=>null,                'uses'=>'LoginController@redirectToProvider']);
        Route::get(                         'login/{provider}/callback',['as'=>null,                'uses'=>'LoginController@handleProviderCallback']);
    }
);

$middleware=['web'];
Route::group(
    [
        'prefix' => null, 
        'middleware' => $middleware, 
        'namespace' => $namespace.'\Controllers\Auth',
    ], 
    function () {
       Route::post(                         'logout',                   ['as'=>'logout',            'uses'=>'LoginController@logout']);
       Route::get(                          'logout',                   ['as'=>'logout',            'uses'=>'LoginController@logout']); //test ?
    }
);

$middleware=['web','auth'];
Route::group(
    [
        'prefix' => null, 
        'middleware' => $middleware, 
        'namespace' => $namespace.'\Controllers\Auth',
    ], 
    function () {
        Route::match(array('GET', 'HEAD'), 'email/resend',                  ['as'=>'verification.resend',          'uses'=>'VerificationController@resend']);
        Route::match(array('GET', 'HEAD'), 'email/verify',                  ['as'=>'verification.notice',          'uses'=>'VerificationController@show']);
        Route::match(array('GET', 'HEAD'), 'email/verify/{id}',             ['as'=>'verification.verify',          'uses'=>'VerificationController@verify']);
    }
);




$this->routes();
