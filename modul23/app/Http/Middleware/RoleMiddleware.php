<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Middleware role fleksibel, bisa menerima lebih dari 1 role.
     * Contoh pemakaian di route:
     *   Route::middleware(['auth', 'role:admin'])->group(...)
     *   Route::middleware(['auth', 'role:admin,editor'])->group(...)
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (! $request->user() || ! in_array($request->user()->role, $roles)) {
            abort(403, 'Akses ditolak. Anda tidak memiliki role yang sesuai.');
        }

        return $next($request);
    }
}
