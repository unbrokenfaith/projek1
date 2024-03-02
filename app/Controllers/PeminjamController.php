<?php

namespace App\Controllers;

use App\Models\AuthModel;
use App\Models\BukuModel;
use App\Models\PeminjamanModel;

class PeminjamController extends BaseController
{
    protected $authModel;
    protected $bukuModel;
    protected $peminjamanModel;

    public function __construct()
    {
        $this->authModel = new AuthModel();
        $this->bukuModel = new BukuModel();
        $this->peminjamanModel = new PeminjamanModel();
    }
    public function index(): string
    {
        $username = session()->get('username');

        $data = [
            'title' => 'Peminjam Page',
            'username' => $username,
        ];

        return view('/peminjam/index', $data);
    }

    public function buku()
    {
        $username = session()->get('username');

        $data = [
            'title' => 'Daftar Buku',
            'username' => $username,
            'buku' => $this->bukuModel->getAllBuku(),
        ];

        return view('/peminjam/peminjaman/index', $data);
    }

    public function peminjaman($id)
    {
        $userID = session()->get('userID');
        $username = session()->get('username');
        $namaLengkap = session()->get('namaLengkap');

        $data = [
            'title' => 'Pinjam Buku',
            'username' => $username,
            'namaLengkap' => $namaLengkap,
            'buku' => $this->bukuModel->getBukuById($id),
            'userID' => $userID,
        ];

        return view('/peminjam/peminjaman/create', $data);
    }

    public function konfirmasi()
    {
        // Ambil data dari formulir
        $userID = session()->get('userID');

        // if (!$userID) {
        //     // Jika UserID tidak tersedia, lakukan sesuatu, misalnya redirect ke halaman lain atau tampilkan pesan kesalahan
        //     return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu');
        // }

        $bukuID = $this->request->getPost('BukuID');
        $tanggalPeminjaman = $this->request->getPost('tanggalPeminjaman');

        // Persiapkan data peminjaman
        $dataPeminjaman = [
            'UserID' => $userID,
            'BukuID' => $bukuID,
            'TanggalPeminjaman' => $tanggalPeminjaman,
            'StatusPeminjaman' => 1, // Default status belum dikonfirmasi
        ];

        // Simpan data peminjaman ke dalam database
        $this->peminjamanModel->insert($dataPeminjaman);

        // Redirect setelah berhasil menyimpan
        return redirect()->to('/peminjam/buku')->with('success', 'Peminjaman berhasil dikonfirmasi');
    }

    // Method untuk menambahkan peminjaman baru
    public function addPeminjaman($data)
    {
        return $this->insert($data);
    }

    // Method untuk mengupdate status peminjaman
    public function updateStatusPeminjaman($peminjamanID, $status)
    {
        $this->where('PeminjamanID', $peminjamanID)->set(['StatusPeminjaman' => $status])->update();
    }

    public function coba()
    {

    }
}
