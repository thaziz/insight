<?php

Route::group(['namespace' => 'App\Modules\member\Controllers', 'middleware'=>['web','auth']], function () {

	Route::get('member-aktifasi/index', 'memberAktivasiController@index')->name('member-aktifasi');    
	Route::POST('member-aktifasi/data', 'memberAktivasiController@data')->name('member-aktifasi-data');    
	Route::POST('member-aktifasi/data-child', 'memberAktivasiController@dataChild')->name('member-aktifasi-data-child');    
	
	Route::get('member-aktifasi/verivikasi/{id}/{token}', 'memberAktivasiController@data_verifikasi')->name('member-aktifasi-tambah');

	Route::POST('member-perpanjangan/simpan', 'memberAktivasiController@simpan')->name('perpanjangan');
	Route::get('master-user/edit/{id}', 'masterUserController@edit')->name('edit_user');
	Route::POST('master-user/update', 'masterUserController@update')->name('update_user');
	Route::POST('master-user/delete', 'masterUserController@delete')->name('delete_user');
	Route::get('master-user/select-user', 'masterUserController@select_user')->name('select_user');


	Route::POST('lnotif', 'memberAktivasiController@lnotif');



	
	
	

});


