<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExportFormRequest;
use App\Models\Municipality;
use App\Models\Region;
use App\Services\ExportDataService;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ExportController extends Controller
{
    public function export(ExportFormRequest $request): BinaryFileResponse
    {
        if ($request->input('type') === 'all') {
            return response()->download(storage_path("app/public/total.json"), "Skupno.json");
        }


        $type = $request->input('type');
        $id = $request->input('id');

        $data = new ExportDataService();
        if ($data->needsUpdating($type, $id)) {
            $data->generate();
        }
        $name = $type === 'regions' ? Region::find($id)->name : Municipality::find($id)->name;
        return response()->download(storage_path("app/public/{$type}/{$id}.json"), "{$name}.json");
    }
}
