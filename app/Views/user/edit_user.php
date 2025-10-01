<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

    <h2>Edit User</h2>

    <form action="/user/update_user/<?= $user['id'] ?>" method="post">
        <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" name="username" value="<?= $user['username'] ?>" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Password (kosongkan jika tidak diubah)</label>
            <input type="password" name="password" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Role</label>
            <select name="role" class="form-select" required>
                <option value="user" <?= $user['role']=='user'?'selected':'' ?>>Mahasiswa</option>
                <option value="admin" <?= $user['role']=='admin'?'selected':'' ?>>Admin</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="/user/users" class="btn btn-secondary">Kembali</a>
    </form>
<?= $this->endSection() ?>
