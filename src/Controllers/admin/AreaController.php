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
	$tmp=config('xra.package_boss').'Packages';
	$packs=$tmp::all();
	$packs[]='LU';
	$packs=collect(array_combine($packs,$packs));
	//$areas=Area::all()->keyBy('area_define_name')->keys();
	$areas=Area::all()->pluck('area_define_name','area_define_name');
	//dd($packs);

	$add=$packs->diff($areas);
	$sub=$areas->diff($packs);

    $view=CrudTrait::getView();
    return view($view)->with('add',$add)->with('sub',$sub)->with('row',$this->getModel());
}

public function store(Request $request){
	$data=$request->all();
	//echo '<pre>';print_r($data);echo '</pre>';die('['.__LINE__.']['.__FILE__.']');
	extract($data);
	if(isset($add)){
		reset($add);
		while(list($k,$v)=each($add)){
			$tmp= preg_replace('/([A-Z]+)/','_$1', $v);
			$tmp=strtolower($tmp);
			$tmp=substr($tmp,1);
			//echo '<br/>'.$v.' : '.$tmp;
		
			$row=new Area;
			$row->area_define_name=$v;
			$row->url=$tmp;
			$row->save();
		}
	}

	if(isset($sub)){
		reset($sub);
		while(list($k,$v)=each($sub)){
			Area::where('area_define_name',$v)->delete();
		}
	}


	//	echo '<pre>';print_r($data);echo '</pre>';die('['.__LINE__.']['.__FILE__.']');
	\Session::flash('status','aree aggiornate ');
	return back()->withInput();
}




}//end class