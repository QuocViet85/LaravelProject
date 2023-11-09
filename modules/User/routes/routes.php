<?php
use Illuminate\Support\Facades\Route;
//use Modules\User\src\Http\Controllers\UserController;

// Route::middleware('demo')->get('/user', function() {
//     return '<h1>Hello World</h1>';
// });


//Route namespace
//Module Users
Route::group(['namespace' => 'Modules\User\src\Http\Controllers'], function() {
    Route::prefix('users')->group(function() {
        Route::get('/', 'UserController@index');
        Route::get('/detail/{id}', 'UserController@detail');
        Route::get('/create', 'UserController@create');
    });
});

Route::get('/', function() {

});