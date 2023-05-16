<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Grades\GradeController;
use App\Http\Controllers\PostController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


Auth::routes();
// For All
Route::group(['prefix' => LaravelLocalization::setLocale()], function() {
    /** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});

// For Guests Only
Route::group(
	[
		'prefix' => LaravelLocalization::setLocale(),
		'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'guest']
	],
function(){
    Route::get('/', function () {
        return view('auth.login');
    });
});


// For Auth Only
Route::group(
	[
		'prefix' => LaravelLocalization::setLocale(),
		'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth']
	],
function(){
    Route::view('/', 'dashboard');
    Route::view('/dashboard', 'dashboard')->name('main');

    Route::view('/page', 'page_default');

    Route::resource('blog', PostController::class);
    Route::resource('grades', GradeController::class);

});










