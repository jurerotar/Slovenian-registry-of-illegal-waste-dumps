<?php

use App\Http\Controllers\ExportController;
use App\Http\Controllers\PageDataController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'cookies'], function () {
    Route::get('/', [PageDataController::class, 'home'])->name('home');
    Route::get('/export', [PageDataController::class, 'export'])->name('export');
    Route::get('/report', [PageDataController::class, 'report'])->name('report');
    Route::get('/region/{id}', [PageDataController::class, 'region'])->name('region');
    Route::get('/municipality/{id}', [PageDataController::class, 'municipality'])->name('municipality');
});

Route::get('/test', [TestController::class, 'index']);
Route::get('/download', [ExportController::class, 'export']);
