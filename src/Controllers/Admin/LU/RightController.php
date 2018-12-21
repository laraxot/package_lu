<?php

namespace XRA\LU\Controllers\Admin\LU;

use App\Http\Controllers\Controller;
use XRA\Extend\Traits\CrudSimpleTrait as CrudTrait;
use XRA\LU\Models\Right;

class RightController extends Controller
{
    use CrudTrait;
    /*
    public function getModel()
    {
        return new Right;
    }

    public function getPrimaryKey()
    {
        return 'id_right';
    }*/
}
