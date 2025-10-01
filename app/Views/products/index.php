<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Daftar Bahan Baku</h2>
    <a href="/products/create" class="btn btn-primary">+ Tambah Bahan Baku</a>
</div>

<?php if(session()->getFlashdata('success')): ?>
<div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>

<table class="table table-striped table-bordered">
    <thead class="table-dark">
        <tr>
            <th>Nama</th>
            <th>Kategori</th>
            <th>Jumlah</th>
            <th>Satuan</th>
            <th>Tanggal Masuk</th>
            <th>Tanggal Kadaluarsa</th>
            <th>Status</th>
            <th width="180">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($products as $p): ?>
        <tr>
            <td><?= $p['nama'] ?></td>
            <td><?= $p['kategori'] ?></td>
            <td><?= $p['jumlah'] ?></td>
            <td><?= $p['satuan'] ?></td>
            <td><?= $p['tanggal_masuk'] ?></td>
            <td><?= $p['tanggal_kadaluarsa'] ?></td>
            <td><?= $p['status'] ?></td>
            <td>
                <a href="/products/edit/<?= $p['id'] ?>" class="btn btn-sm btn-warning">Update Stok</a>
                <a href="/products/delete/<?= $p['id'] ?>" class="btn btn-sm btn-danger"
                   onclick="return confirm('Yakin hapus produk ini?')">Hapus</a>
            </td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>

<?= $this->endSection() ?>
