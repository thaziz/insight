<?php

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
//email

Route::POST('register', 'registerController@register');    
Route::get('register/verify', 'registerController@verify')->name('register.verify');

 Route::get('/', function () {
        return view('form-daftar');
    })->name('daftar');

Route::group(['middleware' => ['guest', 'web']], function() {
   

    Route::get('/login/admin', function () {
        return view('login');
    })->name('login');
    Route::POST('login/masuk', 'loginController@authenticate');    
    });
     
Route::group(['middleware' => ['web','auth']], function() {
    Route::post('logout', 'mMemberController@logout')->name('logout');
    Route::get('admin', function () {
        return view('x');
    });
    Route::get('member', function () {
        return view('x');
    });
});