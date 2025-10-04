<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h2>Detail Permintaan Bahan Baku</h2>
    <hr>

    <div class="mb-3">
        <strong>Tanggal Masak:</strong> <?= $permintaan['tgl_masak'] ?><br>
        <strong>Menu:</strong> <?= esc($permintaan['menu_makan']) ?><br>
        <strong>Jumlah Porsi:</strong> <?= $permintaan['jumlah_porsi'] ?><br>
        <strong>Status:</strong>
        <?php if ($permintaan['status'] == 'menunggu'): ?>
            <span>Menunggu</span>
        <?php elseif ($permintaan['status'] == 'disetujui'): ?>
            <span>Disetujui</span>
        <?php else: ?>
            <span>Ditolak</span>
        <?php endif; ?>
    </div>

    <h5>Daftar Bahan Baku Diminta</h5>
    <?php if (empty($detail)): ?>
        <div class="alert alert-secondary">Tidak ada detail bahan</div>
    <?php else: ?>
        <table class="table table-bordered table-striped">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Nama Bahan</th>
                    <th>Jumlah Diminta</th>
                    <th>Satuan</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($detail as $i => $d): ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td><?= esc($d['nama_bahan']) ?></td>
                        <td><?= $d['jumlah_diminta'] ?></td>
                        <td><?= esc($d['satuan']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <a href="/permintaan" class="btn btn-secondary mt-3">Kembali</a>
</div>

<?= $this->endSection() ?>
