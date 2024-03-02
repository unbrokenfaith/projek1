<?php

namespace App\Controllers;

use App\Models\AuthModel;

class AuthController extends BaseController
{
    protected $authModel;

    public function __construct()
    {
        $this->authModel = new AuthModel();
    }
    public function index(): string
    {
        $data = [
            'title' => 'Login Page',
        ];

        return view('auth/login', $data);
    }

    public function coba()
    {
        $data = [
            'title' => 'Ngetes Bootstrap',
        ];

        return view('/tes', $data);
    }

    public function register(): string
    {
        $data = [
            'title' => 'Register Page',
        ];

        return view('auth/register', $data);
    }

    public function registerProcess()
    {
        $validation = \Config\Services::validation();

        $valid = $this->validate([
            'namaLengkap' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama lengkap wajib diisi.',
                ],
            ],
            'email' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Email wajib diisi.',
                ],
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Alamat wajib diisi.',
                ],
            ],
            'username' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Username wajib diisi.',
                ],
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Password wajib diisi.',
                ],
            ],
            'repassword' => [
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => 'Password wajib diisi.',
                    'matches' => 'Password tidak sama.',
                ],
            ],
        ]);

        if (!$valid) {
            // jika tidak valid
            $sessErr = [
                'errNamaLengkap' => $validation->getError('namaLengkap'),
                'errEmail' => $validation->getError('email'),
                'errAlamat' => $validation->getError('alamat'),
                'errUsername' => $validation->getError('username'),
                'errPassword' => $validation->getError('password'),
                'errRepassword' => $validation->getError('repassword'),
            ];

            session()->setFlashdata($sessErr);

            return redirect()->to(base_url('/register'))->withInput();
        } else {
            $this->authModel->save([
                'nama_lengkap' => $this->request->getPost('namaLengkap'),
                'email' => $this->request->getPost('email'),
                'alamat' => $this->request->getPost('alamat'),
                'username' => $this->request->getPost('username'),
                'password' => $this->request->getPost('password'),
                'role' => 3,
            ]);

            session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

            return redirect()->to(base_url('/register'));
        }
    }

    public function login(): string
    {
        $data = [
            'title' => 'Login Page',
        ];

        return view('auth/login', $data);
    }

    public function loginProcess()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $validation = \Config\Services::validation();

        $valid = $this->validate([
            'username' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Username wajib diisi.',
                ],
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Password wajib diisi.',
                ],
            ],
        ]);

        if (!$valid) {
            // jika tidak valid
            $sessErr = [
                'errUsername' => $validation->getError('username'),
                'errPassword' => $validation->getError('password'),
            ];

            session()->setFlashdata($sessErr);

            return redirect()->to(base_url('/'))->withInput();
        } else {
            $user = $this->authModel->getUserByUsernameAndPassword($username, $password);

            if ($user) {
                // If the user is found in the database
                $role = $user['role'];
                $userID = $user['UserID'];
                $namaLengkap = $user['NamaLengkap'];

                // Set session data
                session()->set([
                    'userID' => $userID,
                    'username' => $username,
                    'namaLengkap' => $namaLengkap,
                    'role' => $role,
                    'logged_in' => true,
                ]);

                if ($user['role'] == 1) {
                    // jika role = 1 (admin)
                    return redirect()->to(base_url('admin'));
                } elseif ($user['role'] == 2) {
                    // jika role = 2 (petugas)
                    return redirect()->to(base_url('petugas'));
                } else {
                    // jika role = 3 (peminjam)
                    return redirect()->to(base_url('peminjam'));
                }
            } else {
                // username or password not found
                session()->setFlashdata('errMsg', 'Username/Password belum terdaftar.');

                return redirect()->to(base_url('/'))->withInput();
            }

        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('login'));
    }
}
