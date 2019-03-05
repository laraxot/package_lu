<?php
namespace XRA\LU\Controllers\Admin\LU\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//--- services
use XRA\Extend\Services\ThemeService;
//--- traits
use XRA\Extend\Traits\ArtisanTrait;
use XRA\Extend\Traits\CrudBindTrait as CrudTrait;
//------models-------
use XRA\LU\Models\Group;
use XRA\LU\Models\User;

//use blueimp\jquery-file-upload\UploadHandler;

class GroupController extends Controller
{
    use CrudTrait;

    //-------------------------
    public function getModel()
    {
        return new Group();
    }

    //end getModel

    public function getPrimaryKey()
    {
        return 'id_group';
    }

    //end getPrimaryKey
    /*
    public function index(Request $request){
        if ($request->act=='routelist') {
            return ArtisanTrait::exe('route:list');
        }
        return view('lu::index');
    }
    */
    //---------------------------------
    public function filter(Request $request)
    {
        $data = $request->all();
        //echo '<pre>';print_r($data);echo '</pre>';
        if ('' != $request->_method) {
            return $this->do_search($data);
        }

        return view('lu::user.search');
    }

    //end search
    //------------------------------------------------------------------------
    public function do_search($data)
    {
        //echo '<h3>do_search</h3>';
        $rows = $this->getModel();
        \extract($data);
        if (isset($handle) && '' != $handle) {
            $rows = $rows->where('handle', $handle);
        }
        if (isset($cognome) && '' != $cognome) {
            $rows = $rows->where('cognome', $cognome);
        }
        if (isset($nome) && '' != $nome) {
            $rows = $rows->where('nome', $nome);
        }
        $rows = $rows->get();
        //echo '<h3>'.$rows->count().'</h3>';
        return view('lu::user.do_search')->with('rows', $rows);
    }

    //-------------------------------------------------------------------------
    ////-------------------------------------------------------------------------
    /*
    public function index(Request $request){
        if ($request->act=='routelist') {
            return ArtisanTrait::exe('route:list');
        }
        $params = \Route::current()->parameters();
        extract($params);
        $user=User::find($id_user);
        $rows=$user->groups();
        $view=ThemeService::getView();//'lu::admin.user.group.index'
        return view($view)->with('rows', $rows)->with('params', $params);
    }//end index
    */
    //---------------------------------------------------
   public function store(Request $request)
    {
        $ids='groups';
        $data = $request->all();
        \extract($data);
        $params = \Route::current()->parameters();
        \extract($params);

        $items = $user->$ids();
        $items_key = 'group_id';
        $items_0 = $items->get()->pluck($items_key);
        $items_1 = collect($$ids);
        $items_add = $items_1->diff($items_0);
        $items_sub = $items_0->diff($items_1);
        $items->detach($items_sub->all());
        $items->attach($items_add->all());
        $status = 'collegati ['.\implode(', ', $items_add->all()).'] scollegati ['.\implode(', ', $items_sub->all()).']';
        //ddd($status);
        \Session::flash('status', $status);
        return back();
       // return back()->withInput();
    }

    //end update
}
