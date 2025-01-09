<?php
namespace App\Services\Jwt;
use App\Services\BaseService;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JwtService extends BaseService implements JwtServiceInterface
{
    public function __construct()
    {
    }
    public function createJwtToken($user){
        $key = env('JWT_SECRET');
        $payload = [
            'iss' => "fbcl-system",
            'aud' => "fbcl-system",
            'iat' => time(),
            'exp' => time() + 3600,
            'user' => $user
        ];

        return JWT::encode($payload, $key, 'HS256');
    }

    public function verifyJwtToken($token)
    {
        $key = env('JWT_SECRET');
        try {
            $decoded = JWT::decode($token, new Key($key, 'HS256'));
            return (array)$decoded;
        }catch (\Exception $e){
            return ['error' => $e->getMessage()];
        }
    }
}
