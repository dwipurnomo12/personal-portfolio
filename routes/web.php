<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminHomeSectionController;
use App\Http\Controllers\AdminAboutSectionController;
use App\Http\Controllers\AdminProjectsSectionController;
use App\Http\Controllers\AdminSkillSectionController;
use App\Http\Controllers\AdminToolsSectionController;
use App\Http\Controllers\FrontendCoontroller;


Route::get('/', [FrontendCoontroller::class, 'index']);

Auth::routes();
Route::group(['middleware' => ['auth']], function () {
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', [HomeController::class, 'index'])->name('home');

        Route::get('/home-section', [AdminHomeSectionController::class, 'index']);
        Route::put('/home-section/{id}', [AdminHomeSectionController::class, 'update']);

        Route::get('/about-section', [AdminAboutSectionController::class, 'index']);
        Route::put('/about-section/{id}', [AdminAboutSectionController::class, 'update']);

        Route::get('/skills-section/get-data', [AdminSkillSectionController::class, 'getSkills']);
        Route::resource('/skills-section', AdminSkillSectionController::class);

        Route::get('/tools-section/get-data', [AdminToolsSectionController::class, 'getTools']);
        Route::resource('/tools-section', AdminToolsSectionController::class);

        Route::get('/projects-section/get-data', [AdminProjectsSectionController::class, 'getProjects']);
        Route::resource('/projects-section', AdminProjectsSectionController::class);
    });
});