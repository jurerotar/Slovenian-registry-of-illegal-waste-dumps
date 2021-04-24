<?php

namespace App\Http\Controllers;

use App\Helpers\InertiaHelper;
use App\Services\ExportFileMetadataService;
use Inertia\Response;

class ExportPageController extends Controller
{
    public function show(): Response
    {
        return InertiaHelper::serverRender('Export', [
            'metadata' => $this->metadata(),
        ]);
    }

    /**
     * Retrieves metadata for files stored in app/public/{municipalities|regions}
     */
    private function metadata(): array
    {
        return (new ExportFileMetadataService)->get();
    }
}
