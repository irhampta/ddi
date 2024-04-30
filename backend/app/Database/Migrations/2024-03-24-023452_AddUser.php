<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUser extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => 300,
            ],
            'role' => [
                'type' => 'ENUM',
                'constraint' => ['admin', 'pejabat', 'guru', 'staf', 'siswa', 'wali', 'masyarakat'],
                'default'   => 'masyarakat',
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('users');
    }


    public function down()
    {
        $this->forge->dropTable('users');
    }
}