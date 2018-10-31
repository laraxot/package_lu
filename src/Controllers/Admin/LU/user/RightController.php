<?php

namespace XRA\LU\Controllers\Admin\LU\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use XRA\Extend\Traits\CrudBindTrait as CrudTrait;

//------models------
use \XRA\LU\Models\PermUser;
use \XRA\LU\Models\Right;

class RightController extends Controller{
    use CrudTrait;

    public function store(Request $request){
        $data=$request->all();
        $right_id=[];
        extract($data);
        $params = \Route::current()->parameters();
        extract($params);
        //$user=User::find($id_user);
        
        $items=$user->rights();

        $items_key='right_id';
        $items_0=$items->get()->pluck($items_key);
        $items_1=collect($right_id);
        $items_add=$items_1->diff($items_0);
        $items_sub=$items_0->diff($items_1);
        $items->detach($items_sub->all());
        $items->attach($items_add->all());
        $status='collegati ['.implode(', ',$items_add->all()).'] scollegati ['.implode(', ',$items_sub->all()).']';

        \Session::flash('status', $status);
        return back()->withInput();
    }//end update

}//end controller