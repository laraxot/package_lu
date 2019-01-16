<?php



namespace XRA\LU\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use XRA\Extend\Traits\Updater;

class GroupRight extends Model
{
    use Searchable;
    use Updater;

    protected $connection = 'liveuser_general'; // this will use the specified database conneciton
    protected $table = 'liveuser_grouprights';
    protected $primaryKey = ['group_id', 'right_id'];
}
