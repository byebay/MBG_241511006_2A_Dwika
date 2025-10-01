<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<h2>Tambah Produk</h2>
<form action="/products/store" method="post">
    <div class="mb-3">
        <label class="form-label">Nama Produk</label>
        <input type="text" name="name" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Harga</label>
        <input type="number" name="price" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Deskripsi</label>
        <textarea name="description" class="form-control"></textarea>
    </div>
    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="/products" class="btn btn-secondary">Kembali</a>
</form>

<?= $this->endSection() ?>
