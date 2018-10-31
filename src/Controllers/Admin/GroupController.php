<?php

namespace XRA\LU\Controllers\Admin;

use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use App\Http\Controllers\Controller;
use XRA\Extend\Traits\CrudSimpleTrait as CrudTrait;

//------models------
use \XRA\LU\Models\Group;

class GroupController extends Controller
{
    use CrudTrait;
    //-------------------------
    /*
    public function getModel()
    {
        return new Group;
    }//end getModel

    public function getPrimaryKey()
    {
        return 'id_group';
    }//end getPrimaryKey
    */
}//end class
