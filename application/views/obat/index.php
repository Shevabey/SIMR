<h3 class="page-title">Obat Interface</h3>

<div class="row">

    <div class="col-md-12">
        <div class="panel-card">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0">List Data</h5>
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambahObat">Tambah Obat</button>
            </div>
            <form method="get" action="<?= site_url('obat') ?>" class="row g-2 mb-3">
                <div class="col-md-10">
                    <input type="text" name="q" class="form-control" placeholder="Filter nama obat/stok/harga" value="<?= isset($q) ? htmlspecialchars($q, ENT_QUOTES, 'UTF-8') : '' ?>">
                </div>
                <div class="col-md-2 d-grid">
                    <button class="btn btn-outline-primary">Filter</button>
                </div>
            </form>
            <table class="table table-bordered">

            <tr>
                <th>Nama Obat</th>
                <th>Stok</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>

            <?php foreach ($obat as $o): ?>

                <tr>

                    <td><?= $o->nama_obat ?></td>
                    <td><?= $o->stok ?></td>
                    <td>Rp <?= number_format($o->harga) ?></td>

                    <td>
                        <a href="<?= site_url('obat/hapus/' . $o->id) ?>" class="btn btn-danger btn-sm">
                            Hapus
                        </a>
                    </td>

                </tr>

            <?php endforeach; ?>

            </table>
        </div>

    </div>

</div>

<div class="modal fade" id="modalTambahObat" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Obat</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="post" action="<?= site_url('obat/simpan') ?>">
                <div class="modal-body">
                    <div class="mb-2">
                        <input type="text" name="nama_obat" class="form-control" placeholder="Nama Obat" required>
                    </div>
                    <div class="mb-2">
                        <input type="number" name="stok" class="form-control" placeholder="Stok" required>
                    </div>
                    <div class="mb-2">
                        <input type="number" name="harga" class="form-control" placeholder="Harga" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
