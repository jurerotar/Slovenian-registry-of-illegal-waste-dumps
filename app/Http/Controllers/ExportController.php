<?php

namespace App\Http\Controllers;

use App\Services\ExportService;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function export(Request $request)
    {
        $request->validate([
            'rid' => 'required_without:mid|min:1|max:12|integer',
            'mid' => 'required_without:rid|min:1|max:212|integer'
        ]);

        if ($request->has('rid')) {
            $id = $request->input('rid');
            $type = 'regions';
        } else if ($request->has('mid')) {
            $id = $request->input('mid');
            $type = 'municipalities';
        }

        $exportService = new ExportService($type, $id);
        if ($exportService->needsUpdating()) {
            $exportService->generate();
        }
        return response()->download(storage_path("app/public/{$type}/{$id}.json"), "{$id}.json");
    }
}
