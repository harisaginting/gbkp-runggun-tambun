<?php
Route::group(['domain' => env('APP_URL_FRONTEND')], function () {
    Route::namespace('Gbkp')->group(function () {
  		 Route::get('/', 'LandingController@index')->name('home');
  		 Route::get('/artikel/', 'LandingController@artikelList')->name('artikel-list');
  		 Route::get('/artikel/{url_key}', 'LandingController@artikel')->name('artikel');

  		 Route::post('dashboard/chart-total-kategorial', 'DashboardController@chartTotalKategorial')->name('frontend-chart-total-kategorial');
	});

	 Route::namespace('Backend')->group(function () {
  		 Route::get('app/chart-total-kategorial', 'DashboardController@chartTotalKategorial')->name('frontend-chart-total-kategorial');
	});
});
