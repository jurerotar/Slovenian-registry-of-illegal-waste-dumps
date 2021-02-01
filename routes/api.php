<?php

use App\Http\Controllers\ColorSchemeController;
use Illuminate\Support\Facades\Route;


Route::post('/updateColorScheme', [ColorSchemeController::class, 'update']);
