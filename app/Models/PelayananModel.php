<?php

namespace App\Models;

use CodeIgniter\Model;

class PelayananModel extends Model
{
    protected $table = 'pelayanan';

    public function getData($id = false)
    {
        if ($id === false) {
            return $this->findAll(); // Menggunakan findAll() untuk mengambil semua data jenis
        } else {
            return $this->find($id); // Menggunakan find() untuk mencari data jenis berdasarkan ID
        }
    }

    public function insertData($data)
    {
        return $this->insert($data); // Menyisipkan data baru ke dalam tabel jenis
    }

    public function updateData($data, $id)
    {
        return $this->update($id, $data); // Memperbarui data jenis berdasarkan ID
    }

    public function deleteData($id)
    {
        return $this->delete($id); // Menghapus data jenis berdasarkan ID
    }
    
}
