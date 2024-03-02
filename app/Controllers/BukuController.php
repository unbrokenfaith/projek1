<?php

namespace App\Controllers;

use App\Models\BukuModel;
use App\Models\KategoriModel;
use App\Models\KategoriRelasiModel;

class BukuController extends BaseController
{
    protected $bukuModel;
    protected $kategoriModel;
    protected $kategoriRelasiModel;

    public function __construct()
    {
        $this->bukuModel = new BukuModel();
        $this->kategoriModel = new KategoriModel();
        $this->kategoriRelasiModel = new KategoriRelasiModel();
    }
    public function index(): string
    {
        // Mendapatkan daftar kategori dari model kategori
        $kategoriModel = new KategoriModel(); // Ganti KategoriModel dengan nama model yang sesuai
        $kategori_filter = $kategoriModel->findAll();

        // Mendapatkan data buku beserta KategoriID menggunakan join
        $selectedKategori = $this->request->getVar('kategori_filter'); // Ambil nilai kategori yang dipilih dari request
        $buku = $this->bukuModel->getAllBukuWithKategori($selectedKategori); // Panggil method yang ada di model untuk mendapatkan buku berdasarkan kategori

        $username = session()->get('username');

        $data = [
            'title' => 'Buku Page',
            'buku' => $buku,
            'kategori_filter' => $kategori_filter,
            'selectedKategori' => $selectedKategori, // Set nilai selectedKategori
            'username' => $username,
        ];

        return view('/admin/buku/index', $data);
    }

    public function filter($kategoriID)
    {
        // Mendapatkan daftar kategori dari model kategori
        $kategoriModel = new KategoriModel(); // Ganti KategoriModel dengan nama model yang sesuai
        $kategori_filter = $kategoriModel->findAll();

        // Mendapatkan data buku berdasarkan kategori yang dipilih
        $buku = $this->bukuModel->getAllBukuWithKategori($kategoriID);

        $username = session()->get('username');

        $data = [
            'title' => 'Buku Page',
            'buku' => $buku,
            'kategori_filter' => $kategori_filter,
            'selectedKategori' => $kategoriID, // Set nilai selectedKategori
            'username' => $username,
        ];

        return view('/admin/buku/index', $data);
    }

    public function create()
    {
        $username = session()->get('username');

        // Mengambil daftar kategori dari model KategoriModel
        $kategoriModel = new KategoriModel();
        $kategoriOptions = $kategoriModel->findAll();

        $data = [
            'title' => 'Tambah Data Buku',
            'acara' => $this->bukuModel->getAllBuku(),
            'username' => $username,
            'kategoriOptions' => $kategoriOptions, // Menyediakan opsi pilihan kategori
        ];

        return view('/admin/buku/create', $data);
    }

