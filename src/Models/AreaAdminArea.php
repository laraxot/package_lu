<?php

namespace XRA\LU\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use XRA\Extend\Traits\Updater;
use XRA\Extend\Services\ThemeService;

class AreaAdminArea extends Model
{
    //
    use Searchable;
    use Updater;
    protected $connection = 'liveuser_general'; // this will use the specified database conneciton
    protected $table = 'liveuser_area_admin_areas';
    //protected $primaryKey = 'auth_user_id'; ha 2 keys
    protected $primaryKey = 'area_id'; //array da errore su hasManyThrough

    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id', 'area_id');
    }

    public function permUser()
    {
        return $this->belongsTo(PermUser::class, 'perm_user_id', 'perm_user_id');
    }
    //------------------------------------
    public static function filter($params)
    {
        $rows=new self;
        extract($params);
        if (isset($id_user)) {
            $user=User::find($id_user);
            $perm_user_id=$user->perm_user_id();
            $rows=$rows->where('perm_user_id', $perm_user_id);
        }
        return $rows;
    }

    public function getAreaDefineNameAttribute($value)
    {
        $area=$this->area();
        return $area->first()->area_define_name;
    }


    /**
     * { item_description }
     */
    //-----------------------------------------------------------------------------------
    public function dashboard_widget()
    {
        $view=strtolower($this->area_define_name).'::admin.dashboard_widget';
        if (\View::exists($view)) {
            return view($view)->with('row', $this);
        } else {
            return view('lu::admin.dashboard_widget_default')->with('row', $this);
        }
    }
    /**
     * { item_description }
     */
    public function a_href()
    {
        return url('admin/'.strtolower($this->area_define_name));
    }
    //-----------------------------------------------------------------------------
    public function icon_src()
    {
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
}//---end class
