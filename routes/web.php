<?php

use App\Http\Controllers\ExportController;
use App\Http\Controllers\PageDataController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'cookies'], function () {
    Route::get('/', [PageDataController::class, 'home'])->name('home');
    Route::get('/zemljevid', [PageDataController::class, 'map'])->name('map');
    Route::get('/izvoz', [PageDataController::class, 'export'])->name('export');
    Route::get('/prijava', [PageDataController::class, 'report'])->name('report');
    Route::get('/regija/{regions:slug}', [PageDataController::class, 'region'])->name('region');
    Route::get('/obcina/{municipalities:slug}', [PageDataController::class, 'municipality'])->name('municipality');
});

Route::get('/test', [TestController::class, 'index']);
Route::get('/prenos', [ExportController::class, 'export']);
