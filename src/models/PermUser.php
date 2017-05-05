<?php

namespace XRA\LU\Models;

use Illuminate\Database\Eloquent\Model;

class PermUser extends Model {
    protected $connection = 'liveuser_general'; // this will use the specified database conneciton
    protected $table = 'liveuser_perm_users';
    protected $primaryKey = 'perm_user_id';
    protected $fillable = ['auth_user_id'];

    public function User(){
        return $this->hasOne('User','auth_user_id','auth_user_id');
    }

    public function areaAdminAreas() {
        //return $this->hasMany('App\Comment', 'foreign_key', 'local_key');
        return $this->hasMany('AreaAdminArea', 'perm_user_id', 'perm_user_id');
    }

    public function groupUsers() {
        //die('['.__LINE__.']['.__FILE__.']');
        return $this->hasMany('GroupUser', 'perm_user_id', 'perm_user_id');
    }

}//end class PermUsers
