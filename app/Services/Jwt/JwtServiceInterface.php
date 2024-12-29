<?php

namespace App\Services\Jwt;

interface JwtServiceInterface
{
    public function createJwtToken($user);
    public function verifyJwtToken($token);
}
