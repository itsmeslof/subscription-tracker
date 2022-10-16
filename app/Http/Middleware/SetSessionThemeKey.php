<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetSessionThemeKey
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
        $session = $request->session();

        if (!auth()->check()) {
            $session->put('theme', 'system');
            return $next($request);
        }

        $theme = auth()->user()->theme;

        if (!in_array($theme, ['light', 'dark', 'system'])) {
            $theme = 'system';
        }

        $session->put('theme', $theme);

        return $next($request);
    }
}
