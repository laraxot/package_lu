<?php

namespace XRA\LU\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use XRA\Extend\Traits\Updater;

class UserRight extends Model{
    use Updater;
    use Searchable;
    //
    protected $connection = 'liveuser_general'; // this will use the specified database conneciton
    protected $table = 'liveuser_userrights';
    //protected $primaryKey = ['perm_user_id','right_id'];
    protected $primaryKey = 'right_id'; //array da errore su hasManyThrough

}
