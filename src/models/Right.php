<?php

namespace XRA\LU\Models;

use Illuminate\Database\Eloquent\Model;
use XRA\Extend\Traits\Updater;


class Right extends Model
{
    use Updater;
    //
    protected $connection = 'liveuser_general'; // this will use the specified database conneciton
    protected $table = 'liveuser_rights';
    protected $primaryKey = 'right_id';

}
