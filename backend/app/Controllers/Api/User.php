<?php

namespace App\Controllers\Api;

use App\Models\UserModel;
use CodeIgniter\RESTful\ResourceController;

class User extends ResourceController
{

    public function __construct()
    {
        $this->model = model(UserModel::class);
    }

    public function index()
    {
        //
    }

    public function register()
    {

        $password = esc($this->request->getVar('password'));
        $confirmPassword = esc($this->request->getVar('confirm_password'));

        $user = [
            'email'             => esc($this->request->getVar('email')),
            'password'          => $password,
            'confirm_password'  => $password == $confirmPassword ? $password : '',
            'role'              => 'masyarakat'
        ];

        if ($this->model->insert($user) === false) {
            return $this->failValidationErrors($this->model->errors());
        }

        $user['password'] = '';
        $user['confirm_password'] = '';

        $responseBody['data']['user'] = $user;

        return $this->respondCreated($responseBody);
    }

    public function login()
    {

        $email = esc($this->request->getVar('email'));

        $user = $this->model->where('email', $email)->first();

        if (!isset($user)) {
            // login failed : unregistered email
            return $this->fail(['messages' => ['email' => $email . ' tidak terdaftar']]);
        }

        $password = esc($this->request->getVar('password'));
        // $hashedPassword = md5($password);

        if (!password_verify($password, $user->password)) {
            // login failed : wrong password
            // dd($password, $user->password);
            return $this->fail(['messages' => ['password' => 'password salah.']]);
        }

        // login success
        return $this->respond($user);
    }

    public function logout()
    {
        //
    }
}