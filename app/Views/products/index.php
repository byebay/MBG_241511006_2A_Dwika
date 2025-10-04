<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Daftar Bahan Baku</h2>
    
    <?php if (session()->get('role') != 'dapur'): ?>
        <a href="/products/create" class="btn btn-primary">+ Tambah Bahan Baku</a>
    <?php endif; ?>
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

            <?php if (session()->get('role') != 'dapur'): ?>
                <th width="180">Aksi</th>
            <?php endif; ?>
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

            <?php if (session()->get('role') != 'dapur'): ?>
            <td>
                <a href="/products/edit/<?= $p['id'] ?>" class="btn btn-sm btn-warning">Update Stok</a>
                <a href="/products/confirm-delete/<?= $p['id'] ?>" class="btn btn-sm btn-danger">Hapus</a>
            </td>
            <?php endif; ?>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>

<?= $this->endSection() ?>
