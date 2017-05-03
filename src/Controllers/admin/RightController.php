<?php

namespace XRA\LU\Controllers\admin;

use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use App\Http\Controllers\Controller;
use XRA\Extend\Traits\CrudSimpleTrait as CrudTrait;

//------models------
use \XRA\LU\Models\Right;


class RightController extends Controller{
use CrudTrait;
//-------------------------
public function getModel(){
    return new Right;
}//end getModel

public function getPrimaryKey(){
    return 'id_right';
}//end getPrimaryKey

}//end class