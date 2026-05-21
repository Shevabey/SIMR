<h3 class="page-title">Dokter Interface</h3>

<div class="row">

    <div class="col-md-12">
        <div class="panel-card">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0">List Data</h5>
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambahDokter">Tambah Dokter</button>
            </div>
            <form method="get" action="<?= site_url('dokter') ?>" class="row g-2 mb-3">
                <div class="col-md-10">
                    <input type="text" name="q" class="form-control" placeholder="Filter nama/spesialis/no hp" value="<?= isset($q) ? htmlspecialchars($q, ENT_QUOTES, 'UTF-8') : '' ?>">
                </div>
                <div class="col-md-2 d-grid">
                    <button class="btn btn-outline-primary">Filter</button>
                </div>
            </form>
            <table class="table table-bordered">

            <tr>
                <th>Nama</th>
                <th>Spesialis</th>
                <th>No HP</th>
                <th>Aksi</th>
            </tr>

            <?php foreach ($dokter as $d): ?>

                <tr>

                    <td><?= $d->nama ?></td>
                    <td><?= $d->spesialis ?></td>
                    <td><?= $d->no_hp ?></td>

                    <td>
                        <a href="<?= site_url('dokter/hapus/' . $d->id) ?>" class="btn btn-danger btn-sm">
                            Hapus
                        </a>
                    </td>

                </tr>

            <?php endforeach; ?>

            </table>
        </div>

    </div>

</div>

<div class="modal fade" id="modalTambahDokter" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Dokter</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="post" action="<?= site_url('dokter/simpan') ?>">
                <div class="modal-body">
                    <div class="mb-2">
                        <input type="text" name="nama" class="form-control" placeholder="Nama Dokter" required>
                    </div>
                    <div class="mb-2">
                        <input type="text" name="spesialis" class="form-control" placeholder="Spesialis" required>
                    </div>
                    <div class="mb-2">
                        <input type="text" name="no_hp" class="form-control" placeholder="No HP" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
