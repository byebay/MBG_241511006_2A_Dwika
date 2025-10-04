<?php
namespace App\Controllers;

use App\Models\ProductModel;

class Products extends BaseController {
    protected $productModel;

    public function __construct() {
        $this->productModel = new ProductModel();

        if (! session()->get('isLoggedIn')) {
            header('Location: ' . base_url('login'));
            exit;
        }

        if (session()->get('role') !== 'gudang') {
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
            'nama' => $this->request->getPost('nama'),
            'kategori' => $this->request->getPost('kategori'),
            'jumlah' => $this->request->getPost('jumlah'),
            'satuan' => $this->request->getPost('satuan'),
            'tanggal_masuk' => $this->request->getPost('tanggal_masuk'),
            'tanggal_kadaluarsa' => $this->request->getPost('tanggal_kadaluarsa'),
            'status' => 'Tersedia'
        ]);
        return redirect()->to('/products');
    }

    public function edit($id) {
        $data['product'] = $this->productModel->find($id);
        return view('products/edit', $data);
    }

    public function update($id) {
        $jumlah = (int) $this->request->getPost('jumlah');

        if ($jumlah < 0) {
            return redirect()->back()->with('error', 'Jumlah stok tidak boleh kurang dari 0');
        }

        $this->productModel->update($id, [
            'jumlah' => $jumlah,
            'satuan' => $this->request->getPost('satuan'),
        ]);

        return redirect()->to('/products')->with('success', 'Produk berhasil diperbarui');
    }

    public function delete($id) {
        $product = $this->productModel->find($id);

        if (! $product) {
            return redirect()->to('/products')->with('error', 'Produk tidak ditemukan');
        }

        if ($product['status'] !== 'Kadaluarsa') {
            return redirect()->to('/products')->with('error', 'Produk dengan status "' . $product['status'] . '" tidak dapat dihapus');
        }

        $this->productModel->delete($id);
        return redirect()->to('/products')->with('success', 'Produk berhasil dihapus');
    }
    
    public function confirmDelete($id) {
        $product = $this->productModel->find($id);

        if (! $product) {
            return redirect()->to('/products')->with('error', 'Produk tidak ditemukan');
        }

        return view('products/confirm_delete', ['product' => $product]);
    }
}
