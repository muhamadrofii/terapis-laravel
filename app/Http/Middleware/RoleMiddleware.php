<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  ...$roles
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan masuk terlebih dahulu untuk mengakses halaman ini.');
        }

        $user = Auth::user();

        if (!in_array($user->role, $roles)) {
            // If admin, can access therapist portal as well
            if ($user->role === 'admin' && in_array('therapist', $roles)) {
                return $next($request);
            }

            return redirect()->route('user.dashboard')->with('error', 'Akses Ditolak! Anda tidak memiliki hak akses ke halaman tersebut.');
        }

        return $next($request);
    }
}
