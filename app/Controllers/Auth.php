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
            $username = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            $user = $userModel->where('email', $username)->first();

            if ($user) {
                if (password_verify($password, $user['password'])) {
                    session()->set([
                        'isLoggedIn' => true,
                        'user_id'    => $user['id'],
                        'email'       => $user['email'],
                        'role'       => $user['role']
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

        $username = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $userModel->where('email', $username)->first();

        if ($user && password_verify($password, $user['password'])) {
            $session->set([
                'user_id'   => $user['id'],
                'email'      => $user['email'],
                'role'      => $user['role'],
                'isLoggedIn' => true
            ]);
            return redirect()->to('/dashboard');
        }

        return redirect()->back()->withInput()->with('error', 'Login gagal! Email atau password salah.');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('success', 'Anda telah logout.');
    }

}