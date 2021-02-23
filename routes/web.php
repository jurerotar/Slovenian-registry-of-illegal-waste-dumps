<?php

use App\Http\Controllers\ExportController;
use App\Http\Controllers\ExportPageController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\MapPageController;
use App\Http\Controllers\MunicipalityPageController;
use App\Http\Controllers\RegionPageController;
use App\Http\Controllers\ReportPageController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'cookies'], function () {
    Route::get('/', [HomePageController::class, 'index'])->name('home');
    Route::get('/zemljevid', [MapPageController::class, 'index'])->name('map');
    Route::get('/izvoz', [ExportPageController::class, 'index'])->name('export');
    Route::get('/prijava', [ReportPageController::class, 'index'])->name('report');
    Route::get('/regija/{regions:slug}', [RegionPageController::class, 'index'])->name('region');
    Route::get('/obcina/{municipalities:slug}', [MunicipalityPageController::class, 'index'])->name('municipality');

});

Route::get('/prenos', [ExportController::class, 'export']);
Route::get('/test', [TestController::class, 'index']);
