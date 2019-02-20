<?php
namespace XRA\LU\Controllers\Admin\LU\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use XRA\Extend\Traits\CrudBindTrait as CrudTrait;

//------models------
use XRA\LU\Models\Right;

class RightController extends Controller
{
    use CrudTrait;

    public function store(Request $request)
    {
        $ids='rights';
        $data = $request->all();
        \extract($data);
        $params = \Route::current()->parameters();
        \extract($params);

        $items = $user->$ids();
        $items_key = 'right_id';
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
}//end controller
