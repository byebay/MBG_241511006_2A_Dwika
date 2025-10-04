<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<h2>Update Stok Bahan Baku</h2>
<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger">
        <?= session()->getFlashdata('error') ?>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

<form action="/products/update/<?= $product['id'] ?>" method="post">
    <div class="mb-3">
        <label class="form-label">Jumlah</label>
        <input type="number" name="jumlah" value="<?= $product['jumlah'] ?>" class="form-control" min="0" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Satuan</label>
        <input type="text" name="satuan" value="<?= $product['satuan'] ?>" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="/products" class="btn btn-secondary">Kembali</a>
</form>

<?= $this->endSection() ?>
