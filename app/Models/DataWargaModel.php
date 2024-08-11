<?php

namespace App\Models;

use CodeIgniter\Model;

class DataWargaModel extends Model
{
	protected $table            = 'data_warga';
	public function checkNIK($nik)
	{
		return $this->db->table($this->table)->where('nik', $nik)->countAllResults() > 0;
	}

}
