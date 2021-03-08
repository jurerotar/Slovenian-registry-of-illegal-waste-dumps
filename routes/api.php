<?php

use App\Http\Controllers\ColorSchemeController;
use App\Http\Controllers\ExportController;
use Illuminate\Support\Facades\Route;


Route::post('/updateColorScheme', [ColorSchemeController::class, 'update']);
Route::get('/download', [ExportController::class, 'export']);
