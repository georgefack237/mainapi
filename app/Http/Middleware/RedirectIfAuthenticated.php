<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string[]|null  ...$guards
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        switch($guard){
            case 'admin':
            if (Auth::guard($guard)->check()) {
              return redirect('/admin/dashboard');
            }
            break;
            case 'partner':
            if (Auth::guard($guard)->check()) {
              return redirect('/partner');
            }
            break;
            case 'profile':
            if (Auth::guard($guard)->check()) {
              return redirect('/profile/contacts');
            }
            break;
            default:
            if (Auth::guard($guard)->check()) {
              return redirect('/dashboard');
            }
            break;
        }

        return $next($request);
    }
}
