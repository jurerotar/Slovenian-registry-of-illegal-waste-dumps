<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class ReportPageController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Report', [
            /**
             * Sets current page name to 'report'
             */
            'currentPage' => 'prijava',

        ])->withViewData([
            'title' => __('meta.report.title'),
            'description' => __('meta.report.description')
        ]);
    }
}
