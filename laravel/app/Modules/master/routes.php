<?php

Route::group(['namespace' => 'App\Modules\master\Controllers', 'middleware'=>['web','auth']], function () {

	Route::get('master-user/index', 'masterUserController@index')->name('index_user');    
	Route::POST('master-user/data', 'masterUserController@data')->name('data_user');    
	Route::get('master-user/tambah', 'masterUserController@tambah')->name('tambah_user');
	Route::POST('master-user/simpan', 'masterUserController@simpan')->name('simpan_user');
	Route::get('master-user/edit/{id}', 'masterUserController@edit')->name('edit_user');
	Route::POST('master-user/update', 'masterUserController@update')->name('update_user');
	Route::POST('master-user/delete', 'masterUserController@delete')->name('delete_user');
	Route::get('master-user/select-user', 'masterUserController@select_user')->name('select_user');



	Route::get('master-kode/index', 'masterKodeController@index')->name('index_kode');    
	Route::POST('master-kode/data', 'masterKodeController@data');    
	Route::GET('master-kode/tambah', 'masterKodeController@tambah')->name('tambah_kode');
	Route::POST('master-kode/simpan', 'masterKodeController@simpan')->name('simpan_kode');
	Route::get('master-kode/edit/{id}', 'masterKodeController@edit')->name('edit_kode');
	Route::POST('master-kode/update', 'masterKodeController@update')->name('update_kode');
	Route::POST('master-kode/delete', 'masterKodeController@delete')->name('delete_kode');
	Route::get('master-kode/select-kode', 'masterKodeController@select_kode')->name('select_kode');


	Route::get('master-group/index', 'masterGroupController@index')->name('index_group');    
	Route::POST('master-group/data', 'masterGroupController@data');    
	Route::GET('master-group/tambah', 'masterGroupController@tambah')->name('tambah_group');
	Route::POST('master-group/simpan', 'masterGroupController@simpan')->name('simpan_group');
	Route::get('master-group/edit/{id}', 'masterGroupController@edit')->name('edit_group');
	Route::POST('master-group/update', 'masterGroupController@update')->name('update_group');
	Route::POST('master-group/delete', 'masterGroupController@delete')->name('delete_group');
	Route::get('master-group/detail/{id}', 'masterGroupController@detail')->name('group_detail');
	Route::POST('master-group/simpan-detail', 'masterGroupController@simpan_detail')->name('simpan_detail');



	Route::get('master-history/index', 'masterHistoryController@index')->name('index_history');    
	Route::get('master-history/data', 'masterHistoryController@data');    


	Route::get('master-chek-kode/index', 'masterHistoryController@chek_kode')->name('index_history');    
	Route::get('master-chek-kode/data', 'masterHistoryController@chek_kode_data');    
	

	


	

	Route::get('master-vendor/index', 'masterVendorController@index')->name('index_vendor');    
	Route::POST('master-vendor/data', 'masterVendorController@data')->name('data_vendor');    
	Route::get('master-vendor/tambah', 'masterVendorController@tambah')->name('tambah_vendor');
	Route::POST('master-vendor/simpan', 'masterVendorController@simpan')->name('simpan_vendor');
	Route::get('master-vendor/edit/{id}', 'masterVendorController@edit')->name('edit_vendor');
	Route::POST('master-vendor/update', 'masterVendorController@update')->name('update_vendor');
	Route::POST('master-vendor/delete', 'masterVendorController@delete')->name('delete_vendor');
	Route::get('master-vendor/select-vendor', 'masterVendorController@select_vendor')->name('select_vendor');



	Route::get('master-contract/index', 'masterContractController@index')->name('index_contract');    
	Route::POST('master-contract/data', 'masterContractController@data')->name('data_contract');    
	Route::get('master-contract/tambah', 'masterContractController@tambah')->name('tambah_contract');
	Route::POST('master-contract/simpan', 'masterContractController@simpan')->name('simpan_contract');
	Route::get('master-contract/edit/{id}', 'masterContractController@edit')->name('edit_contract');
	Route::POST('master-contract/update', 'masterContractController@update')->name('update_contract');	
	Route::POST('master-contract/delete', 'masterContractController@delete')->name('delete_induk');

	Route::get('master-contract/generate-pdf/{id}', 'masterContractController@generate_pdf')->name('generate_pdf');

	Route::get('master-contract/select-contract', 'masterContractController@select_contract')->name('select_contract');

	Route::POST('master-contract/detail/{id}', 'masterContractController@detail')->name('detail_induk');


	
	Route::get('master-inspeksi/index', 'masterInspeksiController@index')->name('index_inspeksi');    
	Route::POST('master-inspeksi/data', 'masterInspeksiController@data')->name('data_inspeksi');        
	Route::get('master-inspeksi/tambah', 'masterInspeksiController@tambah')->name('tambah_inspeksi');
	Route::POST('master-inspeksi/simpan', 'masterInspeksiController@simpan')->name('simpan_inspeksi');
	Route::get('master-inspeksi/edit/{id}', 'masterInspeksiController@edit')->name('edit_inspeksi');
	Route::POST('master-inspeksi/update', 'masterInspeksiController@update')->name('update_inspeksi');
	Route::GET('master-inspeksi/update', 'masterInspeksiController@update')->name('update_inspeksi');//xx
	Route::POST('master-inspeksi/delete', 'masterInspeksiController@delete')->name('delete_inspeksi');

	Route::POST('master-inspeksi/get-unit-vendor', 'masterInspeksiController@getUnitVendor')->name('get_unit_vendor');

	Route::POST('master-inspeksi/get-unit-vendor-dt', 'masterInspeksiController@getUnitVendorDt')->name('get_unit_vendor_dt');
	

	Route::POST('master-inspeksi/detail/{id}', 
		'masterInspeksiController@detail')->name('detail_inspeksi');
	
	Route::get('master-inspeksi/generate-pdf/{id}', 'masterInspeksiController@generate_pdf')->name('generate_pdf');

	Route::get('master-inspeksi/laporanExcel', 'masterInspeksiController@laporanExcel')->name('laporanExcel');
	
	
	Route::get('report-inspeksi/index', 'reportController@index')->name('index_report');   
	Route::get('report-inspeksi/report-table', 'reportController@reportTable')->name('reporttable_report');   
	/*Route::get('report-inspeksi/report-table', 'reportController@pdf')->name('reporttable_report');   */
	Route::get('report-inspeksi/chart', 'reportController@chart')->name('chart_report');   
	Route::get('report-inspeksi/generate-excel', 'reportController@laporanExcel')->name('excel_report');   
	
	

});


