<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next,...$roleId)
    {
        if (in_array($request->user()->role_id,$roleId)){
            return $next($request);
        }
        return redirect('/');
    }
}
