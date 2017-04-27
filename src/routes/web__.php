<?php

$middleware=['web','guest'];
$namespace='XRA\LU\Controllers\Auth';


Route::group(['prefix' => null, 'middleware' => $middleware, 'namespace' => $namespace]
, function () {
    Route::get('login', ['as'=>'login','uses'=>'LoginController@showLoginForm'] );
    Route::post('login', ['as'=>null,'uses'=>'LoginController@login'] ); // non serve 'as'
    Route::post('logout', ['as'=>'logout','uses'=>'LoginController@logout'] ); // non serve 'guest'
    Route::post('password/email', ['as'=>'password.email','uses'=>'ForgotPasswordController@sendResetLinkEmail'] ); // non serve 'guest'
    Route::match(array('GET', 'HEAD'),'password/reset',[
    			'as'=>'password.request'
    			,'uses'=>'ForgotPasswordController@showLinkRequestForm'] ); 
    Route::post('password/reset','ResetPasswordController@reset');
    Route::match(array('GET', 'HEAD'),'password/reset/{token}',[
    			'as'=>'password.reset'
    			,'uses'=>'ResetPasswordController@showResetForm'] ); 

    Route::match(array('GET', 'HEAD'),'register',[
    			'as'=>'register'
    			,'uses'=>'RegisterController@showRegistrationForm'] ); 
    Route::post('register','RegisterController@register');

});