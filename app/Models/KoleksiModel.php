<?php

namespace App\Models;

use CodeIgniter\Model;

class KoleksiModel extends Model
{
    protected $table = 'koleksipribadi';
    protected $primaryKey = 'KoleksiID';
    protected $allowedFields = ['UserID', 'BukuID'];

    public function tambahKoleksi($data)
    {
        return $this->insert($data); // Menggunakan metode insert bawaan CodeIgniter untuk menyisipkan data
    }
}