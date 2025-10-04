<?php
namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        if (! session()->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Silahkan login terlebih dahulu.');
        }

        return view('home');
    }
}
