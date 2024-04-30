<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\PegawaiModel;
use Faker\Factory;

class PegawaiSeeder extends Seeder
{
    public function run()
    {
        $model = model(PegawaiModel::class);

        $faker = Factory::create('id_ID');

        for ($i = 0; $i < 40; $i++) {

            $data = [
                'nama'      => $faker->name,
                'email'     => $faker->email,
                'jabatan'   => $faker->randomElement(['pejabat', 'guru', 'staf']),
                'posisi'    => $faker->words(3, true),
                'avatar'    => '',
            ];

            $model->insert($data);
        }
    }
}