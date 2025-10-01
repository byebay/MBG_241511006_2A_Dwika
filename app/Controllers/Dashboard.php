<?php
namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        // Cek session, kalau belum login redirect ke login
        if (! session()->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Silahkan login terlebih dahulu.');
        }

        return view('/layout' );
    }
}
