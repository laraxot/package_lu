<?php



namespace XRA\LU\Controllers\Admin\LU\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use XRA\Extend\Traits\CrudBindTrait as CrudTrait;

//------models------

class PermUserController extends Controller
{
    use CrudTrait;

    public function store(Request $request)
    {
        $data = $request->all();
        $group_id = [];
        \extract($data);
        $params = \Route::current()->parameters();
        //dd($request->all());
        \extract($params);
        $user->perm->perm_type = $request->perm_type;
        $user->perm->save();
        $status = 'Aggiornato Livello';
        \Session::flash('status', $status);

        return back()->withInput();
    }

    //end store
}//end controller
