<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;
use Config\Services;

class JWTAuth implements FilterInterface
{
    protected $key = 'DxcYde3MwhOgNEQ132QPdSBLw05LrFjd183';

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
        // Do something after the controller has executed
    }

    protected function getJWTFromRequest($authHeader)
    {
        if (empty($authHeader)) {
            throw new \Exception('Authorization header is missing');
        }

        if (!preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
            throw new \Exception('Invalid authorization header format');
        }

        return $matches[1];
    }

    protected function validateJWTFromRequest($encodedToken)
    {
        try {
            JWT::decode($encodedToken, new Key($this->key, 'HS256'));
        } catch (\Exception $e) {
            throw new \Exception('Invalid token: ' . $e->getMessage());
        }
    }
}
