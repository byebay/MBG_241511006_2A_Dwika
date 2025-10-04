<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card shadow p-4" style="max-width: 500px; width: 100%;">
        <div class="card-body text-center">
            <h4 class="card-title mb-3">Konfirmasi Hapus Bahan Baku</h4>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <ul class="list-group text-start mb-3">
                <li class="list-group-item"><strong>Nama:</strong> <?= esc($product['nama']) ?></li>
                <li class="list-group-item"><strong>Kategori:</strong> <?= esc($product['kategori']) ?></li>
                <li class="list-group-item"><strong>Jumlah:</strong> <?= esc($product['jumlah']) ?> <?= esc($product['satuan']) ?></li>
                <li class="list-group-item"><strong>Status:</strong> <?= esc($product['status']) ?></li>
                <li class="list-group-item"><strong>Tanggal Masuk:</strong> <?= esc($product['tanggal_masuk']) ?></li>
                <li class="list-group-item"><strong>Tanggal Kadaluarsa:</strong> <?= esc($product['tanggal_kadaluarsa']) ?></li>
            </ul>

            <?php if ($product['status'] === 'kadaluarsa'): ?>
                <form action="/products/delete/<?= $product['id'] ?>" method="post" class="d-inline">
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
                <a href="/products" class="btn btn-secondary">Batal</a>
            <?php else: ?>
                <div class="alert alert-warning">
                    Bahan baku dengan status <strong><?= esc($product['status']) ?></strong> tidak dapat dihapus.
                </div>
                <a href="/products" class="btn btn-secondary">Kembali</a>
            <?php endif; ?>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
