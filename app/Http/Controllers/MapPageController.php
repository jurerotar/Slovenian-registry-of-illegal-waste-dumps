<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class MapPageController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Map', [
            /**
             * Sets current page name to 'map'
             */
            'currentPage' => 'zemljevid',
        ])->withViewData([
            'title' => __('meta.map.title'),
            'description' => __('meta.map.description')
        ]);
    }
}
