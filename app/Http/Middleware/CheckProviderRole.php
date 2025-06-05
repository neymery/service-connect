<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckProviderRole
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check() || Auth::user()->role !== 'prestataire') {
            return redirect('/home')->with('error', 'Accès réservé aux prestataires');
        }

        return $next($request);
    }
}
