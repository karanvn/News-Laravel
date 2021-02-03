<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;

class AdminMiddleware
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
        if(Auth::check() && (Auth::user()->user_type=='A'))
            return $next($request);
        else
        {
            return redirect('/');
        }
    }
}
