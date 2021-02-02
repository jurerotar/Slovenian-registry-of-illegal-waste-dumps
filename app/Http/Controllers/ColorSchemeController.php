<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ColorSchemeController extends Controller
{
    public function update(Request $request)
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
