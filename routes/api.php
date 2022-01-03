<?php

use App\Http\Controllers\API\DownloadsController;
use App\Http\Controllers\API\PublicPagesController;
use App\Http\Controllers\API\UserPreferencesController;
use Illuminate\Support\Facades\Route;

// Public pages
Route::group(['prefix' => 'public'], function () {
    Route::get('/navigation', [PublicPagesController::class, 'navigation'])
        ->name('api.public.navigation');
});

// Preferences
Route::group(['prefix' => 'preferences'], function () {
    Route::group(['middleware' => 'throttle:10,1'], function () {
        Route::post('/update-color-scheme', [UserPreferencesController::class, 'updateColorScheme'])
            ->name('preferences.update-color-scheme');
    });
});


// Downloads
Route::group(['prefix' => 'downloads'], function () {
    Route::get('/{slug}', [DownloadsController::class, 'export'])
        ->name('downloads.export');
});
