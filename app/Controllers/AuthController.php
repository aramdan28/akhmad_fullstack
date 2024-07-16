<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\RESTful\ResourceController;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthController extends ResourceController
{
    public function register()
    {
        $userModel = new UserModel();
        $data = $this->request->getJSON(true);

        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

        if ($userModel->insert($data)) {
            return $this->respondCreated(['message' => 'User registered successfully']);
        } else {
            return $this->fail($userModel->errors());
        }
    }

    public function login()
    {
        $userModel = new UserModel();
        $data = $this->request->getJSON(true);


        $user = $userModel->where('email', $data['email'])->first();
        if (!$user || !password_verify($data['password'], $user['password'])) {
            return $this->failUnauthorized('Password Salah');
        }

        $key = getenv('JWT_SECRET');
        $payload = [
            'iss' => 'localhost',
            'aud' => 'localhost',
            'iat' => time(),
            'nbf' => time(),
            'exp' => time() + 3600,
            'data' => ['id' => $user['id'], 'email' => $user['email']]
        ];


        $token = JWT::encode($payload, $key, 'HS256');


        return $this->respond(['token' => $token, 'id_user' => $user['id'], 'id_role' => $user['id_role']]);
    }
}
