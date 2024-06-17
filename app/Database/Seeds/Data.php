<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Data extends Seeder
{
    public function run()
	{
		$users = [
			[
				'id'		=> 1,
				'nama_user'	=> 'Yakub',
				'username'	=> 'yakub001',
				'password'	=> 'yakub001',
				'level'		=> 1
			],
			[
				'id'		=> 2,
				'nama_user'	=> 'Ali',
				'username'	=> 'ali001',
				'password'	=> 'ali001',
				'level'		=> 2
			],
		];

       // Check if users data already exists
	   $existingUsers = $this->db->table('users')->countAllResults();
	   if ($existingUsers == 0) {
		   $this->db->table('users')->insertBatch($users);
	   }

		$data_pelayanan = [
            [
                'pelayanan' => 'Pembaharuan KK'
            ],
            [
                'pelayanan' => 'Surat Keterangan Pindah'
            ],
            [
                'pelayanan' => 'Perekaman KTP'
            ],
            [
                'pelayanan' => 'Pembuatan KIA'
            ],
            [
                'pelayanan' => 'Pembuatan Akte Lahir'
            ],
            [
                'pelayanan' => 'Pembuatan Akte Kematian'
            ],
        ];
        // Check if pelayanan data already exists
        $existingPelayanan = $this->db->table('pelayanan')->countAllResults();
        if ($existingPelayanan == 0) {
            $this->db->table('pelayanan')->insertBatch($data_pelayanan);
        }
	}
}
