<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Daftar User</h2>
        <a href="/user/create_user" class="btn btn-primary">+ Tambah User</a>
    </div>

    <?php if(session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <!-- <a href="/user/create_user" class="btn btn-primary mb-3">Tambah User</a> -->
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($users)): ?>
                <?php foreach($users as $user): ?>
                    <tr>
                        <td><?= $user['name'] ?></td>
                        <td><?= $user['email'] ?></td>
                        <td><?= ucfirst($user['role']) ?></td>
                        <td>
                            <a href="/user/edit_user/<?= $user['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="/user/delete_user/<?= $user['id'] ?>" 
                            onclick="return confirm('Yakin hapus user ini?')" 
                            class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" class="text-center">Belum ada user</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <a href="/dashboard" class="btn btn-secondary">Kembali</a>
<?= $this->endSection() ?>
