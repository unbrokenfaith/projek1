<?php

namespace App\Controllers;

use App\Models\AuthModel;
use App\Models\BukuModel;
use App\Models\KoleksiModel;
use App\Models\PeminjamanModel;

class PeminjamController extends BaseController
{
    protected $authModel;
    protected $bukuModel;
    protected $peminjamanModel;
    protected $koleksiModel;

    public function __construct()
    {
        $this->authModel = new AuthModel();
        $this->bukuModel = new BukuModel();
        $this->peminjamanModel = new PeminjamanModel();
        $this->koleksiModel = new KoleksiModel();
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

        // Get available books
        $availableBooks = $this->bukuModel->getAvailableBooks();

        $data = [
            'title' => 'Daftar Buku',
            'username' => $username,
            'buku' => $availableBooks,
        ];

        return view('/peminjam/peminjaman/index', $data);
    }

    public function peminjaman($id)
    {
        $userID = session()->get('userID');
        $username = session()->get('username');
        $namaLengkap = session()->get('namaLengkap');

        // Get book information based on $id
        $buku = $this->bukuModel->getBukuById($id);

        $data = [
            'title' => 'Pinjam Buku',
            'username' => $username,
            'namaLengkap' => $namaLengkap,
            'buku' => $buku,
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
        return redirect()->to('/peminjam/buku')->with('success', 'Peminjaman berhasil');
    }

    // Method untuk menambahkan peminjaman baru

    public function riwayat()
    {
        $userID = session()->get('userID');

        // Ambil riwayat peminjaman berdasarkan UserID
        $riwayatPeminjaman = $this->peminjamanModel->getRiwayatPeminjamanByUserID($userID);

        $username = session()->get('username');

        $data = [
            'title' => 'Riwayat Page',
            'username' => $username,
            'riwayatPeminjaman' => $riwayatPeminjaman,
        ];

        return view('/peminjam/riwayatpeminjaman/index', $data);
    }

    public function tambahKoleksi()
    {
        $userID = session()->get('userID');
        $bukuID = $this->request->getPost('BukuID');
    
        // Lakukan validasi data yang diterima
    
        // Simpan data ke dalam tabel KoleksiPribadi
        $data = [
            'UserID' => $userID,
            'BukuID' => $bukuID,
        ];
        $this->koleksiModel->insert($data);
    
        // Beri respons kepada klien
        $response['message'] = 'Buku berhasil ditambahkan ke koleksi pribadi.';
        $response['status'] = 'success'; // tambahkan status ini untuk menandakan bahwa buku telah ditambahkan ke koleksi
        return $this->response->setJSON($response);
    }
    
    public function hapusKoleksi()
    {
        $userID = session()->get('userID');
        $bukuID = $this->request->getPost('bukuID');
    
        // Hapus buku dari koleksi pribadi
        $this->koleksiModel->where('UserID', $userID)->where('BukuID', $bukuID)->delete();
    
        // Beri respons kepada klien
        $response['message'] = 'Buku berhasil dihapus dari koleksi pribadi.';
        $response['status'] = 'success';
        return $this->response->setJSON($response);
    }
    
}
