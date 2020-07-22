<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;
use Illuminate\Support\Facades\Log;

class AuthJwtMiddleware
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
        $token = $request->bearerToken('token');

        if(!$token) {
            Log::error('Token not provided.');
            // Unauthorized response if token not there
            return response()->json([
                'error' => 'Token not provided.'
            ], 401);
        }
        try {
            $credentials = JWT::decode($token, env('JWT_SECRET'), ['HS256']);
            if (!$credentials) {
                Log::error('An error while decoding token.');

                return response()->json([
                    'error' => 'An error while decoding token.'
                ], 400);
            }else {
                Log::info('Access Success');
                
                return $next($request);
            }
        } catch(ExpiredException $e) {
            Log::error('Provided token is expired.');

            return response()->json([
                'error' => 'Provided token is expired.'
            ], 400);
        } catch(Exception $e) {
            Log::error('An error while decoding token.');

            return response()->json([
                'error' => 'An error while decoding token.'
            ], 400);
        }
    }
}
