<?php

namespace App\Http\Middleware;

use Closure;

class CheckLoginPage
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
        if (session()->exists(['empid', 'grpid', 'full_name', 'userImage']) === true) {
            return back()->withInput();
        }
        return $next($request);
    }
}
