<?php

namespace Zix\Core\Http\Middleware;

use Closure;

class SetUserLang
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->user()) {
            app()->setLocale($request->header('Accept-Language') ?: 'ar');
        }
        return $next($request);
    }
}
