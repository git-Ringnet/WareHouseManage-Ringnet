<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, string $role)
    {
        $user = Auth::user();
        if (!empty($user)) {
            if ($role == 'admin' && $user->roleid != 1) {
                return redirect()->back();
                abort(code: 403);
            }
            if ($role == 'sale' && $user->roleid != 2) {
                abort(code: 403);
            }
            if ($role == 'manager' && $user->roleid != 3) {
                abort(code: 403);
            }
        }

        return $next($request);
    }
}
