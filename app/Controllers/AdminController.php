<?php

namespace App\Controllers;

use App\Models\AuthModel;

class AdminController extends BaseController
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
            'title' => 'Admin Page',
            'username' => $username,

        ];

        return view('/admin/index', $data);
    }
}
