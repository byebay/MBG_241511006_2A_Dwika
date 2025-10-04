<?php
namespace App\Controllers;

use App\Models\PermintaanModel;
use App\Models\PermintaanDetailModel;
use App\Models\ProductModel;
use CodeIgniter\Controller;

class Permintaan extends Controller
{
    public function index()
    {
        if (session()->get('role') !== 'dapur') {
            return redirect()->to('/dashboard')->with('error', 'Akses ditolak.');
        }

        $permintaanModel = new PermintaanModel();
        $detailModel = new PermintaanDetailModel();

        $permintaanList = $permintaanModel
            ->where('pemohon_id', session()->get('user_id'))
            ->findAll();

        foreach ($permintaanList as &$p) {
            $detail = $detailModel
                ->select('permintaan_detail.*, bahan_baku.nama AS nama_bahan, bahan_baku.satuan')
                ->join('bahan_baku', 'bahan_baku.id = permintaan_detail.bahan_id')
                ->where('permintaan_detail.permintaan_id', $p['id'])
                ->findAll();

            $p['detail'] = $detail;
        }

        $data['permintaan'] = $permintaanList;

        return view('permintaan/index', $data);
    }

    public function detail($id)
    {
        if (session()->get('role') !== 'dapur') {
            return redirect()->to('/dashboard')->with('error', 'Akses ditolak.');
        }

        $permintaanModel = new PermintaanModel();
        $detailModel = new PermintaanDetailModel();

        $permintaan = $permintaanModel->find($id);

        if (!$permintaan || $permintaan['pemohon_id'] != session()->get('user_id')) {
            return redirect()->to('/permintaan')->with('error', 'Data tidak ditemukan.');
        }

        $detail = $detailModel
            ->select('permintaan_detail.*, bahan_baku.nama AS nama_bahan, bahan_baku.satuan')
            ->join('bahan_baku', 'bahan_baku.id = permintaan_detail.bahan_id')
            ->where('permintaan_detail.permintaan_id', $id)
            ->findAll();

        $data = [
            'permintaan' => $permintaan,
            'detail'     => $detail
        ];

        return view('permintaan/detail', $data);
    }

    public function create()
    {
        if (session()->get('role') !== 'dapur') {
            return redirect()->to('/dashboard')->with('error', 'Akses ditolak.');
        }

        $productModel = new ProductModel();

        $data['bahan'] = $productModel
            ->where('jumlah >', 0)
            ->where('status !=', 'kadaluarsa')
            ->findAll();

        return view('permintaan/create', $data);
    }

    public function store()
    {
        if (session()->get('role') !== 'dapur') {
            return redirect()->to('/dashboard')->with('error', 'Akses ditolak.');
        }

        $permintaanModel = new PermintaanModel();
        $detailModel = new PermintaanDetailModel();

        $permintaanId = $permintaanModel->insert([
            'pemohon_id'   => session()->get('user_id'),
            'tgl_masak'    => $this->request->getPost('tgl_masak'),
            'menu_makan'   => $this->request->getPost('menu_makan'),
            'jumlah_porsi' => $this->request->getPost('jumlah_porsi'),
            'status'       => 'menunggu',
            'created_at'   => date('Y-m-d H:i:s')
        ]);

        $bahan_ids = $this->request->getPost('bahan_id');
        $jumlah    = $this->request->getPost('jumlah_diminta');

        if ($bahan_ids && $jumlah) {
            foreach ($bahan_ids as $i => $bahan_id) {
                $detailModel->insert([
                    'permintaan_id'  => $permintaanId,
                    'bahan_id'       => $bahan_id,
                    'jumlah_diminta' => $jumlah[$i],
                ]);
            }
        }

        return redirect()->to('/permintaan')->with('success', 'Permintaan bahan berhasil dikirim.');
    }

    public function batalkan($id)
    {
        $permintaanModel = new \App\Models\PermintaanModel();
        $detailModel = new \App\Models\PermintaanDetailModel();

        $permintaan = $permintaanModel->find($id);
        if (!$permintaan) {
            return redirect()->back()->with('error', 'Permintaan tidak ditemukan.');
        }

        $detailModel->where('permintaan_id', $id)->delete();

        $permintaanModel->delete($id);

        return redirect()->to('/permintaan')->with('success', 'Permintaan berhasil dibatalkan dan dihapus.');
    }
}
