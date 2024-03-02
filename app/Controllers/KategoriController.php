<?php

namespace App\Controllers;

use App\Models\KategoriModel;

class KategoriController extends BaseController
{
    protected $kategoriModel;

    public function __construct()
    {
        $this->kategoriModel = new KategoriModel();
    }
    public function index(): string
    {
        $username = session()->get('username');

        $data = [
            'title' => 'Kategori Page',
            'kategori' => $this->kategoriModel->getAllKategori(),
            'username' => $username,
        ];

        return view('/admin/kategori/index', $data);
    }

    public function create()
    {
        $username = session()->get('username');

        $data = [
            'title' => 'Tambah Data Kategori',
            'kategori' => $this->kategoriModel->getAllKategori(),
            'username' => $username,
        ];

        return view('/admin/kategori/create', $data);
    }

    public function save()
    {
        $validation = \Config\Services::validation();

        $valid = $this->validate([
            'NamaKategori' => [
                'rules' => 'required|is_unique[kategoribuku.NamaKategori]',
                'errors' => [
                    'required' => 'Nama Kategori harus diisi.',
                    'is_unique' => 'Nama Kategori sudah ada.',
                ],
            ],
        ]);

        if (!$valid) {
            $sessErr = [
                'errNamaKategori' => $validation->getError('NamaKategori'),
            ];

            session()->setFlashdata($sessErr);
            return redirect()->to(base_url('/admin/kategori/create'))->withInput();
        } else {
            $this->kategoriModel->save([
                'NamaKategori' => $this->request->getVar('NamaKategori'),
            ]);

            session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

            return redirect()->to('/admin/kategori');
        }
    }

    public function delete($id)
    {
        $this->kategoriModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/admin/kategori');
    }

    public function edit($id)
    {
        $username = session()->get('username');

        $data = [
            'title' => 'Form Edit Data Buku',
            'kategori' => $this->kategoriModel->getKategoriByID($id),
            'username' => $username,
        ];

        return view('/admin/kategori/edit', $data);
    }

    public function update($id)
    {
        // Cek Kategori
        $kategoriLama = $this->kategoriModel->getKategoriByID($this->request->getVar('KategoriID'));

        if ($kategoriLama && $kategoriLama['NamaKategori'] == $this->request->getVar('NamaKategori')) {
            $ruleKategori = 'required';
        } else {
            $ruleKategori = 'required|is_unique[kategoribuku.NamaKategori]';
        }

        $validation = \Config\Services::validation();

        $valid = $this->validate([
            'NamaKategori' => [
                'rules' => $ruleKategori,
                'errors' => [
                    'required' => 'Nama Kategori harus diisi.',
                    'is_unique' => 'Nama Kategori sudah ada.',
                ],
            ],
        ]);

        if (!$valid) {
            $sessErr = [
                'errNamaKategori' => $validation->getError('NamaKategori'),
            ];

            session()->setFlashdata($sessErr);
            return redirect()->to('/kategoricontroller/update/' . $this->request->getVar('KategoriID'))->withInput();
        } else {
            //  Simpan data buku
            $this->kategoriModel->save([
                'KategoriID' => $id,
                'NamaKategori' => $this->request->getVar('NamaKategori'),
            ]);

            session()->setFlashdata('pesan', 'Data berhasil diubah.');

            return redirect()->to('/admin/kategori');
        }
    }
}
