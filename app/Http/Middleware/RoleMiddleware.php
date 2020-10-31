<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if (strpos($role, '|') !== false) {
            $roles = explode('|', $role);
            $noRoles = true;
            foreach ($roles as $r) {
                if ($request->user()->hasRole($r)) {
                    $noRoles = false;
                }
            }

            if ($noRoles)
                return abort(403);
        } else {
            if (!$request->user()->hasRole($role)) {
                return abort(403);
            }
        }

        return $next($request);
    }
}
