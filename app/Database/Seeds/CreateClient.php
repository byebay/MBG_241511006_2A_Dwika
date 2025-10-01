<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CreateClient extends Seeder
{
    public function run()
    {
        $model = new \App\Models\UserModel();
        $model->save([
            'name'   => "Client",
            'email'  => "cllent@mbg.id",
            'password'   => password_hash("Client123", PASSWORD_DEFAULT),
            'role'       => "dapur"
        ]);
    }
}
