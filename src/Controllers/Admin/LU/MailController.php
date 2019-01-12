<?php
namespace XRA\LU\Controllers\Admin\LU;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
//------------
use XRA\Extend\Services\ThemeService;
use XRA\LU\Mail\TestMail;

class MailController extends Controller
{
	public function create(Request $request){
		return ThemeService::view();
	}

	public function store(Request $request){
		$data=$request->all();
		//ddd($request->user());
		Mail::to($request->user())->send(new TestMail());
	}


}//end class