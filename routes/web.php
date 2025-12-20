<?php

use App\Models\ProjectSection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\SearchConsoleController;
use App\Http\Controllers\AdminHomeSectionController;
use App\Http\Controllers\AdminAboutSectionController;
use App\Http\Controllers\AdminIntegrationsController;
use App\Http\Controllers\AdminSkillSectionController;
use App\Http\Controllers\AdminToolsSectionController;
use App\Http\Controllers\AdminProjectsSectionController;
use App\Http\Controllers\AdminExperienceSectionController;
use Spatie\Analytics\Facades\Analytics;
use Spatie\Analytics\Period;


Route::get('/', [FrontendController::class, 'index']);
Route::get('/projects/{id}', function ($id) {
    $project = ProjectSection::findOrFail($id);
    return response()->json($project);
});
Route::post('/send-email', [FrontendController::class, 'sendEmail']);
Route::get('/generate-sitemap', [SitemapController::class, 'generate']);
Route::get('/test-analytics', function () {
    $analytics = app('analytics');
    return $analytics->fetchVisitorsAndPageViews(Period::days(7));
});
Route::get('/debug-analytics', function () {
    return [
        'env' => env('ANALYTICS_PROPERTY_ID'),
        'config' => config('analytics.property_id'),
        'config_file_exists' => file_exists(config_path('analytics.php')),
    ];
});


Auth::routes();
Route::group(['middleware' => ['auth']], function () {
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', [HomeController::class, 'index'])->name('home');

        Route::get('/home-section', [AdminHomeSectionController::class, 'index']);
        Route::put('/home-section/{id}', [AdminHomeSectionController::class, 'update']);

        Route::get('/about-section', [AdminAboutSectionController::class, 'index']);
        Route::put('/about-section/{id}', [AdminAboutSectionController::class, 'update']);

        Route::get('/experience-section', [AdminExperienceSectionController::class, 'index']);
        Route::get('/experience-section/get-data', [AdminExperienceSectionController::class, 'getExperiences']);
        Route::get('/experience-section/create', [AdminExperienceSectionController::class, 'create']);
        Route::post('/experience-section/store', [AdminExperienceSectionController::class, 'store']);
        Route::get('/experience-section/{id}/edit', [AdminExperienceSectionController::class, 'edit']);
        Route::put('/experience-section/{id}', [AdminExperienceSectionController::class, 'update']);
        Route::delete('/experience-section/{id}', [AdminExperienceSectionController::class, 'destroy']);

        Route::get('/skills-section/get-data', [AdminSkillSectionController::class, 'getSkills']);
        Route::resource('/skills-section', AdminSkillSectionController::class);

        Route::get('/tools-section/get-data', [AdminToolsSectionController::class, 'getTools']);
        Route::resource('/tools-section', AdminToolsSectionController::class);

        Route::get('/projects-section/get-data', [AdminProjectsSectionController::class, 'getProjects']);
        Route::get('/projects-section/slug', [AdminProjectsSectionController::class, 'slug']);
        Route::resource('/projects-section', AdminProjectsSectionController::class);

        Route::get('/profile', [AdminProfileController::class, 'index']);
        Route::put('/profile/{id}', [AdminProfileController::class, 'update']);

        Route::get('/integrations', [AdminIntegrationsController::class, 'index']);
        Route::put('/integrations/update', [AdminIntegrationsController::class, 'update']);
        Route::put('/integrations/update-email', [AdminIntegrationsController::class, 'updateEmail']);
    });
});
