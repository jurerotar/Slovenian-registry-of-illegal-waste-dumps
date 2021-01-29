<?php

namespace App\Http\Controllers;

use App\Services\ExportService;

class TestController extends Controller
{
    public function index()
    {
        $exportService = new ExportService();
        $exportService->update();
    }
}
