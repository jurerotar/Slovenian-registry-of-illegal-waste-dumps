<?php

use App\Http\Controllers\ExportPageController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\MapPageController;
use App\Http\Controllers\MunicipalityPageController;
use App\Http\Controllers\RegionPageController;
use App\Http\Controllers\ReportPageController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'cookies'], function () {
    Route::get('/', [HomePageController::class, 'show'])->name('home');
    Route::get('/zemljevid', [MapPageController::class, 'show'])->name('map');
    Route::get('/izvoz', [ExportPageController::class, 'show'])->name('export');
    Route::get('/prijava', [ReportPageController::class, 'show'])->name('report');
    Route::get('/obcina/{municipality:slug}', [MunicipalityPageController::class, 'show'])->name('municipality');

});

Route::get('/test', [TestController::class, 'index']);
