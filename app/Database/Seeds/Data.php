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
		];

		$this->db->table('users')->insertBatch($users);
	}
}
