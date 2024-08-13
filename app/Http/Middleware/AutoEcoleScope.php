<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Candidat;
use Illuminate\Support\Facades\Auth;
use App\Models\AutoEcole;
use App\Models\Commune;
use App\Models\CandidatOnline;

class AutoEcoleScope
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
      if (Auth::check() && Auth::user()->auto_ecole_id) {
        // Appliquer le scope global ici, exemple avec Eloquent
        CandidatOnline::addGlobalScope('auto_ecole_id', function ($builder) {
            $builder->where('auto_ecole_id', Auth::user()->auto_ecole_id);
        });
       Candidat::addGlobalScope('auto_ecole_id', function ($builder) {
            $builder->where('auto_ecole_id', Auth::user()->auto_ecole_id);
        });
    }
        return $next($request);
    }
}