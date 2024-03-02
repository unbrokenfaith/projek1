<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriModel extends Model
{
    protected $table = 'kategoribuku';
    protected $primaryKey = 'KategoriID';
    protected $allowedFields = ['NamaKategori'];

    public function getAllKategori()
    {
        return $this->findAll();
    }

    public function getKategoriByID($id = false)
    {
        if ($id === false) {
            // Query tanpa join jika tidak ada parameter id
            return $this->findAll();
        }

        // Query dengan join jika ada parameter id
        return $this->where(['KategoriID' => $id])->first();
    }
}
