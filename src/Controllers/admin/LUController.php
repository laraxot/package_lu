<?php

namespace XRA\LU\Controllers\admin;

use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use App\Http\Controllers\Controller;


use XRA\Extend\Traits\CrudSimpleTrait as CrudTrait;

//-------- Models ----------------
use XRA\LU\Models\User;
use XRA\Backend\Controllers\ArtisanController;

//use blueimp\jquery-file-upload\UploadHandler;

class LUController extends Controller{
use CrudTrait;
//-------------------------
public function getModel(){
    return new User;
}//end getModel

public function getPrimaryKey(){
    return 'id_individuale';
}//end getPrimaryKey

public function index(Request $request){
	if($request->routelist==1){
        return app(ArtisanController::class)->exe('route:list');
    }
    return view('lu::admin.index');
}
//---------------------------------
  
}
