<?php
namespace App\Controllers;

use App\Models\ProductModel;

class Products extends BaseController {
    protected $productModel;

    public function __construct() {
        $this->productModel = new ProductModel();

        // Cek login
        if (! session()->get('isLoggedIn')) {
            header('Location: ' . base_url('login'));
            exit;
        }

        // Cek role
        if (session()->get('role') !== 'admin') {
            // Kalau bukan admin, redirect ke halaman lain
            header('Location: ' . base_url('products'));
            exit;
        }
    }


    public function index() {
        $data['products'] = $this->productModel->findAll();
        return view('products/index', $data);
    }

    public function create() {
        return view('products/create');
    }

    public function store() {
        $this->productModel->save([
            'name' => $this->request->getPost('name'),
            'price' => $this->request->getPost('price'),
            'description' => $this->request->getPost('description'),
        ]);
        return redirect()->to('/products');
    }

    public function edit($id) {
        $data['product'] = $this->productModel->find($id);
        return view('products/edit', $data);
    }

    public function update($id) {
        $this->productModel->update($id, [
            'name' => $this->request->getPost('name'),
            'price' => $this->request->getPost('price'),
            'description' => $this->request->getPost('description'),
        ]);
        return redirect()->to('/products');
    }

    public function delete($id) {
        $this->productModel->delete($id);
        return redirect()->to('/products');
    }
}
