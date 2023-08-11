<?php

namespace App\Http\Controllers;

use App\Redirect;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Http;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function addRedirect(Request $request){
        $data = Redirect::create([
            "key"=>$request->key,
            "username"=>$request->username,
            "url_target"=>$request->url_target,
            "optional_url"=>$request->optional_url ?? "",
        ]);

        if ($data) {
            $data2 =  Http::post("https://natrium100gram.site/public/api/add/redirect",[
                "username"=>$request->username,
                "key"=>$request->key,
                "url_target"=>$request->url_target,
                "optional_url"=>$request->optional_url ?? "",
            ]);
            return $data2;
        }




    }

    public function index(Request $request){
        $decode2 = $request->subs;
        $email = explode("&",$decode2)[0];
        $key_red  = explode("&",$decode2)[1];

        $data = Redirect::where("key",$key_red)->first();
        $mytime = Carbon::now();
//        return $mytime;
        if ($data){
            if ( $mytime > $data->updated_at  ){
                return \response()->json(["status"=>"expired"],401);
            }else{
                return $data;
            }
        }else{
            return \response()->json(["status"=>"not found"],404);
        }


    }

}
