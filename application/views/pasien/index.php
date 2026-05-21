<h3 class="page-title">Pasien Interface</h3>

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
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambahPasien">Tambah Pasien</button>
            </div>
            <form method="get" action="<?= site_url('pasien') ?>" class="row g-2 mb-3">
                <div class="col-md-10">
                    <input type="text" name="q" class="form-control" placeholder="Filter nama/alamat/no hp" value="<?= isset($q) ? htmlspecialchars($q, ENT_QUOTES, 'UTF-8') : '' ?>">
                </div>
                <div class="col-md-2 d-grid">
                    <button class="btn btn-outline-primary">Filter</button>
                </div>
            </form>
            <table class="table table-bordered">

                <tr>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>No HP</th>
                    <th>Aksi</th>
                </tr>

                <?php foreach ($pasien as $p): ?>

                    <tr>
                        <td><?= $p->nama ?></td>
                        <td><?= $p->alamat ?></td>
                        <td><?= $p->no_hp ?></td>

                        <td>
                            <button type="button" class="btn btn-warning btn-sm btn-edit-pasien" data-id="<?= $p->id ?>" data-nama="<?= htmlspecialchars($p->nama, ENT_QUOTES, 'UTF-8') ?>" data-alamat="<?= htmlspecialchars($p->alamat, ENT_QUOTES, 'UTF-8') ?>" data-no_hp="<?= $p->no_hp ?>" data-tanggal_lahir="<?= $p->tanggal_lahir ?>" data-bs-toggle="modal" data-bs-target="#modalTambahPasien">Edit</button>
                            <a href="<?= site_url('pasien/hapus/' . $p->id) ?>" class="btn btn-danger btn-sm btn-hapus-data">
                                Hapus
                            </a>
                        </td>
                    </tr>

                <?php endforeach; ?>

            </table>
        </div>

    </div>

</div>

<div class="modal fade" id="modalTambahPasien" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Pasien</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="post" action="<?= site_url('pasien/simpan') ?>">
                <input type="hidden" name="pasien_id" id="pasienId" value="">
                <div class="modal-body">
                    <div class="mb-2">
                        <input type="text" name="nama" id="pasienNama" class="form-control" placeholder="Nama" required>
                    </div>
                    <div class="mb-2">
                        <textarea name="alamat" id="pasienAlamat" class="form-control" placeholder="Alamat" required></textarea>
                    </div>
                    <div class="mb-2">
                        <input type="text" name="no_hp" id="pasienNoHp" class="form-control" placeholder="No HP" required>
                    </div>
                    <div class="mb-2">
                        <input type="date" name="tanggal_lahir" id="pasienTanggalLahir" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modalTambahPasien = document.getElementById('modalTambahPasien');
        const modalTitle = modalTambahPasien.querySelector('.modal-title');
        const pasienIdInput = document.getElementById('pasienId');
        const pasienNamaInput = document.getElementById('pasienNama');
        const pasienAlamatInput = document.getElementById('pasienAlamat');
        const pasienNoHpInput = document.getElementById('pasienNoHp');
        const pasienTanggalLahirInput = document.getElementById('pasienTanggalLahir');

        modalTambahPasien.addEventListener('show.bs.modal', function(e) {
            const button = e.relatedTarget;
            if (button && button.classList.contains('btn-edit-pasien')) {
                modalTitle.textContent = 'Edit Pasien';
                pasienIdInput.value = button.getAttribute('data-id');
                pasienNamaInput.value = button.getAttribute('data-nama');
                pasienAlamatInput.value = button.getAttribute('data-alamat');
                pasienNoHpInput.value = button.getAttribute('data-no_hp');
                pasienTanggalLahirInput.value = button.getAttribute('data-tanggal_lahir');
            } else {
                modalTitle.textContent = 'Tambah Pasien';
                pasienIdInput.value = '';
                pasienNamaInput.value = '';
                pasienAlamatInput.value = '';
                pasienNoHpInput.value = '';
                pasienTanggalLahirInput.value = '';
            }
        });

        document.querySelectorAll('.btn-hapus-data').forEach(function(button) {
            button.addEventListener('click', function(e) {
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