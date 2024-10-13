<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            return response()->json([
                'code' => 401,
                'message' => 'Unauthorized: Please log in.'
            ], 401);
        }

        // Check if the user has the admin role
        if (Auth::user()->role == 'admin') {
            return $next($request);
        } else {
            // Return a forbidden response for non-admin users
            return response()->json([
                'code' => 403,
                'message' => 'Forbidden: You do not have permission to access this resource.'
            ], 403);
        }
    }
}
