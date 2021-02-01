<?php

namespace App\Http\Middleware;

use Closure;

class CORS
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
        $resposta = $next($request);

        $resposta->header('Access-control-Allow-Origin', '*');
        $resposta->header('Access-control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
        $resposta->header('Access-control-Allow-Headers', 'Authorization, Content-Type');

        return $resposta;
    }
}
