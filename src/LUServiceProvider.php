<?php



namespace XRA\LU;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use XRA\Extend\Traits\ServiceProviderTrait;
//----- models ------
use XRA\LU\Models\Area;
use XRA\LU\Models\Group;
use XRA\LU\Models\PermUser;
use XRA\LU\Models\Right;
use XRA\LU\Models\User;

class LUServiceProvider extends ServiceProvider
{
    use ServiceProviderTrait{
        boot as protected bootTrait;
    }
    
    public function registerRoutePattern(\Illuminate\Routing\Router $router){
    }

    public function registerRouteBind(\Illuminate\Routing\Router $router){
        //--------- ROUTE BIND
        $router->bind('area', function ($value) {
            //return (new ProductRepository)->find($product_id);
            //https://laracasts.com/series/laravel-5-fundamentals/episodes/13
            return Area::where('area_id', $value)->first() ?? abort(404);
        });
        $router->pattern('user', '[0-9]+');
        $router->bind('user', function ($value) {
            return User::find($value) ?? abort(404);
        });
        $router->bind('group', function ($value) {
            return Group::find($value) ?? abort(404);
        });
        $router->bind('right', function ($value) {
            return Right::find($value) ?? abort(404);
        });
        $router->bind('permuser', function ($value) {
            return PermUser::find($value) ?? abort(404);
        });
        //--- to do --
        //permuser
    }

    public function registerBladeDirective(){
         //----------- BLADE
        Blade::if('admin', function () {
            if (!auth()->check()) {
                return false;
            }

            return auth()->user()->perm_type >= 4;
        });
        Blade::if('editor', function ($row) {
            //return auth()->user()->handle==$row->created_by;
            if (!auth()->check()) {
                return false;
            }

            return auth()->user()->handle == $row->created_by || auth()->user()->perm_type >= 4;
        });
        Blade::if('userLevel', function ($level) {
            //return auth()->user()->handle==$row->created_by;
            if (!auth()->check()) {
                return false;
            }

            return auth()->user()->perm_type >= $level;
        });
    }

    public function boot(\Illuminate\Routing\Router $router)
    {
        $this->registerRoutePattern($router);
        $this->registerRouteBind($router);
        $this->registerBladeDirective();
        \Event::listen(\XRA\LU\Events\TestEvent::class, \XRA\LU\Listeners\TestListener::class);
        $this->bootTrait($router);
    }
    /*
    public function register(){
        //https://stackoverflow.com/questions/51604666/listen-to-an-event-in-a-package-of-laravel-5-3
        $this->app->register(EventServiceProvider::class);
    }
    */

    public static function groups()
    {
        $rows = new Group();

        return $rows->all();
    }
}
