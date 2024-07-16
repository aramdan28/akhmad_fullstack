<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

function getJWTFromRequest($authHeader)
{
    if (is_null($authHeader)) {
        throw new Exception('Missing or invalid JWT');
    }

    return explode(' ', $authHeader)[1];
}

function validateJWTFromRequest($encodedToken)
{
    $key = getenv('JWT_SECRET');
    return JWT::decode($encodedToken, new Key($key, 'HS256'));
}
