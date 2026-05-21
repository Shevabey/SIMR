<h3 class="page-title">Dokter Interface</h3>

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
                            <button type="button" class="btn btn-warning btn-sm btn-edit-dokter" data-id="<?= $d->id ?>" data-nama="<?= htmlspecialchars($d->nama, ENT_QUOTES, 'UTF-8') ?>" data-spesialis="<?= htmlspecialchars($d->spesialis, ENT_QUOTES, 'UTF-8') ?>" data-no_hp="<?= $d->no_hp ?>" data-bs-toggle="modal" data-bs-target="#modalTambahDokter">Edit</button>
                            <a href="<?= site_url('dokter/hapus/' . $d->id) ?>" class="btn btn-danger btn-sm btn-hapus-data">
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
                <input type="hidden" name="dokter_id" id="dokterId" value="">
                <div class="modal-body">
                    <div class="mb-2">
                        <input type="text" name="nama" id="dokterNama" class="form-control" placeholder="Nama Dokter" required>
                    </div>
                    <div class="mb-2">
                        <input type="text" name="spesialis" id="dokterSpesialis" class="form-control" placeholder="Spesialis" required>
                    </div>
                    <div class="mb-2">
                        <input type="text" name="no_hp" id="dokterNoHp" class="form-control" placeholder="No HP" required>
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
        const modalTambahDokter = document.getElementById('modalTambahDokter');
        const modalTitle = modalTambahDokter.querySelector('.modal-title');
        const dokterIdInput = document.getElementById('dokterId');
        const dokterNamaInput = document.getElementById('dokterNama');
        const dokterSpesialisInput = document.getElementById('dokterSpesialis');
        const dokterNoHpInput = document.getElementById('dokterNoHp');

        modalTambahDokter.addEventListener('show.bs.modal', function(e) {
            const button = e.relatedTarget;
            if (button && button.classList.contains('btn-edit-dokter')) {
                modalTitle.textContent = 'Edit Dokter';
                dokterIdInput.value = button.getAttribute('data-id');
                dokterNamaInput.value = button.getAttribute('data-nama');
                dokterSpesialisInput.value = button.getAttribute('data-spesialis');
                dokterNoHpInput.value = button.getAttribute('data-no_hp');
            } else {
                modalTitle.textContent = 'Tambah Dokter';
                dokterIdInput.value = '';
                dokterNamaInput.value = '';
                dokterSpesialisInput.value = '';
                dokterNoHpInput.value = '';
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