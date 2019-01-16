<?php



namespace XRA\LU\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//--- services
use XRA\Extend\Services\ThemeService;

//--models---
//use XRA\LU\Models\User;

class MyProfileController extends Controller
{
    public function index(Request $request)
    {
        $view = ThemeService::getView();

        return view($view);
    }
}//end class
