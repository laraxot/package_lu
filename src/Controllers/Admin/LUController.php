<?php



namespace XRA\LU\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use XRA\Extend\Traits\ArtisanTrait;
//-------- Models ----------------
use XRA\Extend\Traits\CrudSimpleTrait as CrudTrait;
use XRA\LU\Models\User;

//use blueimp\jquery-file-upload\UploadHandler;
//https://medium.com/modulr/create-api-authentication-passport-in-laravel-5-6-confirm-account-notifications-part-2-5e221b021f07
//https://m.dotdev.co/understanding-laravel-service-container-bd488ca05280

class LUController extends Controller
{
    use CrudTrait;

    //-------------------------
    public function getModel()
    {
        return new User();
    }

    //end getModel

    public function getPrimaryKey()
    {
        return 'id_individuale';
    }

    //end getPrimaryKey

    public function index(Request $request)
    {
        if ($request->act=='routelist') {
            return ArtisanTrait::exe('route:list');
        }

        return view('lu::admin.index');
    }

    //---------------------------------
}
