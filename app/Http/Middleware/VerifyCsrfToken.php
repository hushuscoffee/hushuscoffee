<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'api/*'
    ];

    // public function handle($request, Closure $next)
    // {
    //     if ($request->is('api/*'))
    //     {
    //         return $next($request);
    //     }
    
    //     return parent::handle($request, $next);
    // }
}
