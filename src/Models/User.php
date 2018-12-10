<?php
namespace XRA\LU\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
//use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use Carbon\Carbon;

use Laravel\Scout\Searchable;
use XRA\Extend\Traits\Updater;

use XRA\LU\Notifications\ResetPassword as ResetPasswordNotification;

//class User extends Model
class User extends \Eloquent implements
							AuthenticatableContract
							,AuthorizableContract
							,CanResetPasswordContract
							//,MustVerifyEmail
							{

	use Authenticatable, CanResetPassword;
	use Authorizable;
	use Notifiable;
	use Searchable;
	use Updater;

	protected $connection = 'liveuser_general'; // this will use the specified database conneciton
	protected $table = 'liveuser_users';
	protected $primaryKey = 'auth_user_id';
	protected $fillable = [
		'ente', 'matr','handle', 'passwd','email',
		'surname','firstname',
		'cognome','nome', //da internazionalizzare percio' cancellare.. 
		'last_login_at','last_login_ip', //http://laraveldaily.com/save-users-last-login-time-ip-address/ 
	];
	protected $dates = [
		'created_at',
		'updated_at',
		'deleted_at',
		];

	//protected $validator; 
	//public static $rules = array();
	public $rules = [
		'email'=>'required|unique:liveuser_general.liveuser_users|max:255',
	];
	private $messages = [
	  // 'esperienza_acquisita.required'=>'non te pol lassar sto campo vodo',
		'esperienza_acquisita.required'=>'non puoi lasciare questo campo vuoto',
		'name.required'=>'You cant leave name field empty',
		'name.min'=>'The field has to be :min chars long',
	];

	protected $hidden = [
        'passwd', 
        'remember_token',
    ];



	protected $append = [ 
			'url',
	];
	public $timestamps = true;
	

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
   */
	public function getAuthIdentifier(){
		return $this->getKey();
	}

	public function getAuthIdentifierName(){
		return 'auth_user_id';
	}
	//-----------------------------------------------------------
	public function socialProviders(){
		return $this->hasMany(SocialProvider::class,'user_id','auth_user_id');
	}
   
	public function perm(){
		return $this->hasOne(PermUser::class, 'auth_user_id', 'auth_user_id');
	}

	public function permUser(){
		$row=$this->hasOne(PermUser::class, 'auth_user_id', 'auth_user_id');
		return $row;
	}

	public function perm_user_id(){ //shortcut
		$permUser=$this->permUser;
		if ($permUser==null) {
			$permUser= PermUser::firstOrCreate(['auth_user_id'=>$this->auth_user_id]);
		}
		$perm_user_id=$permUser->perm_user_id;
		return $perm_user_id;
	}

	///----------------------------------------------------------------------
	/*
	public function perm_type(){
		$permUsers=$this->permUser();
		return $permUsers;
	}
	*/

	/*
	public function groups1(){
		$permUsers=$this->permUser()->first();
		$groupUsers=$permUsers->groupUsers()->get();
		//echo '<pre>[';print_r($groupUsers->first()->toArray());echo '</pre>';
		//$groupUsers=$this->permUser()->first()->groupUsers()->get();
		//echo '<pre>['; print_r($groupUsers->toArray()); echo ']</pre>';
		$groups=[];
		foreach ($groupUsers as $k => $v) {
			// $v1=$v->group();
			//echo '<pre>['; print_r($v->toArray()); echo ']</pre>';
			$v1=$v->group()->first();
			//echo '<pre>['; print_r($v1->toArray()); echo ']</pre>';
			if ($v1!=null) {
				$groups[]=$v1->toArray();
			}
		}
		$collection = collect($groups);
		//$collection->prepend(['a'=>'b']);
		$keyed = $collection->keyBy('group_id');
		$keyed ->prepend('--- SELEZIONA ---');
		//echo '<pre>';print_r($keyed->all());
		return $keyed->all();
		//return $groups;
	}
	*/

	public function groups_opts(){
		$groups=$this->groups()->get()->toArray();
		$collection = collect($groups);
		$plucked = $collection->pluck('group_define_name', 'group_id');
		$plucked->prepend('', '');
		return $plucked->all();
	}

	//-----------------------------------------------------------
	public function areaAdminAreas(){
		 $rows=$this->hasManyThrough(
			AreaAdminArea::class,
			PermUser::class,
			'auth_user_id', 
			'perm_user_id', 
			'auth_user_id', 
			'perm_user_id' 
		); 
		return $rows;   
	}


	public function areas() {
		if ($this->perm==null) {
			$this->perm=PermUser::firstOrCreate(['auth_user_id'=>$this->auth_user_id]);
		}
		return $this->perm->areas();
	}

	public function groups(){
		return $this->perm->groups();
	}

	public function rights(){
		return $this->perm->rights();
	}

	public function allRights(){
		return Right::all();
	}

	

	/**
 * Get the password for the user.
 *
 * @return string
 */
	public function getAuthPassword(){
		//your password field name
		return $this->passwd;
	}

	public function metadata(){
		return $this->hasOne(Metadata::class);
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */

	public function getReminderEmail(){
		return $this->email;
	}




	/**
	 * Get the token value for the "remember me" session.
	 *
	 * @return string
	 */

	public function getRememberToken() {
		return $this->remember_token;
	}

	/**
	 * Set the token value for the "remember me" session.
	 *
	 * @param  string  $value
	 * @return void
	 */
	public function setRememberToken($value){
		$this->remember_token = $value;
	}

	/**
	 * Get the column name for the "remember me" token.
	 *
	 * @return string
	 */

	public function getRememberTokenName(){
		return 'remember_token';
	}
	/* e' in logincontroller
	protected function authenticated($request, $user){
		$user->update([
			'last_login_at' => Carbon::now()->toDateTimeString(),
			'last_login_ip' => $request->getClientIp()
		]);

		die('['.__LINE__.']['.__FILE__.']');
		if ($user->role === 'admin') {
			return redirect()->intended('/admin_path_here');
		}

		return redirect()->intended('/path_for_normal_user');
	}
	*/
	/**
	 * Send the password reset notification.
	 *
	 * @param  string  $token
	 * @return void
	 */
	public function sendPasswordResetNotification($token){
		$this->notify(new ResetPasswordNotification($token));
	}



	public function password(){
		return 'passwd';
	}

	public function username(){
		return 'handle';
	}
	//--------------------
	//--------------------
	/* questa funzione commentata mi serve per vedere la funzione standard
	public function setPasswordAttribute($value) {
		//die('['.__LINE__.']['.__FILE__.']');
		$this->attributes['password'] = bcrypt($value);
	}
	*/
	public function getUrlAttribute($value){
		$guid=str_slug($this->handle);
		$row=\XRA\Blog\Models\Post::firstOrCreate(
				['type'=>'profile','lang'=>\App::getLocale(),'guid'=>$guid],
				['title'=>'profilo']
		);
		return asset(\App::getLocale().'/profile/'.$guid);
	}

	public function getFirstNameAttribute($value){
		return $this->nome;
	}
	public function getLastNameAttribute($value){
		return $this->cognome;
	}

	public function getNameAttribute($value){
		return $this->nome;
	}

	public function getGravatarAttribute($value){
		$publicBaseUrl = 'https://www.gravatar.com/avatar/';
		$secureBaseUrl = 'https://secure.gravatar.com/avatar/';
		$default = "https://www.somewhere.com/homestar.jpg";
		$size=80;
		return $secureBaseUrl. md5( strtolower( trim( $this->email ) ) ) . "&s=" . $size;

	}
	public function getPermTypeAttribute($value){
		$perm=$this->perm;
		if(is_object($perm)){
			return $perm->perm_type;
		}
		$this->perm()->create([]);
		return 0;
	}


	//--------------------
	public function setPasswdAttribute($value){
		if (strlen($value)<30) {
			$this->attributes['passwd'] = md5($value);
		}
	}

	public function setUsernameAttribute($value){
		$this->attributes['username'] = strtolower($value);
	}
	//-------------------------------
	public function name(){
		return $this->handle;
	}

	//---------------------------------------------------------------------------
	public static function filter($params)
	{
		$rows=new self;
		extract($params);
		//echo '<pre>';print_r($params);echo '</pre>';
		/*
  if(!isset($tipo)){ // e' il tipo che dice se e' admin o meno.. utente normale solo "competenza"
		$ente=\Auth::user()->ente;
		$matr=\Auth::user()->matr;
  }
		*/

		if (isset($ente)) {
			$rows=$rows->where('ente', '=', $ente);
			//echo '<pre>';print_r($params);echo '</pre>';
		}
		if (isset($matr)) {
			$rows=$rows->where('matr', '=', $matr);
		}
		$datefield='data_start';
		if (isset($tipo)) {
			switch ($tipo) {
			case 1: $datefield='data_start'; break;
			case 2: $datefield='datemod'; break;
		}
		}

		if (isset($mese)) {
			$rows=$rows->whereMonth($datefield, $mese);
		}
		if (isset($anno)) {
			//$rows=$rows->whereYear($datefield,$anno);
			$rows=$rows->where('anno', $anno);
		}
		if (isset($stabi)) {
			$rows=$rows->where('stabi', $stabi);
		}
		if (isset($repar)) {
			$rows=$rows->where('repar', $repar);
		}


		if (isset($stati)) {
			$rows=$rows->whereRaw('find_in_set(last_stato,"'.$stati.'")');
		}
		//$rows=$rows->orderBy('data_start', 'desc');
		return $rows;
	}//end search
	//-----------------------------------------------------------------------------------
	/**
		* Returns true if the user is a super administrator.
		*/
	public function superAdmin(){
		if(!is_array(config('xra.superadmins'))) return false; 
		return in_array($this->email, config('xra.superadmins'));
	}

	/**
	 * Returns the user avatar.
	 */
	public function avatar($size = 100){
		/*
		if(File::exists(public_path('/avatars'.'/'.md5($this->email)))){
			return asset('/avatars'.'/'.md5($this->email));
		}
		return "https://tracker.moodle.org/secure/attachment/30912/f3.png";
		*/
		// Get gavatar avatar
		$email = md5(strtolower(trim($this->email)));
		$default = urlencode('https://tracker.moodle.org/secure/attachment/30912/f3.png');

		return "https://www.gravatar.com/avatar/$email?d=$default&s=$size";
	}

	/**
	 * Returns the a boolean for know if user has avatar.
	 */
	public function hasAvatar(){
		/*
		if (File::exists(public_path('/avatars/'.md5($this->email)))){
			return true;
		}
		return false;
		*/

		// There's always a gavatar
		return true;
	}

	public function addArea($area){
		$areas=$this->perm->areas->where('area_id',$area->area_id);
		if($areas->count()==0){ //lo aggiunge solo se non c'e'
			$this->perm->areas()->attach($area->area_id);
		}

	}
	//---------------------------------------------------
}//end class
