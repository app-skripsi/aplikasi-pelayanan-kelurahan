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
            'status'                => [
                'type'               => 'enum',
                'constraint'        => "'waiting','proses','verifikasi','eksekusi','done'",
                'null' => TRUE,

            ],
            'kedatangan' => [
                'type' => 'DATE',
                'null' => TRUE,
            ],
            'pelayanan' => [
                'type'               => 'enum',
                'constraint'        => "'pembaharuan_kk','surat_keterangan_pindah','perekaman_ktp','pembuatan_kia','pembuatan_akte_lahir','pembuatan_akte_kematian'",
                'null' => TRUE
            ],
        ]);
        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('data_administrasi', TRUE);
    }
    public function down()
    {
        $this->forge->dropTable('data_administrasi');
    }
}
