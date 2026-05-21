<h3 class="page-title">User Interface</h3>

<?php if ($this->session->flashdata('error')): ?>
    <div class="alert alert-danger"><?= $this->session->flashdata('error') ?></div>
<?php endif; ?>
<?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success"><?= $this->session->flashdata('success') ?></div>
<?php endif; ?>

<div class="row">

    <div class="col-md-12">
        <div class="panel-card">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0">List Data</h5>
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambahUser">Tambah User</button>
            </div>
            <form method="get" action="<?= site_url('user') ?>" class="row g-2 mb-3">
                <div class="col-md-10">
                    <input type="text" name="q" class="form-control" placeholder="Filter nama/username/role" value="<?= isset($q) ? htmlspecialchars($q, ENT_QUOTES, 'UTF-8') : '' ?>">
                </div>
                <div class="col-md-2 d-grid">
                    <button class="btn btn-outline-primary">Filter</button>
                </div>
            </form>
            <table class="table table-bordered">

            <tr>
                <th>Nama</th>
                <th>Username</th>
                <th>Role</th>
                <th>Aksi</th>
            </tr>

            <?php foreach ($user as $u): ?>

                <tr>

                    <td><?= $u->nama ?></td>
                    <td><?= $u->username ?></td>
                    <td><?= $u->role ?></td>

                    <td>
                        <a href="<?= site_url('user/hapus/' . $u->id) ?>" class="btn btn-danger btn-sm btn-hapus-data">
                            Hapus
                        </a>
                    </td>

                </tr>

            <?php endforeach; ?>

            </table>
        </div>

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.btn-hapus-data').forEach(function (button) {
        button.addEventListener('click', function (e) {
            e.preventDefault();
            const href = this.getAttribute('href');
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    title: 'Yakin hapus data?',
                    text: 'Data yang dihapus tidak bisa dikembalikan.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, hapus',
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#d33'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = href;
                    }
                });
            } else if (confirm('Yakin hapus data?')) {
                window.location.href = href;
            }
        });
    });
});
</script>

<div class="modal fade" id="modalTambahUser" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="post" action="<?= site_url('user/simpan') ?>">
                <div class="modal-body">
                    <div class="mb-2">
                        <input type="text" name="nama" class="form-control" placeholder="Nama" required>
                    </div>
                    <div class="mb-2">
                        <input type="text" name="username" class="form-control" placeholder="Username" required>
                    </div>
                    <div class="mb-2">
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                    </div>
                    <div class="mb-2">
                        <select name="role" class="form-control" required>
                            <option value="admin">admin</option>
                            <option value="kasir">kasir</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
