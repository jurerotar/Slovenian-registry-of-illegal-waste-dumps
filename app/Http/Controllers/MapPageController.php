<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class MapPageController extends Controller
{
    public function index(): Response
    {
        $meta = collect([
            'title' => __('meta.map.title'),
            'desc' => __('meta.map.description'),
            'page' => 'zemljevid',
        ]);
        return Inertia::render('Map', [
            'meta' => $meta,

        ])->withViewData([
            'title' => $meta->get('title'),
            'description' => $meta->get('desc'),
        ]);
    }
}
