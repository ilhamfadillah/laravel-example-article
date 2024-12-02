<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenBlacklistedException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenExpiredException;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Symfony\Component\HttpFoundation\Response;

class Jwt
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $exceptions = ['api/login', 'api/register'];
        $current = $request->path();
        if ($request->is('api/*') && !in_array($current, $exceptions)) {
            try {
                $user = JWTAuth::parseToken()->authenticate();
            } catch (TokenExpiredException $e) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Token Expired.',
                    'data' => []
                ], 401);
            } catch (TokenBlacklistedException $e) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Token has been blacklisted.',
                    'data' => []
                ], 401);
            } catch (JWTException $e) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Token Not Valid.',
                    'data' => []
                ], 401);
            }
        }

        return $next($request);
    }
}
