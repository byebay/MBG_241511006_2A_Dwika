<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<h2>Edit Produk</h2>
<form action="/products/update/<?= $product['id'] ?>" method="post">
    <div class="mb-3">
        <label class="form-label">Nama Produk</label>
        <input type="text" name="name" value="<?= $product['name'] ?>" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Harga</label>
        <input type="number" name="price" value="<?= $product['price'] ?>" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Deskripsi</label>
        <textarea name="description" class="form-control"><?= $product['description'] ?></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="/products" class="btn btn-secondary">Kembali</a>
</form>

<?= $this->endSection() ?>
