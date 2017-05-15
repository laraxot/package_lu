<?php

namespace XRA\LU\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use XRA\Extend\Traits\Updater;


class RightImplied extends Model
{
    //
    use Searchable;
	use Updater;
}
