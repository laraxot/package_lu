<?php
//--- logout ovunque ma ha senso solo se sei dentro --
$middleware= ['web','auth'];
$namespace='XRA\LU\Controllers\Auth';
Route::group(['prefix' => null, 'middleware' => $middleware, 'namespace' => $namespace]
, function () {
    Route::post('logout', ['as'=>'logout','uses'=>'LoginController@logout'] ); // non serve 'guest'
});

$this->routes();
