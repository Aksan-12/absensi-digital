<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth; // <-- 1. IMPORT FASSAD AUTH

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 2. GANTI auth() MENJADI Auth::
        if (Auth::check() && Auth::user()->role == 'admin') {
            return $next($request);
        }

        // Jika tidak, kembalikan ke dashboard
        return redirect('/dashboard')->with('error', 'Anda tidak memiliki akses admin.');
    }
}
