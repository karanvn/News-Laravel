<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;

class CustomerMiddleware
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
        // $idUrl = substr(strrchr(request()->url(),'/'),1);
        if(Auth::check())
            return $next($request);
        else
        {
            return redirect('/');
        }
    }
}
