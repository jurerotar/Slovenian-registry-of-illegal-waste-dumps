<?php

namespace App\Http\Controllers;

use App\Services\ExportFileMetadataService;
use Inertia\Inertia;
use Inertia\Response;
use JetBrains\PhpStorm\ArrayShape;

class ExportPageController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Export', [
            'currentPage' => 'izvoz',
            'metadata' => $this->metadata(),
        ])->withViewData([
            'title' => __('meta.export.title'),
            'description' => __('meta.export.description')
        ]);
    }

    /**
     * Retrieves metadata for files stored in app/public/{municipalities|regions}
     */
    #[ArrayShape([
        'total' => "array",
        'regions' => "array",
        'municipalities' => "array"
    ])]
    private function metadata(): array
    {
        return (new ExportFileMetadataService)->get();
    }
}