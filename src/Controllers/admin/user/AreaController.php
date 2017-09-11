<?php

namespace XRA\LU\Controllers\admin\user;

use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use App\Http\Controllers\Controller;
use XRA\Extend\Traits\CrudSimpleTrait as CrudTrait;
use XRA\Extend\Traits\ArtisanTrait;

//--- models ---
use XRA\LU\Models\AreaAdminArea;
use XRA\LU\Models\Area;
use XRA\LU\Models\User;

//use blueimp\jquery-file-upload\UploadHandler;

class AreaController extends Controller
{
    use CrudTrait;
    //-------------------------
    public function getModel()
    {
        return new AreaAdminArea;
    }//end getModel

    public function getPrimaryKey()
    {
        return 'id_area';
    }//end getPrimaryKey

    //---------------------------------
    public function search(Request $request)
    {
        $data=$request->all();
        //echo '<pre>';print_r($data);echo '</pre>';
        if ($request->_method!='') {
            return $this->do_search($data);
        }
        return view('lu::user.search');
    }//end search
    //------------------------------------------------------------------------
    public function do_search($data)
    {
        //echo '<h3>do_search</h3>';
        $rows=$this->getModel();
        extract($data);
        if (isset($handle) && $handle!='') {
            $rows=$rows->where('handle', $handle);
        }
        if (isset($cognome) && $cognome!='') {
            $rows=$rows->where('cognome', $cognome);
        }
        if (isset($nome) && $nome!='') {
            $rows=$rows->where('nome', $nome);
        }
        $rows=$rows->get();
        //echo '<h3>'.$rows->count().'</h3>';
        return view('lu::user.do_search')->with('rows', $rows);
    }

    //-------------------------------------------------------------------------
    public function index(Request $request){
        if ($request->routelist==1) {
            return ArtisanTrait::exe('route:list');
        }
        $params = \Route::current()->parameters();
        extract($params);
        $user=User::find($id_user);
        $rows=$user->areas();
        $view=CrudTrait::getView();//'lu::admin.user.area.index'
        return view($view)->with('rows', $rows)->with('params', $params);
    }//end index

    //---------------------------------------------------------------------------
    public function update(Request $request)
    {
        die('['.__LINE__.']['.__FILE__.']');
    }//end update
     
    public function store(Request $request){
        $data=$request->all();
        extract($data);
        $params = \Route::current()->parameters();
        extract($params);
        $user=User::find($id_user);
        $areas_0=$user->areas()->get()->pluck('area_id');
        $areas_1=collect($area_id);
        $areas_add=$areas_1->diff($areas_0);
        $areas_sub=$areas_0->diff($areas_1);
        $user->areas()->detach($areas_sub->all());
        $user->areas()->attach($areas_add->all());
        $status='aree aggiunte ['.implode(', ',$areas_add->all()).'] aree tolte ['.implode(', ',$areas_sub->all()).']';
        \Session::flash('status', $status);
        return back()->withInput();
    }//end update
}//end class
