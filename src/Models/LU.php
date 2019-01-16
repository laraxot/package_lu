<?php



namespace XRA\LU\Models;

use Illuminate\Database\Eloquent\Model;

class LU extends Model
{
    protected $connection = 'liveuser_general'; // this will use the specified database conneciton
    protected $table = 'liveuser_users';
    protected $primaryKey = 'auth_user_id';

    //------ MUTATORS -------
    public function getLastNameAttribute($value)
    {
        return $this->cognome;
    }

    public function getNameAttribute($value)
    {
        return $this->nome;
    }

    public function getGravatarAttribute($value)
    {
        $publicBaseUrl = 'https://www.gravatar.com/avatar/';
        $secureBaseUrl = 'https://secure.gravatar.com/avatar/';
        $default = 'https://www.somewhere.com/homestar.jpg';
        $size = 20;

        return $secureBaseUrl.\md5(\mb_strtolower(\trim($this->email))).'&s='.$size;
    }

    //------
    public function latestUsersLoggedIn()
    {
        return self::orderBy('last_login_at', 'desc')->limit(8);
    }
}
