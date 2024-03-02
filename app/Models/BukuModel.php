<?php

namespace App\Models;

use CodeIgniter\Model;

class BukuModel extends Model
{
    protected $table = 'buku';
    protected $primaryKey = 'BukuID';
    protected $allowedFields = ['Sampul', 'Judul', 'Penulis', 'Penerbit', 'TahunTerbit', 'Stok'];

    public function getAllBuku()
    {
        return $this->findAll();
    }

    public function getBukuById($id = false)
    {
        if ($id === false) {
            // Query tanpa join jika tidak ada parameter id
            return $this->findAll();
        }

        // Query dengan join jika ada parameter id
        return $this->where(['BukuID' => $id])->first();
    }

    public function getAllBukuWithKategori($kategoriID = null)
    {
        $builder = $this->db->table('buku');
        $builder->select('buku.*, kategoribuku.NamaKategori');
        $builder->join('kategoribuku_relasi', 'kategoribuku_relasi.BukuID = buku.BukuID');
        $builder->join('kategoribuku', 'kategoribuku.KategoriID = kategoribuku_relasi.KategoriID');

        if ($kategoriID !== null) {
            $builder->where('kategoribuku_relasi.KategoriID', $kategoriID);
        }

        return $builder->get()->getResultArray();
    }

    public function getSampulById($id)
    {
        // Ambil data sampul dari database berdasarkan ID
        $query = $this->select('Sampul')->where('BukuID', $id)->first();
        
        // Jika data ditemukan, kembalikan nama file sampul
        if ($query) {
            return $query['Sampul'];
        } else {
            return null; // Jika data tidak ditemukan, kembalikan null
        }
    }

}
