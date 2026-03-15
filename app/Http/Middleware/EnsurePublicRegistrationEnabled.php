<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsurePublicRegistrationEnabled
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! config('auth.public_register_enabled', true)) {
            abort(404);
        }

        return $next($request);
    }
}

