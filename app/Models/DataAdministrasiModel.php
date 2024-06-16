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
				->join('status', 'status.id = data_administrasi.status_id')
				->join('pelayanan', 'pelayanan.id = data_administrasi.pelayanan_id')
				->get()
				->getResultArray();
		} else {
			return $this->table('data_administrasi')
				->join('status', 'status.id = data_administrasi.status_id')
				->join('pelayanan', 'pelayanan.id = data_administrasi.pelayanan_id')
				->where('data_administrasi.id', $id)
				->get()
				->getRowArray();
		}
	}

	public function getAllAdministrasi()
	{
		return $this->select('data_administrasi.*, jenis.nama as nama_jenis, pelayanan.pelayanan as nama_pelayanan')
					->join('status', 'status.id = data_administrasi.status_id')
					->join('jenis', 'jenis.id = data_administrasi.jenis_id')
					->join('pelayanan', 'pelayanan.id = data_administrasi.pelayanan_id')
					->findAll();
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
