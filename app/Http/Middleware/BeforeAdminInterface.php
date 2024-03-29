<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class BeforeAdminInterface
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //todo Check for the role once it's specified -refactor
        if (Auth::check())
        {
            return $next($request);
        }

        return redirect()->route('view_login');
    }
}
