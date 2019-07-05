<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Hash;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRoot
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
            $password = Auth::user()->password;
            $roles = Auth::user()->roles;
            $email = Auth::user()->email;
            $change = Auth::user()->change;
            if (!$change) {
                return redirect()->route('change');
            } else {
                return $next($request);
            }
        } else {
            return redirect()->route('login');
        }
    }
}
