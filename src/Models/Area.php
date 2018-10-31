<?php

namespace XRA\LU\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use XRA\Extend\Traits\Updater;
use XRA\Extend\Services\ThemeService;

class Area extends Model{
    use Searchable;
    use Updater;
    protected $connection = 'liveuser_general'; // this will use the specified database conneciton
    protected $table = 'liveuser_areas';
    protected $primaryKey = 'area_id';

    /*
    function PermUser(){
      return $this->hasOne(PermUser::class,'perm_user_id', 'perm_user_id');
    }
    */
    public function areaAdminArea(){
        return $this->hasMany(AreaAdminArea::class, 'area_id', 'area_id');
    }

    public function label(){
        return $this->area_id.'] '.$this->area_define_name;
    }

    public function key(){
        return $this->area_id;
    }

    public function keyName(){
        return 'area_id';
    }

    
    public function imageHtml($params=[]){
        extract($params);
        return '<img src="'.asset($this->icon_src).'" width="'.$width.'" height="'.$height.'" />';
    }


    public function getUrlAttribute($value){
        return url('admin/'.strtolower($this->area_define_name));
    }

    public function getGuidAttribute($value){
        return str_slug($this->area_define_name);
    }

    public function getIconSrcAttribute($value){
        //*
        /*
        $path= \XRA\XRA\Packages::menuxml($this->area_define_name).'/admin/icon.png';


        $path=realpath($path);

        if(file_exists($path)){
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
            return $base64;
        }else{
            //echo $path; die();
        }
        */
        $src=strtolower($this->area_define_name.'::img/icon.png');

        $srcz = ThemeService::viewNamespaceToUrl([$src]);
    
        //dd($srcz);
        $src=$srcz[0];

        $newsrc = ThemeService::getFileUrl($src);
        return $newsrc;

        // */
    //return asset('icons/'.$this->area_define_name.'/icon.png');
    /*
    if($this->icon_path==null){
        $this->icon_path='/icon/'.$this->area_define_name.'/icon.png';
        $this->save();
    }
    return asset($this->icon_path);
    */
    }


    public static function full()
    {
        $rows=new self;

        return $rows;
    }




    //---------------------------------------------------------------------------
    public static function filter($params){
        $rows=new self;
        extract($params);
        //echo '<pre>';print_r($params);echo '</pre>';
        if (isset($id_user)) {
            $user=User::find($id_user);
            $rows=$user->areas();
        } 
        //echo '<pre>';print_r($areas->toArray());echo '</pre>';
        //echo '<pre>';print_r($user);echo '</pre>';
        //$perm_user=$user->permUser['perm_user_id'];
        //echo '<pre>-';print_r($perm_user);echo '-</pre>';

        //
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
    public function dashboard_widget(){
        $view=strtolower($this->area_define_name).'::admin.dashboard_widget';
        $view_default='lu::admin.dashboard_widget_default';
        $namespace=config('xra.namespaces');
        if(isset($namespace[$this->area_define_name])){
            $model=$namespace[$this->area_define_name].'\Models\\'.$this->area_define_name; 
        }else{
            $model='---';
        }
        if(class_exists($model)){
            $model_obj=new $model;
        }else{
            $model_obj=new \stdClass();
        }
        $data=['area'=>$this,'row'=>$model_obj];
        return view()->first([$view, $view_default], $data);
        /*
        //if (\View::exists($view)) {
        if (view()->exists($view)) {
            $namespace=config('xra.namespaces');
            $model=$namespace[$this->area_define_name].'\Models\\'.$this->area_define_name; 
            $model_obj=new $model;
            return view($view)->with('area', $this)->with('row',$model_obj);
        } else {
            return view('lu::admin.dashboard_widget_default')->with('row', $this);
        }
        */
    }
    //------------------------------------------------------------------------------------
    public static function syncPacks(){
        $vendors=\XRA\XRA\Packages::allVendors();
        $packs=[];
        foreach ($vendors as $vendor) {
            $tmp=\XRA\XRA\Packages::all($vendor);
            $packs=array_merge($packs, $tmp);
        }
        $packs=collect(array_combine($packs, $packs));
        $areas=Area::all()->pluck('area_define_name', 'area_define_name');
        $adds=$packs->diff($areas)->all();
        $subs=$areas->diff($packs)->all();
        foreach($adds as $add){
            $row=new Area;
            $row->area_define_name=$add;
            $row->save();
        }
        foreach($subs as $sub){
            Area::where('area_define_name', $sub)->delete();
        }

    }
}//---------end class Areas
