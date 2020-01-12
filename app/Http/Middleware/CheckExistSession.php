<?php

namespace App\Http\Middleware;

use Closure;

class CheckExistSession
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
            return $next($request);
        }
        return redirect()->route('login');
    }
}
