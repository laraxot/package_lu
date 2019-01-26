<?php
namespace XRA\LU\Controllers\Admin\LU;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
//------------
use XRA\Extend\Services\ThemeService;
use XRA\LU\Mail\TestMail;

class EventController extends Controller
{
    public function index(Request $request){
        $vendors=\XRA\XRA\Packages::allVendors();
        $enable_packs=config('xra.enable_packs');
        $events=[];
        foreach($vendors as $vendor){
            $packs=\XRA\XRA\Packages::all($vendor);
            foreach($packs as $pack){
                $path=__DIR__.'/../../../../../../'.$vendor.'/'.$pack.'/src/Events';
                $path=realpath($path);
                //echo '<br/>['.$path.']['.realpath($path).']';
                if($path!==null){
                    foreach (\glob($path.'/*.php') as $filename) {
                        $info=pathinfo($filename); 
                        //echo '<pre>';print_r($info);echo '</pre>';
                        $tmp=new \stdClass();
                        $tmp->vendor=$vendor;
                        $tmp->pack=$pack;
                        $tmp->name=$info['filename'];
                        $tmp->filename=$filename;
                        $tmp->namespace='\\'.$vendor.'\\'.$pack.'\\Events\\'.$info['filename'];
                        $events[]=$tmp;
                    }
                }
            }
        }
        return ThemeService::view()->with('events',$events);
    }

    public function edit(Request $request){
        $params = \Route::current()->parameters();
        extract($params);
        event(new $id_event('test'));
    }


}//end class
