<?php



namespace XRA\LU\Controllers\Auth;

use App\Http\Controllers\Controller;
//use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;

//--- requests
use XRA\LU\Requests\StoreInvitationRequest;
//--- models --
use XRA\LU\Models\Invitation;
//--- services --
use XRA\Extend\Services\ThemeService;

class InvitationController extends Controller{

	public function create() { 
    	return ThemeService::view()->with('title','invitation');
	}

	public function store(StoreInvitationRequest $request)
	{
	    $invitation = new Invitation($request->all());
	    $invitation->generateInvitationToken();
	    $invitation->save();

	    return redirect()->route('requestInvitation')
	        ->with('success', 'Invitation to register successfully requested. Please wait for registration link.');
	}

}//end class