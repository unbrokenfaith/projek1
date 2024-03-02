<?php

namespace App\Controllers;

use App\Models\AuthModel;

class PetugasController extends BaseController
{
    protected $authModel;

    public function __construct()
    {
        $this->authModel = new AuthModel();
    }
    public function index(): string
    {
        $username = session()->get('username');

        $data = [
            'title' => 'Petugas Page',
            'petugas' => $this->authModel->getAllPetugas(),
            'username' => $username,

        ];

        return view('/admin/petugas/index', $data);
    }

    public function create()
    {
        $username = session()->get('username');

        $data = [
            'title' => 'Tambah Data Acara',
            'acara' => $this->authModel->getAllPetugas(),
            'username' => $username,
        ];

        return view('/admin/petugas/create', $data);
    }

    public function save()
    {
        $validation = \Config\Services::validation();

        $valid = $this->validate([
            'Username' => [
                'rules' => 'required|is_unique[user.Username]',
                'errors' => [
                    'required' => 'Username harus diisi.',
                    'is_unique' => 'Username sudah ada.',
                ],
            ],
            'NamaLengkap' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Lengkap harus diisi.',
                ],
            ],
            'Password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Password harus diisi.',
                ],
            ],
            'Email' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Email harus diisi.',
                ],
            ],
            'Alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Alamat harus diisi.',
                ],
            ],
        ]);

        if (!$valid) {
            $sessErr = [
                'errUsername' => $validation->getError('Username'),
                'errPassword' => $validation->getError('Password'),
                'errNamaLengkap' => $validation->getError('NamaLengkap'),
                'errEmail' => $validation->getError('Email'),
                'errAlamat' => $validation->getError('Alamat'),
            ];

            session()->setFlashdata($sessErr);
            return redirect()->to(base_url('/admin/petugas/create'))->withInput();
        } else {
            // Tambahkan role secara otomatis sebagai petugas (role 2)
            $requestData = $this->request->getPost(); // Ambil data dari form

            // Tambahkan data role ke dalam request
            $requestData['Role'] = '2';

            $this->authModel->save([
                'Username' => $this->request->getVar('Username'),
                'Password' => $this->request->getVar('Password'),
                'NamaLengkap' => $this->request->getVar('NamaLengkap'),
                'Email' => $this->request->getVar('Email'),
                'Alamat' => $this->request->getVar('Alamat'),
                'Role' => $requestData['Role'],
            ]);

            session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

            return redirect()->to('/admin/petugas');
        }
    }

    public function delete($id)
    {
        $this->authModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/admin/petugas');
    }

    public function edit($id)
    {
        $username = session()->get('username');

        $data = [
            'title' => 'Form Edit Data Buku',
            'petugas' => $this->authModel->getPetugasByID($id),
            'username' => $username,
        ];

        return view('/admin/petugas/edit', $data);
    }

    public function update($id)
    {
        // Cek Petugas
        $petugasLama = $this->authModel->getPetugasByID($this->request->getVar('UserID'));

        if ($petugasLama && $petugasLama['Username'] == $this->request->getVar('Username')) {
            $rulePetugas = 'required';
        } else {
            $rulePetugas = 'required|is_unique[user.Username]';
        }

        $validation = \Config\Services::validation();

        $valid = $this->validate([
            'Username' => [
                'rules' => $rulePetugas,
                'errors' => [
                    'required' => 'Username harus diisi.',
                    'is_unique' => 'Username sudah ada.',
                ],
            ],
            'NamaLengkap' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Lengkap harus diisi.',
                ],
            ],
            'Password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Password harus diisi.',
                ],
            ],
            'Email' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Email harus diisi.',
                ],
            ],
            'Alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Alamat harus diisi.',
                ],
            ],
        ]);

        if (!$valid) {
            $sessErr = [
                'errUsername' => $validation->getError('Username'),
                'errPassword' => $validation->getError('Password'),
                'errNamaLengkap' => $validation->getError('NamaLengkap'),
                'errEmail' => $validation->getError('Email'),
                'errAlamat' => $validation->getError('Alamat'),
            ];

            session()->setFlashdata($sessErr);
            return redirect()->to('/petugascontroller/update/' . $this->request->getVar('UserID'))->withInput();
        } else {
            //  Simpan data petugas
            $this->authModel->save([
                'UserID' => $id,
                'Username' => $this->request->getVar('Username'),
                'Password' => $this->request->getVar('Password'),
                'NamaLengkap' => $this->request->getVar('NamaLengkap'),
                'Email' => $this->request->getVar('Email'),
                'Alamat' => $this->request->getVar('Alamat'),
            ]);

            session()->setFlashdata('pesan', 'Data berhasil diubah.');

            return redirect()->to('/admin/petugas');
        }
    }

}
