<?php

namespace XRA\LU\Controllers;



use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use App\Http\Controllers\Controller;

use XRA\Extend\Traits\CrudSimpleTrait as CrudTrait;
//--models---
//use XRA\LU\Models\User;

class MyProfileController extends Controller{

	public function index(Request $request){
		$view=CrudTrait::getView();
		return view($view);
	}

}//end class