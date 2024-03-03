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
        return $this->select('peminjaman.*, buku.Judul, user.Username')
            ->join('buku', 'buku.BukuID = peminjaman.BukuID')
            ->join('user', 'user.UserID = peminjaman.UserID')
            ->where('StatusPeminjaman', 1)
            ->findAll();
    }

    public function getPeminjamanDiizinkan()
    {
        return $this->select('peminjaman.*, buku.Judul, user.Username')
            ->join('buku', 'buku.BukuID = peminjaman.BukuID')
            ->join('user', 'user.UserID = peminjaman.UserID')
            ->where('StatusPeminjaman', 2) // Filter peminjaman yang sudah diizinkan
            ->findAll();
    }

    public function getPeminjamanDiizinkanDanDikembalikan()
    {
        return $this->select('peminjaman.*, buku.Judul, user.Username')
            ->join('buku', 'buku.BukuID = peminjaman.BukuID')
            ->join('user', 'user.UserID = peminjaman.UserID')
            ->whereIn('StatusPeminjaman', [2, 3])
            ->findAll();
    }

    public function getUserData($userID)
    {
        return $this->db->table('user')
            ->select('*')
            ->where('UserID', $userID)
            ->get()
            ->getRowArray();
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

    public function getRiwayatPeminjamanByUserID($userID)
    {
        return $this->select('peminjaman.PeminjamanID, user.Username, buku.Judul, peminjaman.TanggalPeminjaman, peminjaman.TanggalPengembalian, peminjaman.StatusPeminjaman')
                    ->join('user', 'user.UserID = peminjaman.UserID')
                    ->join('buku', 'buku.BukuID = peminjaman.BukuID')
                    ->where('peminjaman.UserID', $userID)
                    ->whereIn('peminjaman.StatusPeminjaman', [2, 3]) // Filter status peminjaman yang sedang dipinjam atau sudah dikembalikan
                    ->findAll();
    }
    

}
