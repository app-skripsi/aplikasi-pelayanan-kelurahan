<?php

namespace App\Models;

use CodeIgniter\Model;

class DataAdministrasiModel extends Model
{
	protected $table            = 'data_administrasi';
	public function getData($id = false)
	{
		if ($id === false) {
			return $this->table('data_administrasi')
				->get()
				->getResultArray();
		} else {
			return $this->table('data_administrasi')
				->where('data_administrasi.id', $id)
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
}
