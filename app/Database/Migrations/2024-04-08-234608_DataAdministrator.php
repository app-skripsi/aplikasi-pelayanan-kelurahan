<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DataAdministrator extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
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
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['waiting', 'proses', 'verifikasi', 'eksekusi', 'done'],
                'null'       => true,
            ],
            'kedatangan' => [
                'type' => 'DATE',
                'null' => TRUE,
            ],
            'pelayanan_id' => [
                'type' => 'INT',
                'constraint'        => 5,
                'unsigned'          => true,
                'null'              => true,
            ],
        ]);
        $this->forge->addKey('id', TRUE);
        $this->forge->addForeignKey('pelayanan_id', 'pelayanan', 'id', 'cascade', 'cascade');
        $this->forge->createTable('data_administrasi', TRUE);
    }
    public function down()
    {
        $this->forge->dropTable('data_administrasi');
    }
}
