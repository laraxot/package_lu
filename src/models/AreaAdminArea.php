<?php

namespace XRA\LU\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use XRA\Extend\Traits\Updater;


class AreaAdminArea extends Model{
    //
    use Searchable;
    use Updater;
    protected $connection = 'liveuser_general'; // this will use the specified database conneciton
    protected $table = 'liveuser_area_admin_areas';
    //protected $primaryKey = 'auth_user_id'; ha 2 keys

function Area(){
	//return $this->belongsTo('App\Post', 'foreign_key', 'other_key');
	return $this->belongsTo(Area::class,'area_id','area_id');
}

function PermUser(){
	return $this->hasOne(PermUser::class,'perm_user_id', 'perm_user_id');
}   
//------------------------------------
static public function filter($params){
	extract($params);
	$rows=new self;
	if(isset($id_user)){
		$user=User::find($id_user);
		$perm_user_id=$user->perm_user_id();
		$rows=$rows->where('perm_user_id',$perm_user_id);		
	}
	return $rows;

}
//------------------------------------
}//---end class
