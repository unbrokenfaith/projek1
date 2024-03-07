<?php

namespace App\Models;

use CodeIgniter\Model;

class UlasanModel extends Model
{
    protected $table = 'ulasanbuku';
    protected $primaryKey = 'UlasanID';
    protected $allowedFields = ['UserID', 'BukuID', 'Ulasan', 'Rating'];

    public function getAllUlasan()
    {
        return $this->findAll();
    }

    public function getUlasanByID($id = false)
    {
        if ($id === false) {
            // Query tanpa join jika tidak ada parameter id
            return $this->findAll();
        }

        // Query dengan join jika ada parameter id
        return $this->where(['UlasanID' => $id])->first();
    }
}
