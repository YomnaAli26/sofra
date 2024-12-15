<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Symfony\Component\HttpFoundation\Response;

class AutoCheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $routeName = $request->route()->getName();
        $permission = Permission::query()->whereJsonContains("routes", $routeName)->first();
        if ($permission) {
            if ($request->user()->cannot($permission->name)) {
                abort(403);
            }

        }
        return $next($request);
    }
}
