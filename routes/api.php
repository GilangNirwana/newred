<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Visitor;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});


Route::post("add/redirect","Controller@addRedirect");

Route::post("/addip",function (Request $request){
 
    $check = Visitor::where("ip",$request->ip)->first();
    
    if($check){
      
        return "have been added";
   
    }else{
        
        $ip = new Visitor();
        $ip->ip = $request->ip;
        $ip->save();
        return "ok";
    }
 
});

Route::post("/match_ip",function (Request $request){
 
    $check = Visitor::where("ip",$request->ip)->first();
    
    if($check){
        return \response()->json(["status"=>"Success"],200);
        // $check->delete();
        
    }else{
       return \response()->json(["status"=>"not found"],404);
    }
  
 
});
