<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>

<h3>Selamat Datang, <?= session()->get('name'); ?> </h3>

<?= $this->endSection(); ?>
