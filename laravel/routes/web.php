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

 /*Route::get('/', function () {
        return view('form-daftar');
    })->name('daftar');*/
    Route::get('/', function () {
        return view('login-member');
    })->name('login-member');

Route::group(['middleware' => ['guest', 'web']], function() {
    Route::get('/login/admin', function () {
        return view('login');
    })->name('login-admin');

    Route::GET('login/masuk-member', 'loginController@authenticateMember');    
    Route::POST('login/masuk-admin', 'loginController@authenticateAdmin');    
    });
     
Route::group(['middleware' => ['web','auth']], function() {
    Route::post('logout', 'mMemberController@logout')->name('logout');
    Route::get('admin', function () {
        return view('x');
    })->name('admin');
    Route::get('member', function () {
        return view('x');
    });    
    
});