<?php

namespace App\Http\Controllers;

use App\Helpers\InertiaHelper;
use Inertia\Response;

class ReportPageController extends Controller
{
    public function show(): Response
    {
        return InertiaHelper::serverRender('Report', [

        ]);
    }
}
