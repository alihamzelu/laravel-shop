<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MoonShineAdminAccess
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check()) {
            return redirect()->route('moonshine.login');
        }

        if (!auth()->user()->hasAnyRole([
            'super-admin',
            'admin'
        ])) {
            abort(403);
        }

        return $next($request);
    }
}