<?php

namespace App\Controllers;

use App\Models\AuthModel;

class PetugasPageController extends BaseController
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
            'username' => $username,

        ];

        return view('/petugas/index/index', $data);
    }
}