    public function save()
    {
        $validation = \Config\Services::validation();

        $valid = $this->validate([
            'Sampul' => [
                'rules' => 'max_size[Sampul,1024]|is_image[Sampul]|mime_in[Sampul,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar melebihi batas maksimal.',
                    'is_image' => 'Yang Anda pilih bukan gambar.',
                    'mime_in' => 'Yang Anda pilih bukan gambar.',
                ],
            ],
            'Judul' => [
                'rules' => 'required|is_unique[buku.Judul]',
                'errors' => [
                    'required' => 'Judul harus diisi.',
                    'is_unique' => 'Judul sudah ada.',
                ],
            ],
            'Penulis' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Penulis harus diisi.',
                ],
            ],
            'Penerbit' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Penerbit harus diisi.',
                ],
            ],
            'TahunTerbit' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tahun Terbit harus diisi.',
                ],
            ],
            'Stok' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Stok harus diisi.',
                ],
            ],
        ]);

        // ambil gambar
        $fileSampul = $this->request->getFile('Sampul');
        // apakah tidak ada gambar yang diupload
        if ($fileSampul->getError() == 4) {
            $namaSampul = 'default.jpeg';
        } else {
            // generate nama sampul random
            $namaSampul = $fileSampul->getRandomName();
            // pindahkan file ke folder img
            $fileSampul->move('img', $namaSampul);
        }

        if (!$valid) {
            $sessErr = [
                'errJudul' => $validation->getError('Judul'),
                'errPenulis' => $validation->getError('Penulis'),
                'errPenerbit' => $validation->getError('Penerbit'),
                'errTahunTerbit' => $validation->getError('TahunTerbit'),
                'errStok' => $validation->getError('Stok'),
                'errSampul' => $validation->getError('Sampul'),
            ];

            session()->setFlashdata($sessErr);
            return redirect()->to(base_url('/admin/buku/create'))->withInput();
        } else {
            //  Simpan data buku
            $this->bukuModel->save([
                'Judul' => $this->request->getVar('Judul'),
                'Penulis' => $this->request->getVar('Penulis'),
                'Penerbit' => $this->request->getVar('Penerbit'),
                'TahunTerbit' => $this->request->getVar('TahunTerbit'),
                'Stok' => $this->request->getVar('Stok'),
                'Sampul' => $namaSampul,
            ]);

            $bukuId = $this->bukuModel->insertID();

            // Simpan data relasi ke dalam tabel kategoribuku_relasi
            $this->kategoriRelasiModel->insert([
                // Kolom KategoriBukuID diisi null atau tidak diisi karena akan otomatis bertambah nilainya
                'BukuID' => $bukuId,
                'KategoriID' => $this->request->getVar('KategoriID'),
            ]);

            session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

            return redirect()->to('/admin/buku');
        }
    }

    public function delete($id)
    {
        // Cek apakah ada relasi terkait dengan buku yang akan dihapus
        $kategoriRelasi = $this->kategoriRelasiModel->where('BukuID', $id)->findAll();

        // Jika ada relasi, hapus relasi terlebih dahulu
        if ($kategoriRelasi) {
            foreach ($kategoriRelasi as $relasi) {
                $this->kategoriRelasiModel->delete($relasi['KategoriBukuID']);
            }
        }

        // cari gambar berdasarkan id
        $buku = $this->bukuModel->find($id);

        // cek jika file gambarnya default.jpeg
        if ($buku['Sampul'] != 'default.jpeg') {
            // hapus gambar
            unlink('img/' . $buku['Sampul']);
        }

        $this->bukuModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/admin/buku');
    }

    public function edit($id)
    {
        $username = session()->get('username');

        // Mendapatkan daftar kategori yang terkait dengan buku dari model KategoriRelasiModel
        $kategoriRelasiModel = new KategoriRelasiModel();
        $kategoriID = $kategoriRelasiModel->getKategoriIDByBukuID($id);

        // Mengambil daftar kategori dari model KategoriModel
        $kategoriModel = new KategoriModel();
        $kategoriOptions = $kategoriModel->findAll();

        $data = [
            'title' => 'Form Edit Data Buku',
            'buku' => $this->bukuModel->getBukuById($id),
            'kategoriOptions' => $kategoriOptions,
            'kategoriID' => $kategoriID,
            'selectedKategori' => $kategoriID['KategoriID'], // Set nilai selectedKategori
            'username' => $username,
        ];

        return view('/admin/buku/edit', $data);
    }

    public function update($id)
    {
        // Cek Buku
        $bukuLama = $this->bukuModel->getBukuById($this->request->getVar('BukuID'));

        if ($bukuLama['Judul'] == $this->request->getVar('Judul')) {
            $ruleBuku = 'required';
        } else {
            $ruleBuku = 'required|is_unique[buku.Judul]';
        }

        $validation = \Config\Services::validation();

        $valid = $this->validate([
            'Judul' => [
                'rules' => $ruleBuku,
                'errors' => [
                    'required' => 'Judul harus diisi.',
                    'is_unique' => 'Judul sudah ada.',
                ],
            ],
            'Penulis' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Penulis harus diisi.',
                ],
            ],
            'Penerbit' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Penerbit harus diisi.',
                ],
            ],
            'TahunTerbit' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tahun Terbit harus diisi.',
                ],
            ],
            'Stok' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Stok harus diisi.',
                ],
            ],
            'Sampul' => [
                'rules' => 'max_size[Sampul,1024]|is_image[Sampul]|mime_in[Sampul,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar melebihi batas maksimal.',
                    'is_image' => 'Yang Anda pilih bukan gambar.',
                    'mime_in' => 'Yang Anda pilih bukan gambar.',
                ],
            ],

        ]);

        $fileSampul = $this->request->getFile('Sampul');

        // cek gambar, apakah tetap gambar lama
        if ($fileSampul->getError() == 4) {
            $namaSampul = $this->request->getVar('sampulLama');
        } else {
            // generate nama file random
            $namaSampul = $fileSampul->getRandomName();
            // pindahkan gambar
            $fileSampul->move('img', $namaSampul);
            // hapus file yang lama
            unlink('img/' . $this->request->getVar('sampulLama'));
        }

        if (!$valid) {
            $sessErr = [
                'errJudul' => $validation->getError('Judul'),
                'errPenulis' => $validation->getError('Penulis'),
                'errPenerbit' => $validation->getError('Penerbit'),
                'errTahunTerbit' => $validation->getError('TahunTerbit'),
                'errStok' => $validation->getError('Stok'),
                'errSampul' => $validation->getError('Sampul'),
            ];

            session()->setFlashdata($sessErr);
            return redirect()->to('/bukucontroller/update/' . $this->request->getVar('BukuID'))->withInput();
        } else {
            //  Simpan data buku
            $this->bukuModel->save([
                'BukuID' => $id,
                'Judul' => $this->request->getVar('Judul'),
                'Penulis' => $this->request->getVar('Penulis'),
                'Penerbit' => $this->request->getVar('Penerbit'),
                'TahunTerbit' => $this->request->getVar('TahunTerbit'),
                'Stok' => $this->request->getVar('Stok'),
                'Sampul' => $namaSampul,
            ]);

            session()->setFlashdata('pesan', 'Data berhasil diubah.');

            return redirect()->to('/admin/buku');
        }
    }
}
