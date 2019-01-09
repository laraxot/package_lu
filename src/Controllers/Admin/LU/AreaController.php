<?php

namespace XRA\LU\Controllers\Admin\LU;

use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use App\Http\Controllers\Controller;
use XRA\Extend\Traits\CrudBindTrait as CrudTrait;
//--- services
use XRA\Extend\Services\ThemeService;

//------models------
use \XRA\LU\Models\Area;

class AreaController extends Controller
{
    use CrudTrait{
        index as protected indexTrait;
        edit as protected editTrait;
    }


    public function index(Request $request)
    {
        if ($request->refresh==1) {
            $this->refresh();
        }
        return $this->indexTrait($request);
    }



    public function upload()
    {
        $row = new Area;
        $view = $this->getView();
        return view($view)->with('row', $row)->with('id_dashboard', 1);
    }

    public function postUpload(Request $request)
    {
        $rules = [
            'file_zip' => 'mimes:zip'
        ];
        $messages = [
            'file_zip.mimes' => 'Inserisci un archivio con estensione ".zip".'
        ];

        $validator = \Validator::make($request->file(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        $archive = $request->file('file_zip');
        $zipper = new \Chumper\Zipper\Zipper;
        $zipper->make($archive)->extractTo('../laravel/'.config('xra.package_boss'));
        $zipper->close();

        if ($request->input('active') !== null) {
            $this->activePlugin($archive);
        }
        return view('lu::admin.area.upload')->with('id_dashboard', 1);
    }//end postUpload

    public function activePlugin(Request $request)
    {
        dd($request->all());
    }

    public function refresh()
    {
        $vendors=\XRA\XRA\Packages::allVendors();
        $packs=[];
        foreach ($vendors as $vendor) {
            $tmp=\XRA\XRA\Packages::all($vendor);
            $packs=array_merge($packs, $tmp);
        }
        $packs=collect(array_combine($packs, $packs));
        $areas=Area::all()->pluck('area_define_name', 'area_define_name');
        $add=$packs->diff($areas);
        $sub=$areas->diff($packs);
        //ddd($add);
        $this->addAreas($add);
        $this->subAreas($add);
    }

    public function addAreas($add)
    {
        foreach ($add as $k=>$v) {
            $tmp= preg_replace('/([A-Z]+)/', '_$1', $v);
            $tmp=strtolower($tmp);
            $tmp=substr($tmp, 1);
            $row=Area::firstOrCreate(['area_define_name'=>$v], ['url'=>$tmp]);
            echo '<br/>Add : ['.$row->area_id.']'.$row->area_define_name.' : '.$area->url;
            //ddd($row);
        }
    }

    public function subAreas($sub)
    {
        foreach ($sub as $k=>$v) {
            Area::where('area_define_name', $v)->delete();
        }
    }


    public function sync()
    {
        $vendors=\XRA\XRA\Packages::allVendors();
        $packs=[];
        foreach ($vendors as $vendor) {
            $tmp=\XRA\XRA\Packages::all($vendor);
            $packs=array_merge($packs, $tmp);
        }
        $packs=collect(array_combine($packs, $packs));
        $areas=Area::all()->pluck('area_define_name', 'area_define_name');
        $add=$packs->diff($areas);
        $sub=$areas->diff($packs);

        $view=ThemeService::getView();

        return view($view)
            ->with('add', $add)
            ->with('sub', $sub)
            ->with('row', $this->getModel())
            ->with('id_dashboard', '1');
    }//end sync

    public function store(Request $request)
    {
        $data=$request->all();
        //echo '<pre>';print_r($data);echo '</pre>';die('['.__LINE__.']['.__FILE__.']');
        extract($data);
        if (isset($add)) {
            reset($add);
            foreach ($add as $k=>$v) {
                $tmp= preg_replace('/([A-Z]+)/', '_$1', $v);
                $tmp=strtolower($tmp);
                $tmp=substr($tmp, 1);
                //echo '<br/>'.$v.' : '.$tmp;

                $row=new Area;
                $row->area_define_name=$v;
                $row->url=$tmp;
                $row->save();
            }
        }

        if (isset($sub)) {
            reset($sub);
            foreach ($sub as $k=>$v) {
                Area::where('area_define_name', $v)->delete();
            }
        }


        	//echo '<pre>';print_r($data);echo '</pre>';die('['.__LINE__.']['.__FILE__.']');
        \Session::flash('status', 'aree aggiornate ');
        return back()->withInput();
    }//end store
//---------------------------------------------------------------
}//end class
