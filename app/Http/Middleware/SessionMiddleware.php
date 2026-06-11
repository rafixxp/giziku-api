<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;
use Symfony\Component\HttpFoundation\Response;

class SessionMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!$request->hasCookie('session_token')) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthenticated'
            ], 401);
        }

        $token = base64_decode($request->cookie('session_token'));

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
            $origin = $request->header('Origin');
            $allowed = [
                'admin' => 'https://admin.giziku.id',
                'nutritionist' => 'https://giziku.id'
            ];

            $authorized = false;

            foreach ($roles as $role) {
                if ($user->hasRole($role) && isset($allowed[$role]) && $origin === $allowed[$role]) {
                    $authorized = true;
                    break;
                }
            }

            if (!$authorized) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Forbidden'
                ], 403);
            }
        }

        return $next($request);
    }
}