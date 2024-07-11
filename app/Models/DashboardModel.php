<?php

namespace App\Models;

use CodeIgniter\Model;

class DashboardModel extends Model
{

	public function getCountAdministrasi()
	{
		return $this->db->table("data_administrasi")->countAll();
	}
}
