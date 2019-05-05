<?php

namespace App\Middlewares;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Middleware AccessControlAllow
 *
 * Class AccessControlAllow
 * @package App\Middlewares
 */
class AccessControlAllow
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, $next)
    {
        $resp = $next($request, $response);
        
        return $resp
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', '*')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS, HEAD');
    }
}
