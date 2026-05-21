<h3 class="page-title">Dashboard</h3>

<div class="row">

    <div class="col-md-3">
        <div class="dashboard-card">
            <h5>Pasien</h5>
            <h2><?= $jumlah_pasien ?></h2>
        </div>
    </div>

    <div class="col-md-3">
        <div class="dashboard-card">
            <h5>Dokter</h5>
            <h2><?= $jumlah_dokter ?></h2>
        </div>
    </div>

    <div class="col-md-3">
        <div class="dashboard-card">
            <h5>Obat</h5>
            <h2><?= $jumlah_obat ?></h2>
        </div>
    </div>

    <div class="col-md-3">
        <div class="dashboard-card">
            <h5>Resep</h5>
            <h2><?= $jumlah_resep ?></h2>
        </div>
    </div>

</div>

<div class="row mt-4">
    <div class="col-md-8">
        <div class="panel-card">
            <h5>Ringkasan Sistem</h5>
            <p class="mb-2">Aplikasi SIMRS aktif dan siap digunakan untuk manajemen master data, transaksi resep, dan laporan.</p>
            <ul class="mb-0">
                <li>Pastikan input data pasien, dokter, dan obat selalu update.</li>
                <li>Gunakan menu Resep untuk transaksi harian.</li>
                <li>Gunakan menu Laporan untuk monitoring pemasukan.</li>
            </ul>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel-card">
            <h5>Quick Access</h5>
            <div class="d-grid gap-2">
                <a href="<?= site_url('pasien') ?>" class="btn btn-outline-primary btn-sm">Kelola Pasien</a>
                <a href="<?= site_url('resep') ?>" class="btn btn-outline-primary btn-sm">Input Resep</a>
                <a href="<?= site_url('laporan') ?>" class="btn btn-outline-primary btn-sm">Lihat Laporan</a>
            </div>
        </div>
    </div>
</div>
