<?php
namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Users extends Controller
{
    public function users()
    {
        if (session()->get('role') !== 'gudang') {
            return redirect()->to('/dashboard')->with('error', 'Anda tidak punya akses.');
        }

        $userModel = new UserModel();
        $data['users'] = $userModel->findAll();

        return view('user/users', $data);
    }

    public function createUser()
    {
        if (session()->get('role') !== 'gudang') {
            return redirect()->to('/dashboard')->with('error', 'Anda tidak punya akses.');
        }

        return view('user/create_user');
    }

    public function storeUser()
    {
        if (session()->get('role') !== 'gudang') {
            return redirect()->to('/dashboard')->with('error', 'Anda tidak punya akses.');
        }

        $userModel = new UserModel();

        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'     => $this->request->getPost('role'),
            'created_at' => date('Y-m-d H:i:s')
        ];
        // dd($data);
        $userModel->save($data);

        return redirect()->to('/user/users')->with('success', 'User baru berhasil ditambahkan.');
    }

    public function editUser($id)
    {
        if (session()->get('role') !== 'gudang') {
            return redirect()->to('/dashboard')->with('error', 'Anda tidak punya akses.');
        }

        $userModel = new UserModel();
        $data['user'] = $userModel->find($id);

        if (!$data['user']) {
            return redirect()->to('/auth/users')->with('error', 'User tidak ditemukan.');
        }

        return view('user/edit_user', $data);
    }

    public function updateUser($id)
    {
        if (session()->get('role') !== 'gudang') {
            return redirect()->to('/dashboard')->with('error', 'Anda tidak punya akses.');
        }

        $userModel = new UserModel();

        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'role' => $this->request->getPost('role'),
        ];

        // Jika password diisi, update password juga
        $password = $this->request->getPost('password');
        if (!empty($password)) {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        $userModel->update($id, $data);

        return redirect()->to('/user/users')->with('success', 'User berhasil diperbarui.');
    }

    public function deleteUser($id)
    {
        if (session()->get('role') !== 'gudang') {
            return redirect()->to('/dashboard')->with('error', 'Anda tidak punya akses.');
        }

        $userModel = new UserModel();
        $userModel->delete($id);

        return redirect()->to('/user/users')->with('success', 'User berhasil dihapus.');
    }

}