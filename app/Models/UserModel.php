<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
	protected $table = 'users';

	public function getData($id = false)
	{
		if ($id === false) {
			return $this->table('users')
				->get()
				->getResultArray();
		} else {
			return $this->table('users')
				->where('users.id', $id)
				->get()
				->getRowArray();
		}
	}


	public function insertData($data)
	{
		return $this->db->table($this->table)->insert($data);
	}

	public function updateData($data, $id)
	{
		return $this->db->table($this->table)->update($data, ['id' => $id]);
	}


	public function deleteData($id)
	{
		return $this->db->table($this->table)->delete(['id' => $id]);
	}

	public function cek_login($username, $password)
	{
		return $this->db->table('users')
			->where(array('username' => $username, 'password' => $password))
			->get()->getRowArray();
	}
}
