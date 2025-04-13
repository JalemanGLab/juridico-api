<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckIpMiddleware
{
    /**
     * Lista de IPs permitidas
     *
     * @var array
     */
    protected $allowedIps = [
        '127.0.0.1',
        // Agrega aquí más IPs permitidas
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!in_array($request->ip(), $this->allowedIps)) {
            return response()->json([
                'message' => 'Acceso no autorizado. IP no permitida.',
                'ip' => $request->ip()
            ], 403);
        }

        return $next($request);
    }
}
