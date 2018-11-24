<?php

namespace XRA\LU\Controllers\Admin\LU\User;

use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use App\Http\Controllers\Controller;
use XRA\Extend\Traits\CrudBindTrait as CrudTrait;
use XRA\Extend\Traits\ArtisanTrait;

//------models------
use \XRA\LU\Models\PermUser;

class PermUserController extends Controller{
    use CrudTrait;
    public function store(Request $request){
        $data=$request->all();
        $group_id=[];
        extract($data);
        $params = \Route::current()->parameters();
        //dd($request->all());
        extract($params);
        $user->perm->perm_type=$request->perm_type;
        $user->perm->save();
        $status='Aggiornato Livello';
        \Session::flash('status', $status);
        return back()->withInput();
    }//end store
}//end controller