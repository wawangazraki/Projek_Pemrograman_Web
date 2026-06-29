<?php

/*
 * app/Http/Middleware/HandleInertiaRequests.php
 * Middleware untuk menangani request umum
 */

namespace App\Http\Middleware;

use Illuminate\Http\Request;

class HandleInertiaRequests
{
    /**
     * Menangani request yang masuk
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, $next)
    {
        return $next($request);
    }
}
