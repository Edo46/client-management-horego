<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class CheckRole
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */

    public function handle($request, Closure $next, ...$roles)
    {
        $user = Auth::user();
        foreach($roles as $role) {
            // Check if user has the role This check will depend on how your roles are set up
            if($user->hasRole($role))
                return $next($request);
        }
        return response()->view('layouts.404');
    }
}
