<?php

namespace XRA\LU\Controllers\Admin;

use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use App\Http\Controllers\Controller;
use XRA\Extend\Traits\CrudSimpleTrait as CrudTrait;

//------models------
use \XRA\LU\Models\Area;

class AreaController extends Controller
{
    use CrudTrait;

    public function getModel()
    {
        return new Area;
    }

    public function getPrimaryKey()
    {
        return 'id_area';
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

    public function sync()
    {
        $vendors=\XRA\XRA\Packages::allVendors();
        $packs=[];
        foreach ($vendors as $vendor) {
            $tmp=\XRA\XRA\Packages::all($vendor);
            $packs=array_merge($packs, $tmp);
        }
        /*
        dd($tmp);
        $packs=$tmp::all();
        //$packs[]='LU';
        $xra_packs=\XRA\XRA\Packages::all();
        $packs=array_merge($packs,$xra_packs);
        //dd($tmp1);


        */
    
        $packs=collect(array_combine($packs, $packs));
        //dd($packs);
        $areas=Area::all()->pluck('area_define_name', 'area_define_name');
        $add=$packs->diff($areas);
        $sub=$areas->diff($packs);

        $view=CrudTrait::getView();

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
            //while (list($k, $v)=each($add)) {
            foreach($add as $k=>$v) {
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
            //while (list($k, $v)=each($sub)) {
            foreach($sub as $k=>$v) {
                Area::where('area_define_name', $v)->delete();
            }
        }


        //	echo '<pre>';print_r($data);echo '</pre>';die('['.__LINE__.']['.__FILE__.']');
        \Session::flash('status', 'aree aggiornate ');
        return back()->withInput();
    }//end store
//---------------------------------------------------------------
}//end class