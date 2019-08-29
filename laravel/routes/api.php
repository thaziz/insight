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

Route::POST('analitic-history/create', 'api\analiticHistoryController@create');  
Route::POST('analitic-history/show/{id}', 'api\analiticHistoryController@show');  
Route::GET('analitic-history/data', 'api\analiticHistoryController@data');  
Route::POST('analitic-history/update/{id}', 'api\analiticHistoryController@update');  
Route::delete('analitic-history/delete/{id}', 'api\analiticHistoryController@delete');  


  

Route::POST('register', 'registerController@register');    
Route::GET('register/show/all', 'registerController@getAll');    
Route::GET('register/show/{id}', 'registerController@showRegister');    
Route::delete('register/destroy/{task}', 'registerController@destroy');
