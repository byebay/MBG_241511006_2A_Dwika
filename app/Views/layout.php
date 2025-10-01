<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'Proyek 3 ETS' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
  <div class="container">
    <a class="navbar-brand" href="/dashboard">Program MBG</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="/dashboard">Dashboard</a></li>
        <?php if (session()->get('role') === 'gudang'): ?>
          <li class="nav-item"><a class="nav-link" href="/user/users">User</a></li>
          <li class="nav-item"><a class="nav-link" href="/products">Bahan Baku</a></li>
        <?php endif; ?>
        <li class="nav-item"><a class="nav-link" href="/logout">Logout</a></li>
      </ul>
    </div>
  </div>
</nav>
<div class="container">
    <?= $this->renderSection('content') ?>
</div>
</body>
</html>
