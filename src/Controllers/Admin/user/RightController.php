<?php

namespace XRA\LU\Controllers\Admin\user;

use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use App\Http\Controllers\Controller;
use XRA\Extend\Traits\CrudSimpleTrait as CrudTrait;
use XRA\Extend\Traits\ArtisanTrait;

//------models------
use \XRA\LU\Models\PermUser;

class RightController extends Controller{
    use CrudTrait;
}