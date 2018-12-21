<?php

namespace XRA\LU\Controllers\Admin;

use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use App\Http\Controllers\Controller;


use XRA\Extend\Traits\CrudSimpleTrait as CrudTrait;

//-------- Models ----------------
use XRA\LU\Models\User;
use XRA\Extend\Traits\ArtisanTrait;

//use blueimp\jquery-file-upload\UploadHandler;
//https://medium.com/modulr/create-api-authentication-passport-in-laravel-5-6-confirm-account-notifications-part-2-5e221b021f07
//https://m.dotdev.co/understanding-laravel-service-container-bd488ca05280

class LUController extends Controller
{
    use CrudTrait;
    //-------------------------
    public function getModel()
    {
        return new User;
    }//end getModel

    public function getPrimaryKey()
    {
        return 'id_individuale';
    }//end getPrimaryKey

    public function index(Request $request)
    {
        if ($request->routelist==1) {
            return ArtisanTrait::exe('route:list');
        }
        return view('lu::admin.index');
    }
    //---------------------------------
}
