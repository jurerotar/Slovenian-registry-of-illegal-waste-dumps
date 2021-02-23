<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class RegionPageController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Region', [
            /**
             * Sets current page name to 'map'
             */
            'currentPage' => 'regija',
        ])->withViewData([
            'title' => __('meta.region.title'),
            'description' => __('meta.region.description')
        ]);
    }
}
