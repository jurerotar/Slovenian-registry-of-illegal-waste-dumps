<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Cookies
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if (!isset($_COOKIE['color-scheme'])) {
            setcookie('color-scheme', 'light', [
                'expires' => strtotime('+1 year'),
                'path' => '/',
                'domain' => request()->getHost(),
                'secure' => false,
                'httponly' => true,
                'samesite' => 'Lax'
            ]);
        }
        return $response;
    }
}
