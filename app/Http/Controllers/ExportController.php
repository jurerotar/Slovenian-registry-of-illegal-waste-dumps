<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExportFormRequest;
use App\Services\ExportDataService;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ExportController extends Controller
{
    public function export(ExportFormRequest $request): BinaryFileResponse
    {
        $slug = $request->input('slug');
        $data = new ExportDataService($slug);
        if ($data->needsUpdating()) {
            $data->generate();
        }

        return response()->download(public_path("download/{$slug}.json"));
    }
}
