<?php

namespace XRA\LU\Models;

use Illuminate\Database\Eloquent\Model;
use XRA\Extend\Traits\Updater;


class AreaAdminArea extends Model{
    //
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
	
	if(isset($id_user)){
		/*
		$rows=Area::whereHas('PermUser',function ($query) use($id_user){
			$query->where('auth_user_id',$id_user);
		});
		*/
		$user=User::find($id_user);
		$perm_user_id=$user->perm_user_id();
		dd($perm_user_id);
	}else{
		$rows=new self;
	}
	return $rows;

}
//------------------------------------
}//---end class
