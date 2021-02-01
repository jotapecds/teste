<?php

namespace App\Http\Middleware;

use Closure;

class AuthAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->is_admin == '1')
            return $next($request);

        else
            return response()->json(['error' => 'Seu usuário não tem permissão para essa ação'], 401);
    }
}
