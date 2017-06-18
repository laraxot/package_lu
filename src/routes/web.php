<?php
//--- logout ovunque ma ha senso solo se sei dentro --
$middleware= ['web','auth'];
$namespace='XRA\LU\Controllers\Auth';
Route::group(['prefix' => null, 'middleware' => $middleware, 'namespace' => $namespace]
, function () {
    Route::post('logout', ['as'=>'logout','uses'=>'LoginController@logout'] ); // non serve 'guest'
});

$middleware=['web','guest'];
Route::group(['prefix' => null, 'middleware' => $middleware, 'namespace' => $namespace]
, function () {
	Route::match(array('GET', 'HEAD'),'register',[
    			'as'=>'register'
    			,'uses'=>'RegisterController@showRegistrationForm'] ); 
    Route::post('register','RegisterController@register');
    Route::get('login', ['as'=>'login','uses'=>'LoginController@showLoginForm'] );
    // POST     | password/email         | password.email   | App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail  | web,guest  
    Route::post('password/email',['as'=>'password.email','uses'=>'ForgotPasswordController@sendResetLinkEmail']);


});


$this->routes();
