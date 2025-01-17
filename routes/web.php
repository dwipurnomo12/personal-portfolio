<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminHomeSectionController;
use App\Http\Controllers\AdminAboutSectionController;


Route::get('/', function () {
    return view('index');
});


Auth::routes();
Route::group(['middleware' => ['auth']], function () {
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', [HomeController::class, 'index'])->name('home');

        Route::get('/home-section', [AdminHomeSectionController::class, 'index']);
        Route::put('/home-section/{id}', [AdminHomeSectionController::class, 'update']);

        Route::get('/about-section', [AdminAboutSectionController::class, 'index']);
        Route::put('/about-section/{id}', [AdminAboutSectionController::class, 'update']);
    });
});