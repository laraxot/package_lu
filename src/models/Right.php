<?php

namespace XRA\LU\Models;

use Illuminate\Database\Eloquent\Model;

class Right extends Model
{
    protected $connection = 'liveuser_general'; // this will use the specified database conneciton
    protected $table = 'liveuser_rights';
    protected $primaryKey = 'right_id';

    static public function filter($params){
    	$rows=new self;
    	return $rows;
    }
}
