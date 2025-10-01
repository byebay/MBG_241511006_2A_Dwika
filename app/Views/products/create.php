<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<h2>Tambah Produk</h2>
<!-- nama, kategori, jumlah, satuan, tanggal_masuk, tanggal_kadaluarsa. -->
<form action="/products/store" method="post">
    <div class="mb-3">
        <label class="form-label">Nama Bahan Baku</label>
        <input type="text" name="nama" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Kategori</label>
        <input type="text" name="kategori" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Jumlah</label>
        <input type="number" name="jumlah" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Satuan</label>
        <input type="text" name="satuan" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Tanggal Masuk</label>
        <input type="date" name="tanggal_masuk" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Tanggal Kadaluarsa</label>
        <input type="date" name="tanggal_kadaluarsa" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="/products" class="btn btn-secondary">Kembali</a>
</form>

<?= $this->endSection() ?>
