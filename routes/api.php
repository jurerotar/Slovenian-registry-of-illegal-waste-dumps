<?php

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
Route::group(['prefix' => 'exports'], function () {
    Route::get('/', [])
        ->name('api.exports.list');

    Route::get('/all', [])
        ->name('api.exports.all');

    Route::group(['prefix' => 'regions'], function () {
        Route::get('/', [])
            ->name('api.exports.list.regions');
        Route::get('/{region:slug}', [])
            ->name('api.exports.region');
    });

    Route::group(['prefix' => 'municipalities'], function () {
        Route::get('/', [])
            ->name('api.exports.list.municipalities');
        Route::get('/{municipality:slug}', [])
            ->name('api.exports.municipality');
    });

});
