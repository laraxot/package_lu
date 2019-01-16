<?php



namespace XRA\LU\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use XRA\Extend\Traits\Updater;

class PasswordReset extends Model
{
    use Searchable;
    use Updater;
    protected $connection = 'liveuser_general'; // this will use the specified database conneciton
    protected $table = 'password_resets';
    /* protected $primaryKey = ['perm_user_id','group_id'];*/ //questo da errore al toArray
//--------------------------------------------------

//----------------------------------------
//----------------------------------------
}//end class GroupUser
