<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\UserModel;

class UserSeeder extends Seeder
{
    public function run()
    {
        $model = model(UserModel::class);

        $adminPassword = 'password';

        $user = [
            'email' => 'irhampta@gmail.com',
            'password' => $adminPassword,
            'confirm_password' => $adminPassword,
            'role'  => 'admin',
        ];

        $model->insert($user);
    }
}