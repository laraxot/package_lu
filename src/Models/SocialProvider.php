<?php

namespace XRA\LU\Models;

use Illuminate\Database\Eloquent\Model;

class SocialProvider extends Model
{
    protected $connection = 'liveuser_general'; // this will use the specified database conneciton
    protected $table = 'social_providers';
    protected $fillable=['provider_id','provider'];
    //
    //----------------RELATIONSHIP------------------------
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'auth_user_id');
    }
}
