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

    $photos = App\Models\Photo::orderBy('created_at', 'desc')->take(20)->get();

    return view('photos.index', compact('photos'));
});

Route::auth();

Route::get('/home', 'HomeController@index');
