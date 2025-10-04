<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h2 class="mb-4">Daftar Permintaan dari Dapur</h2>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php elseif (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <?php if (empty($permintaan)): ?>
        <div class="alert alert-secondary text-center mt-3">Tidak ada permintaan menunggu.</div>
    <?php else: ?>
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Tanggal Masak</th>
                    <th>Menu</th>
                    <th>Jumlah Porsi</th>
                    <th>Pemohon</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($permintaan as $i => $p): ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td><?= esc($p['tgl_masak']) ?></td>
                        <td><?= esc($p['menu_makan']) ?></td>
                        <td><?= esc($p['jumlah_porsi']) ?></td>
                        <td><?= esc($p['nama_pemohon'] ?? 'User #' . $p['pemohon_id']) ?></td>
                        <td>Menunggu</td>
                        <td>
                            <a href="/gudang/permintaan/detail/<?= $p['id'] ?>" class="btn btn-info btn-sm">Detail</a>
                        </td>
                    </tr>

                    <div class="modal fade" id="modalTolak<?= $p['id'] ?>" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="/gudang/permintaan/tolak/<?= $p['id'] ?>" method="post">
                                    <div class="modal-header bg-danger text-white">
                                        <h5 class="modal-title">Tolak Permintaan</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <label for="alasan" class="form-label">Alasan Penolakan:</label>
                                        <textarea name="alasan" class="form-control" rows="3" required></textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-danger">Tolak Permintaan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>
