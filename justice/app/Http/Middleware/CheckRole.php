<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        $user = session('user');

        if (!$user || $user['role'] !== $role) {
            return redirect('/login');
        }

        return $next($request);
    }
}