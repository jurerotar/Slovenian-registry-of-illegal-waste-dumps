<?php

use App\Http\Controllers\Views\PublicPagesController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

// Use this only for testing purposes
if(App::environment('local')) {
    Route::get('/test', [PublicPagesController::class, 'test']);
}

// Public pages
Route::group(['middleware' => 'cookies'], function () {
    Route::get('/', [PublicPagesController::class, 'home'])
        ->name('views.public.home');

    Route::get('/map', [PublicPagesController::class, 'map'])
        ->name('views.public.map');

    Route::get('/export', [PublicPagesController::class, 'export'])
        ->name('views.public.export');

    Route::get('/report-dump', [PublicPagesController::class, 'reportDump'])
        ->name('views.public.report_dump');

    Route::get('/regions/{region:slug}', [PublicPagesController::class, 'region'])
        ->name('views.public.region');

    Route::get('/municipalities/{municipality:slug}', [PublicPagesController::class, 'municipality'])
        ->name('views.public.municipality');
});


