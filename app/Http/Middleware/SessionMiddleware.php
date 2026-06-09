<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;
use Symfony\Component\HttpFoundation\Response;

class SessionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if($request->hasCookie('session_token')){
            $token = base64_decode($request->cookie('session_token'));

            if(!$token){
                return response()->json([
                    'status' => 'error',
                    'message' => 'Cookie tidak sesuai !'
                ], 401);
            }

            $accessToken = PersonalAccessToken::findToken($token);

            if (!$accessToken) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Unauthenticated'
                ], 401);
            }

            $user = $accessToken->tokenable;

            Auth::setUser($user);

            if (!empty($roles)) {

                $hasRole = collect($roles)
                    ->contains(fn ($role) => $user->hasRole($role));

                if (!$hasRole) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Forbidden'
                    ], 403);
                }
            }
        }

        return $next($request);
    }
}
