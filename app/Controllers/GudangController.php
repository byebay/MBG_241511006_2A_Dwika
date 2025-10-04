<?php

namespace App\Controllers;

use App\Models\PermintaanModel;
use App\Models\PermintaanDetailModel;
use App\Models\ProductModel;

class GudangController extends BaseController
{
    protected $permintaanModel;

    public function __construct()
    {
        $this->permintaanModel = new PermintaanModel();
    }

    public function index()
    {
        if (session()->get('role') !== 'gudang') {
            return redirect()->to('/dashboard')->with('error', 'Akses ditolak.');
        }

        $permintaanModel = new PermintaanModel();
        $data['permintaan'] = $permintaanModel
            ->where('status', 'menunggu')
            ->orderBy('tgl_masak', 'ASC')
            ->findAll();

        return view('gudang/permintaan_list', $data);
    }

    public function detailPermintaan($id)
    {
        $permintaanModel = new PermintaanModel();
        $detailModel = new PermintaanDetailModel();
        $productModel = new ProductModel();

        $permintaan = $permintaanModel
            ->select('permintaan.*, user.name AS nama_pemohon')
            ->join('user', 'user.id = permintaan.pemohon_id', 'left')
            ->find($id);

        if (!$permintaan) {
            return redirect()->to('/gudang/permintaan')->with('error', 'Permintaan tidak ditemukan.');
        }

        $detail = $detailModel
            ->select('permintaan_detail.*, bahan_baku.nama AS nama_bahan, bahan_baku.satuan, bahan_baku.jumlah AS stok_sekarang')
            ->join('bahan_baku', 'bahan_baku.id = permintaan_detail.bahan_id', 'left')
            ->where('permintaan_id', $id)
            ->findAll();

        $data = [
            'permintaan' => $permintaan,
            'detail'     => $detail
        ];

        return view('gudang/detail_permintaan', $data);
    }

    public function setujui($id)
    {
        $permintaanModel = new PermintaanModel();
        $bahanModel = new ProductModel();
        $detailModel = new PermintaanDetailModel();

        $detailList = $detailModel->where('permintaan_id', $id)->findAll();

        foreach ($detailList as $detail) {
            $bahan = $bahanModel->find($detail['bahan_id']);

            if (!$bahan) {
                continue;
            }

            $stokBaru = $bahan['jumlah'] - $detail['jumlah_diminta'];
            if ($stokBaru < 0) $stokBaru = 0;

            $statusBaru = $stokBaru == 0 ? 'habis' : 'tersedia';

            $bahanModel->update($bahan['id'], [
                'jumlah' => $stokBaru,
                'status' => $statusBaru
            ]);
        }

        // Update status permintaan
        $permintaanModel->update($id, ['status' => 'disetujui']);

        return redirect()->to('/gudang/permintaan')->with('success', 'Permintaan disetujui dan stok diperbarui.');
    }

    public function tolak($id)
    {
        if (session()->get('role') !== 'gudang') {
            return redirect()->to('/dashboard')->with('error', 'Akses ditolak.');
        }

        $permintaanModel = new PermintaanModel();

        $permintaan = $permintaanModel->find($id);
        if (!$permintaan) {
            return redirect()->back()->with('error', 'Permintaan tidak ditemukan.');
        }

        $permintaanModel->update($id, ['status' => 'ditolak']);

        return redirect()->to('/permintaan')->with('success', 'Permintaan telah ditolak.');
    }
}
