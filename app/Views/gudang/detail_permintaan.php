<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h2>Detail Permintaan Bahan Baku</h2>
    <hr>

    <div class="card mb-4">
        <div class="card-body">
            <p><strong>Pemohon:</strong> <?= esc($permintaan['nama_pemohon']) ?></p>
            <p><strong>Tanggal Masak:</strong> <?= esc($permintaan['tgl_masak']) ?></p>
            <p><strong>Menu:</strong> <?= esc($permintaan['menu_makan']) ?></p>
            <p><strong>Jumlah Porsi:</strong> <?= esc($permintaan['jumlah_porsi']) ?></p>
            <p><strong>Status:</strong>
                <?php if ($permintaan['status'] == 'menunggu'): ?>
                    <span>Menunggu</span>
                <?php elseif ($permintaan['status'] == 'disetujui'): ?>
                    <span>Disetujui</span>
                <?php else: ?>
                    <span>Ditolak</span>
                <?php endif; ?>
            </p>
        </div>
    </div>

    <h5>Daftar Bahan yang Diminta</h5>
    <?php if (empty($detail)): ?>
        <div class="alert alert-secondary">Tidak ada detail bahan baku.</div>
    <?php else: ?>
        <table class="table table-bordered align-middle">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama Bahan</th>
                    <th>Jumlah Diminta</th>
                    <th>Satuan</th>
                    <th>Stok Sekarang</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($detail as $i => $d): ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td><?= esc($d['nama_bahan']) ?></td>
                        <td><?= esc($d['jumlah_diminta']) ?></td>
                        <td><?= esc($d['satuan']) ?></td>
                        <td><?= esc($d['stok_sekarang']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <?php if ($permintaan['status'] == 'menunggu'): ?>
        <div class="mt-4">
            <form action="/gudang/permintaan/setujui/<?= $permintaan['id'] ?>" method="post" class="d-inline">
                <button type="submit" class="btn btn-success"onclick="return confirm('Yakin ingin menyetujui permintaan ini?')">Setujui</button>
            </form>

            <form action="/gudang/permintaan/tolak/<?= $permintaan['id'] ?>" method="post" class="d-inline">
                <button type="submit" class="btn btn-danger" data-bs-toggle="collapse" data-bs-target="#formTolak">Tolak</button>
            </form>

            <div id="formTolak" class="collapse mt-3">
                <form action="/gudang/permintaan/tolak/<?= $permintaan['id'] ?>" method="post">
                    <div class="mb-3">
                        <label class="form-label">Alasan Penolakan</label>
                        <textarea name="alasan" class="form-control" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-danger">Kirim Penolakan</button>
                </form>
            </div>
        </div>
    <?php endif; ?>

    <div class="mt-4">
        <a href="/gudang/permintaan" class="btn btn-secondary">Kembali ke Daftar</a>
    </div>
</div>

<?= $this->endSection() ?>
