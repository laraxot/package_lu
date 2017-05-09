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

public function upload(){
  $row = new Area;
  $view = $this->getView();
  return view($view)->with('row',$row);
}

public function postUpload(Request $request){
  $rules = [
    'file_zip' => 'mimes:zip,rar,tar'
  ];
  $messages = [
    'file_zip.mimes' => 'Inserisci un archivio valido.'
  ];

  $validator = \Validator::make($request->file(), $rules, $messages);
  if($validator->fails()){
    return redirect()->back()->withErrors($validator);
  }
  $archive = $request->file('file_zip');
  $zipper = new \Chumper\Zipper\Zipper;
  $zipper->make($archive)->extractTo('plugin-module');
  $zipper->close();
  return view('lu::admin.area.upload');
}

public function sync(){
	$tmp=config('xra.package_boss').'Packages';
	$packs=$tmp::all();
	$packs[]='LU';
	$packs=collect(array_combine($packs,$packs));
	//$areas=Area::all()->keyBy('area_define_name')->keys();
	$areas=Area::all()->pluck('area_define_name','area_define_name');

  $ew8_id = \XRA\LU\Models\Application::select('application_id')->where('application_define_name', 'Enteweb');

	$add=$packs->diff($areas);
	$sub=$areas->diff($packs);

  // $ordine = 0;
  // foreach ($add as $key => $value) {
  //   $liveuser_area = new Area;
  //   $liveuser_area->area_define_name = $value;
  //   $liveuser_area->application_id = $ew8_id;
  //   $liveuser_area->db = env('DB_DATABASE');
  //   $liveuser_area->img = '.jpg';
  //   $liveuser_area->icons = 'fa fa-pensil';
  //   $liveuser_area->ordine = $ordine;
  //   $ordine += 10;
  //   $liveuser_area->controller_path = 'path';
  //   $liveuser_area->save();
  // }
  $view=CrudTrait::getView();

  return view($view)->with('add',$add)->with('sub',$sub)->with('row',$this->getModel())->with('id_dashboard', '1');
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
