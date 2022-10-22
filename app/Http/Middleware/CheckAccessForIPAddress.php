<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CheckAccessForIPAddress
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
        if (config('app.debug')) {
            return $next($request);
        }

        $admin = User::admin()->first();

        if (!$admin) {
            Log::warning("Please setup the application using `php artisan st:setup` to create a default account.");
            abort(403);
        }

        $requestIp = $request->ip();
        $allowedIp = $admin->allowed_ip;

        if ($admin->restrict_ip_access & $requestIp != $allowedIp) {
            abort(403);
        }

        return $next($request);
    }
}
