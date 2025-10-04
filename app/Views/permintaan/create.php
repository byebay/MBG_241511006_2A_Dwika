<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<h2>Permintaan Bahan Baku</h2>

<form action="/permintaan/store" method="post">
    <div class="mb-3">
        <label class="form-label">Tanggal Masak</label>
        <input type="date" name="tgl_masak" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Menu yang akan dibuat</label>
        <input type="text" name="menu_makan" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Jumlah Porsi</label>
        <input type="number" name="jumlah_porsi" class="form-control" min="1" required>
    </div>

    <hr>
    <h5>Daftar Bahan Baku</h5>

    <div id="bahan-list">
        <div class="row mb-2">
            <div class="col-md-6">
                <select name="bahan_id[]" class="form-select" required>
                    <option value="">-- Pilih Bahan Baku --</option>
                    <?php foreach($bahan as $b): ?>
                        <option value="<?= $b['id'] ?>">
                            <?= $b['nama'] ?> (stok: <?= $b['jumlah'] . ' ' . $b['satuan'] ?>)
                        </option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="col-md-4">
                <input type="number" name="jumlah_diminta[]" class="form-control" placeholder="Jumlah" min="1" required>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger" onclick="removeRow(this)">X</button>
            </div>
        </div>
    </div>

    <br>
    <button type="button" class="btn btn-success" onclick="addRow()">+ Tambah Bahan</button>
    <br><br>
    <button type="submit" class="btn btn-primary">Kirim Permintaan</button>
    <br><br>
    <a href="/permintaan" class="btn btn-secondary">Kembali</a>
</form>

<script>
function addRow() {
    const list = document.getElementById('bahan-list');
    const newRow = list.children[0].cloneNode(true);
    newRow.querySelectorAll('input, select').forEach(el => el.value = '');
    list.appendChild(newRow);
}

function removeRow(btn) {
    const list = document.getElementById('bahan-list');
    if (list.children.length > 1) btn.closest('.row').remove();
}
</script>

<?= $this->endSection() ?>
