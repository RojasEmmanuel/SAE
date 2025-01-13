<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table = 'adminsae';
    protected $primaryKey = 'idAdmin';
    protected $allowedFields = ['nombre', 'username', 'password'];

    public function validateUser($user,$password) {
        $user = $this->where(['username' => $user])->first();

        if($user && password_verify($password, $user['password'])){
            return $user;
        }

        return null;
    }
}