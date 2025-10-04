<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Daftar Permintaan Bahan Baku</h2>
        <a href="/permintaan/create" class="btn btn-primary">+ Buat Permintaan</a>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php elseif (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <?php if (empty($permintaan)): ?>
        <div class="alert alert-secondary text-center mt-3">
            Tidak ada permintaan
        </div>
    <?php else: ?>
        <table class="table table-bordered table-striped mt-3 align-middle">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Tanggal Masak</th>
                    <th>Menu</th>
                    <th>Jumlah Porsi</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($permintaan as $index => $p): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= $p['tgl_masak'] ?></td>
                        <td><?= esc($p['menu_makan']) ?></td>
                        <td><?= $p['jumlah_porsi'] ?></td>
                        <td>
                            <?php if ($p['status'] == 'menunggu'): ?>
                                <span>Menunggu</span>
                            <?php elseif ($p['status'] == 'disetujui'): ?>
                                <span>Disetujui</span>
                            <?php else: ?>
                                <span>Ditolak</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="/permintaan/detail/<?= $p['id'] ?>" class="btn btn-info btn-sm">Detail</a>

                            <?php if ($p['status'] == 'menunggu'): ?>
                                <form action="/permintaan/batalkan/<?= $p['id'] ?>" method="post" style="display:inline;">
                                    <?= csrf_field() ?>
                                    <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Yakin ingin membatalkan dan menghapus permintaan ini?')">
                                        Batalkan
                                    </button>
                                </form>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>
