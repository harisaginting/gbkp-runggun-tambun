<?php
Route::group(['domain' => env('APP_URL_FRONTEND_PERMATA')], function () {
    Route::namespace('Permata')->group(function () {
        Route::get('/', 'LandingController@index')->name('home');
        Route::get('/home', function () {return redirect()->route('frontend.home');});

        Route::get('/login', 'LandingController@login')->name('login');
        Route::get('/edit-profile', 'MemberController@editProfile')->name('edit-profile');
        Route::post('/edit-profile-progress', 'MemberController@editProfileProgress')->name('edit-profile');
        Route::post('/upload-photo-profile', 'MemberController@uploadPhotoProgress')->name('upload-photo-profile');
        Route::get('/logout', 'MemberController@logout')->name('logout');
        Route::get('/register', 'LandingController@register')->name('register');
        Route::post('/register-process', 'MemberController@registerProcess');

        Route::get('/info',     'LandingController@information')->name('info');
        Route::get('/artikel',  'LandingController@artikel')->name('artikel');

        // EVENT
        Route::get('/covid19', 'EventController@covid19')->name('covid-19');
        Route::get('/khotbah', function () {return redirect("https://www.youtube.com/watch?v=3Dr55xXF_Uk");});
        
        Route::get('/yt/berkat-kemuliaanmu', function () {return redirect("https://www.youtube.com/watch?v=0U03DMJtkKI");});
        Route::get('/yt/berkat-kemurahanmu', function () {return redirect("https://www.youtube.com/watch?v=0U03DMJtkKI");});

        Route::group(['prefix' => '/member'], function () {
            Route::get('/activation/{code_activation}', 'MemberController@activation');
            Route::get('/forgot-password/', 'LandingController@forgotPassword');
            Route::post('/forgot-password/', 'MemberController@forgotPasswordProcess');
            
            Route::get('/reset-password/{code}', 'MemberController@resetPassword');
            Route::post('/reset-password-proccess/', 'MemberController@resetPasswordProcess');
        
            Route::get('/', 'MemberController@profile');
            Route::get('/profile/', 'MemberController@profile');
            Route::post('/login-process/', 'MemberController@login');
        });
    });
});