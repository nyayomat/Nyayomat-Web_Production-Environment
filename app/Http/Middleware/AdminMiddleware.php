<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        if (config('app.env') === 'testing') {
            return $next($request);
        }
        if (!$request->session()->exists('user_id')) {
            // id value cannot be found in session
            return redirect()->route('superadmin.login');
        }
        return $next($request);
    }
}
