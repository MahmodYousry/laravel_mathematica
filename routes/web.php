<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\Grades\GradeController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
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

    Route::post('filter_classes', [ClassroomController::class, 'filter_classes'])->name('filter_classes');
    Route::post('delete_all', [ClassroomController::class, 'delete_all'])->name('delete_all_classrooms');

    Route::view('add_parents', 'livewire.show_form');

    // Made For Ajax Request - Sections View Page - add section modal - Select Box
    Route::get('/classes/{id}', [SectionController::class, 'getclasses']);
    // Select box Ajax Call on [views/pages/students/create]
    Route::get('/Get_classrooms/{id}', [StudentController::class, 'Get_classrooms']);
    Route::get('/Get_Sections/{id}', [StudentController::class, 'Get_Sections']);

    // Resources
    Route::resource('students', StudentController::class);
    Route::resource('teachers', TeacherController::class);
    Route::resource('sections', SectionController::class);
    Route::resource('classrooms', ClassroomController::class);
    Route::resource('grades', GradeController::class);

});










