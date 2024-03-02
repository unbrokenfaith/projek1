<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthModel extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'UserID';
    protected $allowedFields = ['Username', 'Password', 'Email', 'NamaLengkap', 'Alamat', 'Role'];

    public function getUserByUsernameAndPassword($username, $password)
    {
        return $this->where('Username', $username)
            ->where('Password', $password)
            ->first();
    }

    public function getAllPetugas()
    {
        return $this->where('Role', '2')->findAll();
    }

    public function getPetugasByID($id = false)
    {
        if ($id === false) {
            // Query tanpa join jika tidak ada parameter id
            return $this->findAll();
        }

        // Query dengan join jika ada parameter id
        return $this->where(['UserID' => $id])->first();
    }

    public function getUserByID($id = false)
    {
        if ($id === false) {
            // Query tanpa join jika tidak ada parameter id
            return $this->findAll();
        }

        // Query dengan join jika ada parameter id
        return $this->where(['UserID' => $id])->first();
    }

    public function getAllUser()
    {
        return $this->where('Role', '3')->findAll();
    }

}
