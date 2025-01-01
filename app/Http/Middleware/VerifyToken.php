<?php

namespace App\Http\Middleware;

use Closure;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;

class VerifyToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\JsonResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $this->verifyToken($request);

        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $request->attributes->add(['user' => $user]);
        $request->auth = $user;
        return $next($request);
    }

    /**
     * Verify the JWT token from the request.
     *
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */
    public function verifyToken(Request $request)
    {
        $authHeader = $request->header('Authorization');
        if (!$authHeader || !str_starts_with($authHeader, 'Bearer ')) {
            return false;
        }

        // Tách token từ header
        $token = substr($authHeader, 7);
        if (!$token) {
            $token = $request->input('token');
        }
        if (!$token || $token == 'null') {
            return false;
        }
        if ($token === env('TOKEN_TO_SERVER')) {
            $userID = $request->input('user_id', 0);
            $user   = [
                'id'            => $userID,
                'email'         => "",
                'phone'         => "",
            ];
            return $user;
        }

        try {
            $decode_token = JWT::decode($token, new Key(env('JWT_SECRET'), 'HS256'));
        } catch (ExpiredException|\Exception $e) {
            return false;
        }
        $tokenData = (array)$decode_token;
        $user = (array)$tokenData['user'];
        return $user;
    }
}
