<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class ReportPageController extends Controller
{
    public function index(): Response
    {
        $meta = collect([
            'title' => __('meta.report.title'),
            'desc' => __('meta.report.description'),
            'page' => 'prijava',
        ]);

        return Inertia::render('Report', [
            'meta' => $meta,

        ])->withViewData([
            'title' => $meta->get('title'),
            'description' => $meta->get('desc'),
        ]);
    }
}
