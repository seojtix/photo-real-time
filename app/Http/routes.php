<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    //return view('welcome');

    $url = 'http://686project.com/demos/photographer/assets/img/photo_%NUM%.jpg';
    $photos = [];
    foreach (range(1, 12) as $num) {
        $num = str_pad($num, 2, '0', STR_PAD_LEFT);
        $photos[] = str_replace('%NUM%', $num, $url);
    }

    return view('photos.index', compact('photos'));
});

Route::auth();

Route::get('/home', 'HomeController@index');
