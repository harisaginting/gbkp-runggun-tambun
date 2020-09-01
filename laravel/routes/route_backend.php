<?php
// ================== 	BACKEND  ==============================

Route::group(['domain' => env('APP_URL')], function () {
    Route::namespace('Backend')->group(function () {
    	// auth
    	Route::get('/login', 			'AuthController@login')->name('login');
    	
    	// page
    	Route::get('/', 'DashboardController@index')->name('app-dashboard');
    	
    	Route::get('/anggota', 'AnggotaController@index')->name('app-anggota');
    	Route::get('/anggota/add', 'AnggotaController@add')->name('app-anggota-add');
    	Route::get('/anggota/edit/{id}', 'AnggotaController@edit')->name('app-anggota-edit');
    	Route::get('/anggota/view/{id}', 'AnggotaController@view')->name('app-anggota-view');


    	Route::get('/keluarga', 'KeluargaController@index')->name('app-keluarga');
    	Route::get('/keluarga/add', 'KeluargaController@add')->name('app-keluarga-add');
    	Route::get('/keluarga/edit/{id}', 'KeluargaController@edit')->name('app-keluarga-edit');
    	Route::get('/keluarga/view/{id}', 'KeluargaController@view')->name('app-keluarga-view');

    	Route::get('/artikel', 'ArtikelController@index')->name('app-artikel');
    	Route::get('/artikel/add', 'ArtikelController@add')->name('app-artikel-add');
    	Route::get('/artikel/edit/{id}', 'ArtikelController@edit')->name('app-artikel-edit');

    	Route::get('/konfigurasi', 'KonfigurasiController@index')->name('app-config');
    	Route::get('/konfigurasi/lokasi', 'KonfigurasiController@index')->name('app-config-location');
    		
    	Route::get('/jabatan', 'JabatanController@index')->name('app-jabatan');
    	Route::get('/serayaan', 'JabatanAnggotaController@index')->name('app-serayaan');



    	// migrasi
    	// Route::get('/migrasi', 'UtilityController@migrasi');

    	// action
    	Route::prefix('api')->group(function(){
    		Route::prefix('v1')->group(function(){
    			// WITH AUTH
    			Route::group(['middleware' => 'harisa-api'], function(){
    				Route::post('anggota/save', 'AnggotaController@save')->name('app-anggota-save');
    				Route::get('anggota/get/{id}', 'AnggotaController@get')->name('app-anggota-get');
    				Route::get('anggota/select', 'AnggotaController@select')->name('app-anggota-select');
		    		Route::get('anggota/list', 'AnggotaController@list')->name('app-data-anggota');
		    		Route::get('konfigurasi', 'KonfigurasiController@list')->name('app-data-config-general');

		    		Route::post('keluarga/save', 'KeluargaController@save')->name('app-keluarga-save');
		    		Route::get('keluarga/list', 'KeluargaController@list')->name('app-data-keluarga');
		    		Route::get('keluarga/get/{id}', 'KeluargaController@get')->name('app-keluarga-get');

		    		Route::post('artikel/save', 'ArtikelController@save')->name('app-artikel-save');
		    		Route::get('artikel/list', 'ArtikelController@list')->name('app-data-artikel');
		    		Route::get('artikel/get/{id}', 'ArtikelController@get')->name('app-artikel-get');

		    		Route::post('jabatan/save', 'JabatanController@save')->name('app-jabatan-save');
		    		Route::get('jabatan/list', 'JabatanController@list')->name('app-data-jabatan');
		    		Route::get('jabatan/get/{id}', 'JabatanController@get')->name('app-jabatan-get');
		    		Route::get('jabatan/select', 'JabatanController@select')->name('app-jabatan-select');


		    		Route::post('serayaan/save', 'JabatanAnggotaController@save')->name('app-serayaan-save');
		    		Route::get('serayaan/list', 'JabatanAnggotaController@list')->name('app-data-serayaan');
    			});

    			// NO AUTH
    			Route::get('get-config/{type}', 'KonfigurasiController@getConfig');
    			Route::get('get-marga', 	'KonfigurasiController@getMarga');
    			Route::get('get-provinsi',  'KonfigurasiController@getProvinsi');
				Route::get('get-kabupaten', 'KonfigurasiController@getKabupaten');
				Route::get('get-kecamatan', 'KonfigurasiController@getKecamatan');
				Route::get('get-keluarga-status', 'KonfigurasiController@getKeluargaStatus');
    			
    		});
		});


    	// auth
    	Route::post('/api/login', 	'AuthController@loginProcess')->name('admin-login-process');






















    	// OLD




  		Route::get('/register', 'AuthController@register')->name('register');
		Route::get('/logout', 'AuthController@logout')->name('logout');
		
		Route::post('/register_process', 'AuthController@registerProcess')->name('register_process');

		// Email
		Route::get('/email/test', 'EmailController@sendEmailTest');
		Route::get('/email/send-minggu', 'EmailController@sendEmailMinggu');
		Route::get('/email/send-birthday', 'EmailController@sendEmailBirthday');

		// Util
		Route::get('/refresh-data', 'UtilityController@refreshUserData');

		Route::group(['middleware' => 'login'], function(){

			// Dashboard
			
			// Route::get('/rakor3export', 'EventController@rakor3export');
			
			// Anggota
			
			Route::get('/anggota/profile/{id}', 'AnggotaController@profile');
			Route::get('/anggota/delete/{id}', 'AnggotaController@delete');
			Route::get('/anggota/upload', 'AnggotaController@upload_anggota');
			Route::post('/anggota/upload_data_anggota', 'AnggotaController@upload_anggota_process')->name('upload_data_anggota');

			Route::post('/anggota/update-process', 'AnggotaController@updateProcess');

			// acara
			Route::get('/acara', 'AcaraController@index');

			// pa
			Route::get('/pa', 'AcaraController@pa');
			Route::post('/update_pa', 'AcaraController@update_pa');
			Route::post('/get_pa', 'AcaraController@get_pa');
			Route::post('/get_pa-view', 'AcaraController@getPaView');
			Route::post('/get-peserta-pa', 'AcaraController@getPesertaPa');
			Route::post('/update-peserta-pa', 'AcaraController@updatePesertaPa');

			// Keuangan
			Route::get('/keuangan/pemasukan', 'KeuanganController@pemasukan');
			Route::get('/keuangan/pengeluaran', 'KeuanganController@pengeluaran');
			Route::post('/keuangan/update-pengeluaran', 'KeuanganController@updatePengeluaran');
			Route::get('/keuangan/upload-kas', 'KeuanganController@upload_kas');
			Route::post('/keuangan/upload_data_kas', 'KeuanganController@upload_kas_process')->name('upload_data_kas');
			Route::post('/keuangan/add_iuran_kas', 'KeuanganController@add_iuran_kas');
			Route::post('/keuangan/delete_iuran_kas', 'KeuanganController@delete_iuran_kas');
			Route::post('/keuangan/delete-pengeluaran', 'KeuanganController@deletePengeluaran');
			Route::post('/keuangan/add_pemasukan_kantin', 'KeuanganController@addPemasukanKantin');
			Route::post('/keuangan/update_pemasukan_kantin', 'KeuanganController@updatePemasukanKantin');
			Route::post('/keuangan/get-pemasukan-kantin', 'KeuanganController@getPemasukanKantin');

			//Datatable 
			Route::post('/datatable_anggota', 'AnggotaController@datatable_anggota');
			Route::post('/datatable_iuran_kas', 'KeuanganController@datatable_iuran_kas');
			Route::post('/datatable_pa', 'AcaraController@datatable_pa');
			Route::post('/datatable_persembahan_pa', 'KeuanganController@datatable_persembahan_pa');
			Route::post('/datatable_pemasukan_kantin', 'KeuanganController@datatablePemasukanKantin');
			Route::post('/datatable-pengeluaran-kas', 'KeuanganController@datatablePengaluaranKas');

			// Json
			Route::post('/json/anggota', 'JsonController@list_anggota');
			Route::post('/json/data-agenda', 'AgendaController@list_agenda');

			// Agenda
			Route::get('/agenda', 'AgendaController@index');
			Route::post('/agenda/list_agenda', 'AgendaController@list_agenda');
			Route::post('/agenda/update_agenda', 'AgendaController@update_agenda');
			Route::post('/agenda/update_jam_agenda', 'AgendaController@update_jam_agenda');
			Route::post('/agenda/delete_agenda', 'AgendaController@delete_agenda');

			// Agenda
			Route::get('/email', 'EmailController@index');
			Route::post('/email/send-broadcast', 'EmailController@sendEmailBroadcast');
		});
	});
});


// ================== 	CUSTOM  ==============================
Route::group(['middleware' => 'login'], function(){
		Route::get('/rakor3export', 'EventController@rakor3export');
});
Route::group(['prefix' => '/event'], function () {
	Route::get('/', 'EventController@index');
	Route::get('/rakor3', 'EventController@rakor3');
	Route::get('/rakor3/set-attendance/{phone?}/{present?}', 'EventController@rakor3setattendance');
	Route::get('/rakor3/scanner/', 'EventController@rakor3scanner');
	Route::get('/rakor3/{phone}', 'EventController@rakor3attendance');
});