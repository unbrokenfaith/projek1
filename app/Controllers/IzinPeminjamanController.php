<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PeminjamanModel;

class IzinPeminjamanController extends BaseController
{
    protected $peminjamanModel;

    public function __construct()
    {
        $this->peminjamanModel = new PeminjamanModel();
    }

    public function index()
    {
        // Ambil daftar peminjaman yang belum dikonfirmasi
        $peminjamanBelumDikonfirmasi = $this->peminjamanModel->getBelumDikonfirmasi();
        $username = session()->get('username');

        $data = [
            'title' => 'Izin Peminjaman Page',
            'username' => $username,
            'peminjaman' => $peminjamanBelumDikonfirmasi
        ];

        // Tampilkan data pada view
        // return view('admin/izinpeminjaman/index', ['peminjamanBelumDikonfirmasi' => $peminjamanBelumDikonfirmasi]);
        return view('/admin/izinpeminjaman/index', $data);
    }

    public function izinkan($id)
    {
        // Proses untuk mengizinkan peminjaman dengan ID tertentu
        // Misalnya, Anda bisa memperbarui status peminjaman menjadi dikonfirmasi

        // Contoh:
        $this->peminjamanModel->updateStatusPeminjaman($id, 2); // Mengubah status peminjaman menjadi 2 (Dikonfirmasi)

        // Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->to('/admin/izinpeminjaman')->with('pesan', 'Peminjaman berhasil diizinkan.');
    }
}
