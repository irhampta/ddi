<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TambahPegawai extends Migration
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
            'nama' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'jabatan' => [
                'type' => 'ENUM',
                'constraint' => ['pejabat', 'guru', 'staf'],
                'default'   => 'guru',
            ],
            'posisi' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'avatar' => [
                'type' => 'TEXT',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('pegawai');
    }

    public function down()
    {
        $this->forge->dropTable('pegawai');
    }
}