<?php

Route::group(['namespace' => 'App\Modules\setting\Controllers', 'middleware'=>['web','auth','cekstatus']], function () {
	Route::get('/contoh', 'ContohController@index');
	
	
	Route::get('user/user/getpegawai', 'penggunaController@getpegawai')->name('getpegawai');
	Route::get('user/user/getdetailpegawai', 'penggunaController@getdetailpegawai')->name('getdetailpegawai');
	
	/*Route::get('user/user/edit_user', 'penggunaController@edit_user')->name('edit_user');
	Route::get('user/group/group', 'penggunaController@group')->name('group');
	Route::get('user/group/tambah_group', 'penggunaController@tambah_group')->name('tambah_group');
	Route::get('user/group/edit_group', 'penggunaController@edit_group')->name('edit_group');*/


	  //User -> User
  Route::get('setting/hak-akses-pengguna/index', 'penggunaController@index')->name('user_index'); 
  Route::get('setting/hak-akses-pengguna/tambah', 'penggunaController@tambah_user')->name('tambah_user');
  Route::get('setting/hak-akses-pengguna/simpan', 'penggunaController@simpan_akses_pengguna');
});

