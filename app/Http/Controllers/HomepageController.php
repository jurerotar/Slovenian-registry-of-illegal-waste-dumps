<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class HomepageController extends Controller
{
    public function show(): Response
    {
        return Inertia::render('Home', [
            'app' => 'Jure je bog'
        ]);
    }

}
