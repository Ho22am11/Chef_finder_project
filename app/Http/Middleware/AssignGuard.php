<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use JWTAuth;
use Illuminate\Support\Facades\Auth;

class AssignGuard
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next , $guard)
    {
        if (Auth::guard($guard)->check()) {
            return $next($request); // السماح بالاستمرار إذا كان admin
        }

    // إذا لم يكن المستخدم admin، يتم منع الوصول وإرجاع استجابة تتضمن الحارس المستخدم
    return response()->json([
        'error' => 'Unauthorized',
        'massege' => 'You are not an '.$guard
    ], 403);
    }
}
