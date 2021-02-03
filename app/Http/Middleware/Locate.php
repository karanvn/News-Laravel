<?php

namespace App\Http\Middleware;

use Closure;

class Locate
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
        $language = session('site_lang', config('app.locale'));
        config(['app.locale' => $language]);
        return $next($request);
    }
}
