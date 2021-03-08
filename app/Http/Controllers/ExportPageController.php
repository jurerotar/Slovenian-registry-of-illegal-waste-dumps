<?php

namespace App\Http\Controllers;

use App\Services\ExportFileMetadataService;
use Inertia\Inertia;
use Inertia\Response;

class ExportPageController extends Controller
{
    public function index(): Response
    {

        $meta = collect([
            'title' => __('meta.export.title'),
            'desc' => __('meta.export.description'),
            'page' => 'izvoz',
        ]);
        return Inertia::render('Export', [
            'meta' => $meta,
            'metadata' => $this->metadata(),

        ])->withViewData([
            'title' => $meta->get('title'),
            'description' => $meta->get('desc'),
        ]);
    }

    /**
     * Retrieves metadata for files stored in app/public/{municipalities|regions}
     */
//    #[ArrayShape([
//        'total' => "array",
//        'regions' => "array",
//        'municipalities' => "array"
//    ])]
    private function metadata(): array
    {
        return (new ExportFileMetadataService)->get();
    }
}
