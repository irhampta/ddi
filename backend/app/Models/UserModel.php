<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table                = 'users';
    protected $returnType           = 'object';

    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;

    protected $protectFields        = true;
    protected $allowedFields        = ['email', 'password', 'role'];

    protected $validationRules  = [
        'email'     => 'required|max_length[100]|valid_email|is_unique[users.email])',
        'password'  => 'required|min_length[3]|max_length[300]',
        'confirm_password'  => 'required|matches[password]',
        'role'   => 'required|in_list[admin,pejabat,guru,staf,siswa,wali,masyarakat]',
    ];

    protected $validationMessages = [
        'email' => [
            'is_unique' => 'Sorry. That email has already been taken. Please choose another.',
        ],
    ];

    protected $allowCallbacks       = true;
    protected $beforeInsert         = ['hashPassword'];

    protected function hashPassword(array $data)
    {
        if (!isset($data['data']['password'])) {
            return $data;
        }

        $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);

        return $data;
    }
}