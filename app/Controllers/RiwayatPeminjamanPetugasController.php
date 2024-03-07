<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PeminjamanModel;
use \Dompdf\Dompdf;

class RiwayatPeminjamanPetugasController extends BaseController
{
    protected $peminjamanModel;

    public function __construct()
    {
        $this->peminjamanModel = new PeminjamanModel();
    }

    // Pada controller IzinPeminjamanController
    public function index()
    {
        // Ambil daftar peminjaman yang diizinkan dan dikembalikan
        $peminjamanDiizinkanDanDikembalikan = $this->peminjamanModel->getPeminjamanDiizinkanDanDikembalikan();

        // Ambil username dari sesi
        $username = session()->get('username');

        // Kirim data ke view
        $data = [
            'title' => 'Riwayat Peminjaman Page',
            'username' => $username,
            'peminjaman' => $peminjamanDiizinkanDanDikembalikan,
        ];

        return view('/petugas/riwayatpeminjaman/index', $data);
    }

    public function generateLaporan() {
        // Ambil data peminjaman
        $peminjaman = $this->peminjamanModel->getPeminjamanDiizinkanDanDikembalikan();
        
        // Load view ke dalam string
        $html = view('/generatelaporan/laporan_pdf', ['peminjaman' => $peminjaman]);
        
        // Setup Dompdf
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        
        // (Opsional) Atur ukuran dan orientasi halaman
        $dompdf->setPaper('A4', 'landscape');
        
        // Render PDF
        $dompdf->render();
        
        // Output file PDF ke browser atau simpan ke file
        $dompdf->stream("laporan_peminjaman.pdf", array("Attachment" => false));
    }
    

    public function kembalikanPeminjaman($id)
    {
        // Ambil data tanggal pengembalian dari formulir
        $tanggalPengembalian = $this->request->getPost('tanggal_pengembalian');

        // Lakukan validasi tanggal pengembalian
        if (empty($tanggalPengembalian)) {
            return redirect()->back()->withInput()->with('error', 'Tanggal pengembalian harus diisi.');
        }

        // Lakukan operasi untuk menyimpan tanggal pengembalian ke dalam tabel peminjaman dan mengubah status peminjaman menjadi '3'
        $data = [
            'TanggalPengembalian' => $tanggalPengembalian,
            'StatusPeminjaman' => 3, // Ubah status peminjaman menjadi '3'
        ];

        // Simpan data ke dalam tabel peminjaman
        $this->peminjamanModel->update($id, $data);

        // Redirect atau kembali ke halaman riwayat peminjaman
        return redirect()->to('/petugas/riwayatpeminjaman')->with('success', 'Peminjaman telah dikembalikan.');
    }
}
