<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
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

            $roles = Auth::user()->roles;
        if ($roles !== 1) {
            return redirect()->route('admin.ware.index');
        } else {
            return $next($request);
        }
    }
}
