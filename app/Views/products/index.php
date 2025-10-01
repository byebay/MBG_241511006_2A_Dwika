<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Daftar Produk</h2>
    <a href="/products/create" class="btn btn-primary">+ Tambah Produk</a>
</div>

<?php if(session()->getFlashdata('success')): ?>
<div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>

<table class="table table-striped table-bordered">
    <thead class="table-dark">
        <tr>
            <th>Nama</th>
            <th>Harga</th>
            <th>Deskripsi</th>
            <th width="180">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($products as $p): ?>
        <tr>
            <td><?= $p['name'] ?></td>
            <td>Rp <?= number_format($p['price'], 0, ',', '.') ?></td>
            <td><?= $p['description'] ?></td>
            <td>
                <a href="/products/edit/<?= $p['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                <a href="/products/delete/<?= $p['id'] ?>" class="btn btn-sm btn-danger"
                   onclick="return confirm('Yakin hapus produk ini?')">Hapus</a>
            </td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>

<?= $this->endSection() ?>
