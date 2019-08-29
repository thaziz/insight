<?php

Route::group(['namespace' => 'App\Modules\member\Controllers', 'middleware'=>['web','auth']], function () {

	Route::get('member-aktifasi/index', 'memberAktivasiController@index');    
	Route::POST('member-aktifasi/data', 'memberAktivasiController@data')->name('member-aktifasi-data');    
	Route::get('member-aktifasi/verivikasi/{id}/{token}', 'memberAktivasiController@data_verifikasi')->name('member-aktifasi-tambah');
	Route::POST('master-user/simpan', 'masterUserController@simpan')->name('simpan_user');
	Route::get('master-user/edit/{id}', 'masterUserController@edit')->name('edit_user');
	Route::POST('master-user/update', 'masterUserController@update')->name('update_user');
	Route::POST('master-user/delete', 'masterUserController@delete')->name('delete_user');
	Route::get('master-user/select-user', 'masterUserController@select_user')->name('select_user');



	
	
	

});


