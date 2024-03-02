<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriRelasiModel extends Model
{
    protected $table = 'kategoribuku_relasi';
    protected $primaryKey = 'KategoriBukuID';
    protected $allowedFields = ['BukuID', 'KategoriID'];

    public function getAllKategoriRelasi()
    {
        return $this->findAll();
    }

    public function getKategoriIDBYBukuID($id = false)
    {
        if ($id === false) {
            // Query tanpa join jika tidak ada parameter id
            return $this->findAll();
        }

        // Query dengan join jika ada parameter id
        return $this->where(['BukuID' => $id])->first();
    }
}
