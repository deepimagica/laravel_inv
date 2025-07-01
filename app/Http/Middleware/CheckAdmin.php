<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function handle(Request $request, Closure $next, $mode = 'admin'): Response
    {
        $guard = Auth::guard('admin');

        if ($mode === 'admin' && !$guard->check()) {
            return redirect()->route('admin.login.page');
        }

        if ($mode === 'guest' && $guard->check()) {
            return redirect()->route('admin.dashboard');
        }
        return $next($request);
    }
}
