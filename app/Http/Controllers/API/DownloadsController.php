<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use function response;

class DownloadsController extends Controller
{
    public function export(string $slug)
    {
        return response()->download(json_encode($slug), $slug);
    }
}
