<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DataWarga extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => TRUE,
            ],
            'nik' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => TRUE,
            ],
            'kk' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => TRUE,
            ],
            'alamat' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => TRUE,
            ]
        ]);
        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('data_warga', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('data_warga');
    }
}
