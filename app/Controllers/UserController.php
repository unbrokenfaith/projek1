<?php

namespace App\Controllers;

use App\Models\AuthModel;

class UserController extends BaseController
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
            'title' => 'Users Page',
            'user' => $this->authModel->getAllUser(),
            'username' => $username,

        ];

        return view('/admin/user/index', $data);
    }

    public function create()
    {
        $username = session()->get('username');

        $data = [
            'title' => 'Tambah Data Acara',
            'user' => $this->authModel->getAllUser(),
            'username' => $username,
        ];

        return view('/admin/user/create', $data);
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
            return redirect()->to('/usercontroller/update/' . $this->request->getVar('UserID'))->withInput();
        } else {
            // Tambahkan role secara otomatis sebagai user (role 3)
            $requestData = $this->request->getPost(); // Ambil data dari form

            // Tambahkan data role ke dalam request
            $requestData['Role'] = '3';

            $this->authModel->save([
                'Username' => $this->request->getVar('Username'),
                'Password' => $this->request->getVar('Password'),
                'NamaLengkap' => $this->request->getVar('NamaLengkap'),
                'Email' => $this->request->getVar('Email'),
                'Alamat' => $this->request->getVar('Alamat'),
                'Role' => $requestData['Role'],
            ]);

            session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

            return redirect()->to('/admin/user');
        }
    }

    public function delete($id)
    {
        $this->authModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/admin/user');
    }

    public function edit($id)
    {
        $username = session()->get('username');

        $data = [
            'title' => 'Form Edit Data User',
            'petugas' => $this->authModel->getPetugasByID($id),
            'username' => $username,
        ];

        return view('/admin/user/edit', $data);
    }

    public function update($id)
    {
        // Cek User
        $userLama = $this->authModel->getUserByID($id);

        if ($userLama && $userLama['Username'] == $this->request->getVar('Username')) {
            $ruleUser = 'required';
        } else {
            $ruleUser = 'required|is_unique[user.Username]';
        }

        $validation = \Config\Services::validation();

        $valid = $this->validate([
            'Username' => [
                'rules' => $ruleUser,
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
            return redirect()->to('/admin/user/edit/' . $id)->withInput();
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

            return redirect()->to('/admin/user');
        }
    }

}
