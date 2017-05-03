<?php

namespace XRA\LU\Controllers\admin;

use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use App\Http\Controllers\Controller;
use XRA\Extend\Traits\CrudSimpleTrait as CrudTrait;

//------models------
use \XRA\LU\Models\Area;


class AreaController extends Controller{
use CrudTrait;
//-------------------------
public function getModel(){
    return new Area;
}//end getModel

public function getPrimaryKey(){
    return 'id_area';
}//end getPrimaryKey

public function sync(){
	$namespace='\Xot\Ptv\\Packages';
	$packs=$namespace::all();
	$packs[]='LU';
	$packs=collect($packs);
	$areas=Area::all()->keyBy('area_define_name')->keys();

	$add=$packs->diff($areas);
	$sub=$areas->diff($packs);

    $view=CrudTrait::getView();
    return view($view)->with('add',$add)->with('sub',$sub);


}

}//end class