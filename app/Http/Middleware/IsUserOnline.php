<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Carbon\Carbon;
use Cache;

class IsUserOnline
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $expiresAt = Carbon::now()->addMinutes(5);
            Cache::put('user-is-online-' . $user->id, true, $expiresAt);
        }

        return $next($request);
    }

}
