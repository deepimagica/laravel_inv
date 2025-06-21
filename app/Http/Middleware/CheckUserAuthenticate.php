<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function handle(Request $request, Closure $next, $mode = 'user'): Response
    {
        $guard = Auth::guard('user');
        
        if ($mode === 'user' && !$guard->check()) {
            return redirect()->route('login.page');
        }

        if ($mode === 'guest' && $guard->check()) {
            return redirect()->route('user.dashboard');
        }

        return $next($request);
    }
}
