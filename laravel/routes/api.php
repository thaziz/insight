<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::POST('login', 'api\apiLoginController@authenticate');    
Route::POST('logout', 'api\apiLoginController@logout');  

Route::POST('analitic-history/create', 'api\apiAnaliticHistoryController@create');  
Route::POST('analitic-history/show/{id}', 'api\apiAnaliticHistoryController@show');  
Route::GET('analitic-history/data', 'api\apiAnaliticHistoryController@data');  
Route::POST('analitic-history/update/{id}', 'api\apiAnaliticHistoryController@update');  
Route::delete('analitic-history/delete/{id}', 'api\apiAnaliticHistoryController@delete');  



Route::POST('member-ig-profile/create', 'api\apiMemberigProfileController@create');  
Route::POST('member-ig-profile/show/{id}', 'api\apiMemberigProfileController@show');  
Route::GET('member-ig-profile/data', 'api\apiMemberigProfileController@data');  
Route::POST('member-ig-profile/update/{id}', 'api\apiMemberigProfileController@update');  
Route::delete('member-ig-profile/delete/{id}', 'api\apiMemberigProfileController@delete');  


Route::POST('subscribe/create', 'api\apiSubscribeController@create');  
Route::POST('subscribe/show/{id}', 'api\apiSubscribeController@show');  
Route::GET('subscribe/data', 'api\apiSubscribeController@data');  
Route::POST('subscribe/update/{id}', 'api\apiSubscribeController@update');  
Route::delete('subscribe/delete/{id}', 'api\apiSubscribeController@delete');  


Route::POST('activity/create', 'api\apiActivityController@create');  
Route::POST('activity/show/{id}', 'api\apiActivityController@show');  
Route::GET('activity/data', 'api\apiActivityController@data');  
Route::POST('activity/update/{id}', 'api\apiActivityController@update');  
Route::delete('activity/delete/{id}', 'api\apiActivityController@delete');  


  

Route::POST('register', 'registerController@register');    
Route::GET('register/show/data', 'registerController@getAll');    
Route::GET('register/show/{id}', 'registerController@showRegister');    
Route::delete('register/destroy/{id}', 'registerController@destroy');
