<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\PatientModel;
use CodeIgniter\RESTful\ResourceController;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthController extends ResourceController
{
    public function register()
    {
        $userModel = new UserModel();
        $patientModel = new PatientModel();
        $data = $this->request->getJSON(true);


        $datau['id_role'] = '3';
        $datau['email'] = $data['email'];
        $datau['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        $datap['name'] = $data['name'];
        $datap['address'] = $data['address'];
        $datap['age'] = $data['age'];

        foreach ($data as $key => $value) {

            if (strlen($value) < 6 && $key != 'age') {
                return $this->respondCreated(['status' => '200', 'sts' => 'error', 'messages' => ["error" => 'semua kolom tidak boleh kosong atau kurang dari 6 huruf']]);
            }
        }

        $cekemail = $userModel->where('email')->get()->getResultArray();

        if (count($cekemail) > 0) {
            return $this->respondCreated(['status' => '200', 'sts' => 'error', 'messages' => ["error" => 'email sudah terdaftar']]);
        }

        if ($userModel->insert($datau)) {
            $datap['id_user'] = $userModel->getInsertID();

            if ($patientModel->insert($datap)) {
                return $this->respondCreated(['status' => '200', 'sts' => 'ok', 'messages' => ["success" => 'Berhasil mendaftar, silahkan untuk masuk']]);
            } else {
                return $this->respond(['status' => '200', 'sts' => 'error', 'messages' =>  ["error" => 'Gagal mendaftar, silahkan hubungi admin']]);
            }
        } else {
            return $this->respond(['status' => '200', 'sts' => 'error', 'messages' =>  ["error" => 'Gagal mendaftar, silahkan hubungi admin']]);
        }
    }

    public function login()
    {
        $userModel = new UserModel();
        $data = $this->request->getJSON(true);

        if ($data['email'] == '' || strlen($data['email']) < 10) {

            return $this->respond(['messages' => ["error" => 'Format email salah atau karakter email tidak boleh kurang dari 10 huruf']]);
        }
        if ($data['password'] == '' || strlen($data['password']) < 6) {

            return $this->respond(['messages' =>  ["error" => 'Karakter kata sandi tidak boleh kurang dari 6 huruf']]);
        }

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
