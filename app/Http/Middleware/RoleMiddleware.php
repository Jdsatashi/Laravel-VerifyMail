<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    protected $roles;

    public function __construct(...$roles)
    {
        $this->roles = $roles;
    }
    public function handle(Request $request, Closure $next)
    {
        if (! $request->user() || ! in_array($request->user()->role, $this->roles)) {
            abort(403, 'Unauthorized');
        }

        return $next($request);    }
}
