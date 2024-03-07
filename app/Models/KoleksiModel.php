<?php

namespace App\Models;

use CodeIgniter\Model;

class KoleksiModel extends Model
{
    protected $table = 'koleksipribadi';
    protected $primaryKey = 'KoleksiID';
    protected $allowedFields = ['UserID', 'BukuID'];

    // Fungsi untuk menambah buku ke koleksi pribadi
    public function tambahKoleksi($data)
    {
        return $this->insert($data); // Menggunakan metode insert bawaan CodeIgniter untuk menyisipkan data
    }

    // Fungsi untuk menghapus buku dari koleksi pribadi
    public function hapusKoleksi($userID, $bukuID)
    {
        return $this->where('UserID', $userID)->where('BukuID', $bukuID)->delete();
    }
}
