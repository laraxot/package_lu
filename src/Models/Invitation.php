<?php

namespace XRA\LU\Models;

use Illuminate\Database\Eloquent\Model;

//https://laraveldaily.com/laravel-auth-make-registration-invitation-only/

class Invitation extends Model
{ 

	protected $connection = 'liveuser_general'; // this will use the specified database conneciton
    protected $table = 'invitations';
    protected $primaryKey = 'id';

    protected $fillable = [
        'email', 'invitation_token', 'registered_at',
    ];

    public function generateInvitationToken() {
    	$this->invitation_token = substr(md5(rand(0, 9) . $this->email . time()), 0, 32);
	}

	public function getLink() {
    	return urldecode(route('register') . '?invitation_token=' . $this->invitation_token);
	}

}//end class