<?php

namespace XRA\LU\Controllers\admin;

use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use App\Http\Controllers\Controller;
use XRA\Extend\Traits\CrudSimpleTrait as CrudTrait;

//------models------
use \XRA\LU\Models\PermUser;
class PermUserController extends Controller
{
    use CrudTrait;

    public function index(Request $request, $user_id){
      if ($request->routelist == 1) {
          return app(\XRA\Backend\Controllers\Admin\ArtisanController::class)->exe('route:list');
      }
      $tmp = new PermUser;
      $perm_user = PermUser::where('auth_user_id', $user_id)->first();
      $params = [
    		'id_user' => $user_id,
    		'id_permuser' => $perm_user->perm_user_id
    	];
      return view('lu::admin.user.permuser.index')
      ->with('row', $perm_user)
      ->with('params', $params);
    }

    public function getPrimaryKey(){
        return 'id_permuser';
    }
}