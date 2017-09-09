<?php

namespace XRA\LU\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use XRA\Extend\Traits\Updater;

class Right extends Model
{
    use Searchable;
    use Updater;
    protected $connection = 'liveuser_general'; // this will use the specified database conneciton
    protected $table = 'liveuser_rights';
    protected $primaryKey = 'right_id';

    public static function filter($params)
    {
        $rows=new self;
        return $rows;
    }
}
