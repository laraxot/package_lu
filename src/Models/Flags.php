<?php

namespace XRA\LU\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class Flags extends Model
{
    protected $connection = 'liveuser_general';
    protected $table = 'liveuser_flags';
    protected $primaryKey = 'flag_id';

    protected $guarded = [
        "created_at","updated_at"
    ];
}
