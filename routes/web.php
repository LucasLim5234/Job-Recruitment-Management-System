<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\SavedJobController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});
Auth::routes();
Route::get('/admin/register', [RegisterController::class, 'showAdminRegister'])->name('adminRegister');

Route::middleware(['auth'])->group(function () {
    Route::controller(ApplicantController::class)->group(
        function () {
            Route::get('/applicant/profile/{applicant}', 'show')->name('applicant.profile.show');
            Route::get('/applicant/profile/{applicant}/edit', 'edit')->name('applicant.profile.edit');
            Route::put('/applicant/profile/{applicant}', 'update')->name('applicant.profile.update');
        }
    );

    Route::controller(AdminController::class)->group(
        function () {
            Route::get('/admin/profile/{admin}', 'show')->name('admin.profile.show');
            Route::get('/admin/profile/{admin}/edit', 'edit')->name('admin.profile.edit');
            Route::put('/admin/profile/{admin}', 'update')->name('admin.profile.update');
            Route::get('/companies', 'companiesIndex')->name('companies.index');
            Route::get('/companies/searchBySector', 'companiesSearchBySector')->name('companies.searchBySector');
        }
    );

    Route::resource('/job', JobController::class);
    Route::get('/index', [JobController::class, 'home'])->name('index');

    Route::controller(ApplicationController::class)->group(function () {
        Route::get('/application', 'index')->name('application.index');
        Route::post('/application', 'store')->name('application.store');
        Route::put('/application/{application}', 'update')->name('application.update');
        Route::delete('/application/{application}', 'destroy')->name('application.destroy');
    });

    Route::controller(SavedJobController::class)->group(function () {
        Route::get('/savedJob', 'index')->name('savedJob.index');
        Route::post('/savedJob', 'store')->name('savedJob.store');
        Route::delete('/savedJob/{savedJob}', 'destroy')->name('savedJob.destroy');
    });
});