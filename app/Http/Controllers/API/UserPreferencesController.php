<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ColorSchemeRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\App;

class UserPreferencesController extends Controller
{

    public function updateColorScheme(ColorSchemeRequest $request): JsonResponse
    {
        $success = setcookie('color-scheme', $request->input('scheme'), [
            'expires' => strtotime('+1 year'),
            'path' => '/',
            'domain' => request()->getHost(),
            'secure' => App::environment('production'),
            'httponly' => true,
            'samesite' => 'Lax'
        ]);

        return response()->json([
            'success' => $success,
            'message' => ($success) ? 'Success' : 'Failed'
        ]);
    }
}
