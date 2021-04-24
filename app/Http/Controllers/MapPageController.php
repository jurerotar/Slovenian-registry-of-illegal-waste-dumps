<?php

namespace App\Http\Controllers;

use App\Helpers\InertiaHelper;
use Inertia\Response;

class MapPageController extends Controller
{
    public function show(): Response
    {
        return InertiaHelper::serverRender('Map', [

        ]);
    }
}
