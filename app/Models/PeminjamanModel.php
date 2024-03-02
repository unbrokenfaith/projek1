<?php

namespace App\Models;

use CodeIgniter\Model;

class PeminjamanModel extends Model
{
    protected $table = 'peminjaman';
    protected $primaryKey = 'PeminjamanID';
    protected $allowedFields = ['UserID', 'BukuID', 'TanggalPeminjaman', 'TanggalPengembalian', 'StatusPeminjaman'];

    public function getAllPeminjaman()
    {
        return $this->findAll();
    }

    public function getBelumDikonfirmasi()
    {
        return $this->where('StatusPeminjaman', 1)->findAll();
    }

    public function addPeminjaman($data)
    {
        return $this->insert($data);
    }

    // Method untuk mengupdate status peminjaman
    public function updateStatusPeminjaman($peminjamanID, $status)
    {
        $this->where('PeminjamanID', $peminjamanID)->set(['StatusPeminjaman' => $status])->update();
    }
}
