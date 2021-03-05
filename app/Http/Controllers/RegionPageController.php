<?php

namespace App\Http\Controllers;

use App\Models\Region;
use App\Traits\MetaInformationTrait;
use Inertia\Inertia;
use Inertia\Response;

class RegionPageController extends Controller
{
    use MetaInformationTrait;

    public function index(Region $region): Response
    {
        // Push title and description to info for vue to use
        $meta = collect([
            'title' => __('meta.region.title', ['name' => $region->name]),
            'desc' => __('meta.region.description', ['name' => $this->declineDescription($region->name)]),
            'page' => 'regija',
        ]);

        return Inertia::render('Region', [
            'meta' => $meta,
        ])->withViewData([
            'title' => $meta->get('title'),
            'description' => $meta->get('desc'),
        ]);
    }
}
