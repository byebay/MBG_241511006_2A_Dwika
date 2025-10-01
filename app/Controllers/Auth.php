<?php
namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Auth extends Controller
{
    protected $helpers = ['form', 'url', 'session'];

    public function login()
    {
        helper(['form']);
        $userModel = new UserModel();

        if ($this->request->getMethod() === 'post') {
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');

            $user = $userModel->where('username', $username)->first();

            if ($user) {
                // cek password
                if (password_verify($password, $user['password'])) {
                    // ===> DI SINI SESSION DITARUH
                    session()->set([
                        'isLoggedIn' => true,
                        'user_id'    => $user['id'],
                        'username'   => $user['username'],
                        'role'       => $user['role'] // simpan role ke session
                    ]);

                    return redirect()->to('/products');
                } else {
                    return redirect()->back()->with('error', 'Password salah!');
                }
            } else {
                return redirect()->back()->with('error', 'User tidak ditemukan!');
            }
        }
        return view('auth/login');
    }

    public function loginProcess()
    {
        $session = session();
        $userModel = new UserModel();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // cari user berdasarkan username
        $user = $userModel->where('username', $username)->first();

        if ($user && password_verify($password, $user['password'])) {
            $session->set([
                'user_id'   => $user['id'],
                'username'  => $user['username'],
                'role'      => $user['role'],
                'logged_in' => true
            ]);
            return redirect()->to('/dashboard');
        }

        return redirect()->back()->withInput()->with('error', 'Login gagal! Username atau password salah.');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('success', 'Anda telah logout.');
    }

}