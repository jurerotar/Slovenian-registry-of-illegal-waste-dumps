<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class MunicipalityPageController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Municipality', [
            /**
             * Sets current page name to 'municipality'
             */
            'currentPage' => 'municipality',

        ])->withViewData([
            'title' => __('meta.municipality.title'),
            'description' => __('meta.municipality.description')
        ]);
    }
}
