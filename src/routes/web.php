<?php
$namespace=$this->getNamespace();
Route::group(
    [
        'namespace'=>$namespace.'\Controllers',
        'middleware'=>['web']
    ],
    function () {
        Auth::routes(['verify' => true]);
    }
);

$middleware=['web','guest'];
Route::group(
    [
        'prefix' => null,
        'middleware' => $middleware,
        'namespace' => $namespace.'\Controllers\Auth',
    ],
    function () {
        //--------- SOCIALITE ----------------
        Route::get('login/{provider}', ['as'=>null,                'uses'=>'LoginController@redirectToProvider']);
        Route::get('login/{provider}/callback', ['as'=>null,                'uses'=>'LoginController@handleProviderCallback']);
    }
);

Route::get('/slack', function () {
    new stoca;
    //$user = \XRA\LU\Models\User::first();
    //$user->notify(new \XRA\LU\Notifications\Newslack());
    //echo "A slack notification has been send";
   // $res=\Log::stack(['suspicious-activity', 'slack'])->info("We're being attacked!");
    //ddd($res);
    //(new \Illuminate\Notifications\Messages\SlackMessage)->content('One of your invoices has been paid!');
    //AdminNotify::send(new \XRA\XRA\Notifications\TestNotification());
    //echo "maybe A slack notification has been send ".\Carbon\Carbon::now();
    //https://medium.com/binary-cabin/laravel-notifications-admin-and-dynamic-recipients-704a21567410
    //\Notification::notify(new \XRA\XRA\Notifications\TestNotification());
    //https://sentry.io/for/laravel/
    //SENTRY_LARAVEL_DSN=https://704699ae52f64863a4a62d9b8472b2b0@sentry.io/1341901
    //https://github.com/freshbitsweb/slack-error-notifier
    //https://github.com/gpressutto5/laravel-slack
    //https://laravel-news.com/email-on-error-exceptions
});

$this->routes();
