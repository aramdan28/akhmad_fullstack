<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use Firebase\JWT\JWT;
use Config\Services;

class JWTAuth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $authHeader = $request->getServer('HTTP_AUTHORIZATION');

        try {
            $encodedToken = $this->getJWTFromRequest($authHeader);
            $this->validateJWTFromRequest($encodedToken);
        } catch (\Exception $e) {
            return Services::response()
                ->setJSON(['message' => $e->getMessage()])
                ->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED);
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }

    private function getJWTFromRequest($authHeader)
    {
        if (!$authHeader) {
            throw new \Exception('Authorization header is missing');
        }

        $token = explode(' ', $authHeader)[1];
        return $token;
    }

    private function validateJWTFromRequest($encodedToken)
    {
        $key = getenv('JWT_SECRET');
        $decodedToken = JWT::decode($encodedToken, new \Firebase\JWT\Key($key, 'HS256'));

        // Optional: Validate token claims, such as issuer and audience
        if ($decodedToken->iss !== 'localhost' || $decodedToken->aud !== 'localhost') {
            throw new \Exception('Invalid token claims');
        }
    }
}
