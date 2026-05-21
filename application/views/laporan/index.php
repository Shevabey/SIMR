<h3 class="page-title">Laporan Interface</h3>

<div class="panel-card mb-3">
    <form method="get" action="<?= site_url('laporan') ?>" class="row g-2 align-items-end">
        <div class="col-md-4">
            <label class="form-label">Filter Tanggal</label>
            <input type="date" name="tanggal" class="form-control" value="<?= isset($tanggal_filter) ? $tanggal_filter : '' ?>">
        </div>
        <div class="col-md-4">
            <label class="form-label">Filter Pasien/Dokter</label>
            <input type="text" name="q" class="form-control" value="<?= isset($q) ? htmlspecialchars($q, ENT_QUOTES, 'UTF-8') : '' ?>">
        </div>
        <div class="col-md-4">
            <button type="submit" class="btn btn-primary">Filter</button>
            <a href="<?= site_url('laporan') ?>" class="btn btn-secondary">Reset</a>
            <a href="<?= site_url('laporan/export_csv') ?>" class="btn btn-success">Export CSV</a>
            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalTambahLaporan">Tambah Laporan</button>
        </div>
    </form>
</div>

<div class="row mb-3">
    <div class="col-md-3">
        <div class="dashboard-card">
            <h6>Jumlah Transaksi Harian</h6>
            <h2><?= isset($jumlah_transaksi) ? $jumlah_transaksi : 0 ?></h2>
        </div>
    </div>
    <div class="col-md-3">
        <div class="dashboard-card">
            <h6>Total Uang Harian</h6>
            <h2>Rp <?= number_format(isset($total_harian) ? $total_harian : 0) ?></h2>
        </div>
    </div>
    <div class="col-md-3">
        <div class="dashboard-card">
            <h6>Total Mingguan</h6>
            <h2>Rp <?= number_format(isset($total_mingguan) ? $total_mingguan : 0) ?></h2>
        </div>
    </div>
    <div class="col-md-3">
        <div class="dashboard-card">
            <h6>Total Bulanan</h6>
            <h2>Rp <?= number_format(isset($total_bulanan) ? $total_bulanan : 0) ?></h2>
        </div>
    </div>
</div>
<div class="row mb-3">
    <div class="col-md-3">
        <div class="dashboard-card">
            <h6>Total Tahunan</h6>
            <h2>Rp <?= number_format(isset($total_tahunan) ? $total_tahunan : 0) ?></h2>
        </div>
    </div>
</div>

<div class="panel-card">
<table class="table table-bordered">

    <tr>
        <th>No</th>
        <th>Tanggal</th>
        <th>Pasien</th>
        <th>Dokter</th>
        <th>Total</th>
    </tr>

    <?php $no = 1; foreach ($laporan as $l): ?>

        <tr>
            <td><?= $no++ ?></td>
            <td><?= $l->tanggal ?></td>
            <td><?= $l->pasien_nama ?></td>
            <td><?= $l->dokter_nama ?></td>
            <td>Rp <?= number_format($l->total) ?></td>
        </tr>

    <?php endforeach; ?>

</table>
</div>

<div class="modal fade" id="modalTambahLaporan" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Laporan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                Laporan ditambahkan otomatis dari transaksi resep yang sudah tersimpan.
            </div>
        </div>
    </div>
</div>
