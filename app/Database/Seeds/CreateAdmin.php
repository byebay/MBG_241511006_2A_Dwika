<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CreateAdmin extends Seeder
{
    public function run()
    {
        $model = new \App\Models\UserModel();
        $model->save([
            'username'   => "Admin",
            'password'   => password_hash("Admin123", PASSWORD_DEFAULT),
            'role'       => "admin"
        ]);
    }
}
