<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckIfAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated and is an admin
        if (Auth::check() && Auth::user()->is_admin) {
            return $next($request);
        }

        // Redirect non-admins to user home
        // return redirect()->route('welcome');

        return $next($request);
    }
}
