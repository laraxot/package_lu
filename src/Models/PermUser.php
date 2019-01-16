<?php



namespace XRA\LU\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use XRA\Extend\Traits\Updater;

class PermUser extends Model
{
    use Searchable;
    use Updater;

    protected $connection = 'liveuser_general'; // this will use the specified database conneciton
    protected $table = 'liveuser_perm_users';
    protected $primaryKey = 'perm_user_id';
    protected $fillable = ['auth_user_id', 'perm_type'];

    public function User()
    {
        return $this->hasOne('User', 'auth_user_id', 'auth_user_id');
    }

    public function areaAdminAreas()
    {
        //return $this->hasMany('App\Comment', 'foreign_key', 'local_key');
        return $this->hasMany('AreaAdminArea', 'perm_user_id', 'perm_user_id');
    }

    public function groupUsers()
    {
        //die('['.__LINE__.']['.__FILE__.']');
        return $this->hasMany('GroupUser', 'perm_user_id', 'perm_user_id');
    }

    public function getPermTypeByUser($user_id)
    {
        $perm_user = $this->where('auth_user_id', $user_id)->first();

        return $perm_user->perm_type;
    }

    public function areas()
    {
        /*
        $rows= $this->hasManyThrough(
            Area::class,AreaAdminArea::class,
            'perm_user_id','area_id'
        );
        con hasManyThrough non c'e' attach e detach che vengono usati nello store e update
        */
        $pivot = new AreaAdminArea();
        $rows = $this->belongsToMany(
            Area::class,
            $pivot->getTable(),
            'perm_user_id',
            'area_id'
        );
        //->groupBy('area_define_name');
        return $rows;
    }

    public function groups()
    {
        /*
        $rows= $this->hasManyThrough(
            Group::class,GroupUser::class,
            'perm_user_id','group_id'
        );
        con hasManyThrough non c'e' attach e detach che vengono usati nello store e update
        */
        $pivot = new GroupUser();
        $rows = $this->belongsToMany(
            Group::class,
            $pivot->getTable(),
            'perm_user_id',
            'group_id'
        );

        return $rows;
    }

    public function rights()
    {
        $pivot = new UserRight();
        $rows = $this->belongsToMany(
            Right::class,
            $pivot->getTable(),
            'perm_user_id',
            'right_id'
        );

        return $rows;
    }
}//end class PermUsers
