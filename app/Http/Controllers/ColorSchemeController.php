<?php

namespace App\Http\Controllers;

use App\Http\Requests\ColorSchemeRequest;
use Illuminate\Http\Response;

class ColorSchemeController extends Controller
{
    public function update(ColorSchemeRequest $request): Response
    {
        setcookie('color-scheme', $request->post('scheme'), [
            'expires' => strtotime('+1 year'),
            'path' => '/',
            'domain' => request()->getHost(),
            'secure' => false,
            'httponly' => true,
            'samesite' => 'Lax'
        ]);
        return response()->noContent();
    }
}
