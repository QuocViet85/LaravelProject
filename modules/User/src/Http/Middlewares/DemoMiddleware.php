<?php
namespace Modules\User\src\Http\Middlewares;
use Illuminate\Http\Request;
use Closure;

class DemoMiddleware 
{
    public function handle(Request $request, Closure $next)
    {
        echo 'Demo Middleware';
        return $next($request);
    }
}