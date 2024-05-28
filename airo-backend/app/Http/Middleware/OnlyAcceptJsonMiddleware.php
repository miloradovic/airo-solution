<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class OnlyAcceptJsonMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $header = $request->header('Accept');
        if ($header != 'application/json') {
            return response(['message' => 'Only accept application/json requests'], 406);
        }

        if (!$request->isMethod('post')) return $next($request);

        $header = $request->header('Content-type');
        if (!Str::contains($header, 'application/json')) {
            return response(['message' => 'Content-Type must be application/json'], 406);
        }

        return $next($request);
    }
}
