<?php
namespace XRA\LU;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;
use XRA\Extend\Traits\ServiceProviderTrait;
use Illuminate\Support\Facades\Blade;

//----- models ------
use XRA\LU\Models\Group;
use XRA\LU\Models\Right;
use XRA\LU\Models\Area;
use XRA\LU\Models\User;
use XRA\LU\Models\PermUser;

class LUServiceProvider extends ServiceProvider{
	
	use ServiceProviderTrait{
		boot as protected bootTrait;
	}

	public function boot(\Illuminate\Routing\Router $router){
		//--------- ROUTE BIND
		$router->bind('area', function ($value) {
			//return (new ProductRepository)->find($product_id);
			//https://laracasts.com/series/laravel-5-fundamentals/episodes/13
			return Area::where('area_id', $value)->first() ?? abort(404);
		});
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


		//----------- BLADE 
		Blade::if('admin', function () {
			if(!auth()->check()) return false;
			return auth()->user()->perm_type>=4;
		});
		Blade::if('editor',function ($row){
			//return auth()->user()->handle==$row->created_by;
			if(!auth()->check()) return false;
			return auth()->user()->handle==$row->created_by || auth()->user()->perm_type>=4;
		});
		Blade::if('userLevel',function ($level){
			//return auth()->user()->handle==$row->created_by;
			if(!auth()->check()) return false;
			return auth()->user()->perm_type>=$level;
		});
		

		$this->bootTrait($router);
	}


	public static function groups(){
		$rows=new Group;
		return $rows->all();
	}
}
