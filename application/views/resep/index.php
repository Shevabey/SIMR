<h3 class="page-title">Resep Interface</h3>

<div class="panel-card">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0">List Data Resep</h5>
        <button class="btn btn-primary btn-sm" id="btnBukaTambahResep" data-bs-toggle="modal" data-bs-target="#modalTambahResep">Tambah Resep</button>
    </div>
    <form method="get" action="<?= site_url('resep') ?>" class="row g-2 mb-3">
        <div class="col-md-10">
            <input type="text" name="q" class="form-control" placeholder="Filter pasien/dokter/tanggal" value="<?= isset($q) ? htmlspecialchars($q, ENT_QUOTES, 'UTF-8') : '' ?>">
        </div>
        <div class="col-md-2 d-grid">
            <button class="btn btn-outline-primary">Filter</button>
        </div>
    </form>

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Pasien</th>
            <th>Dokter</th>
            <th>Tanggal</th>
            <th>Total</th>
            <th>Aksi</th>
        </tr>
        <?php $no = 1; foreach ($resep as $r): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $r->pasien_nama ?></td>
                <td><?= $r->dokter_nama ?></td>
                <td><?= $r->tanggal ?></td>
                <td>Rp <?= number_format($r->total) ?></td>
                <td>
                    <a href="<?= site_url('resep/detail/' . $r->id) ?>" class="btn btn-info btn-sm" target="_blank">Detail</a>
                    <button type="button" class="btn btn-warning btn-sm btn-edit-resep" data-id="<?= $r->id ?>" data-bs-toggle="modal" data-bs-target="#modalTambahResep">Edit</button>
                    <a href="<?= site_url('resep/hapus/' . $r->id) ?>" class="btn btn-danger btn-sm btn-hapus-data">Hapus</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

<div class="modal fade" id="modalTambahResep" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalResepTitle">Form Detail Resep</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form method="post" action="<?= site_url('resep/simpan') ?>" id="formResep">
                <input type="hidden" name="resep_id" id="resepId" value="">
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label">Pasien</label>
                            <select name="pasien_id" id="pasienId" class="form-control" required>
                                <option value="">Pilih Pasien</option>
                                <?php foreach ($pasien as $p): ?>
                                    <option value="<?= $p->id ?>"><?= $p->nama ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Dokter</label>
                            <select name="dokter_id" id="dokterId" class="form-control" required>
                                <option value="">Pilih Dokter</option>
                                <?php foreach ($dokter as $d): ?>
                                    <option value="<?= $d->id ?>"><?= $d->nama ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Tanggal</label>
                            <input type="date" name="tanggal" id="tanggalResep" class="form-control" value="<?= date('Y-m-d') ?>" required>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered" id="tabelObat">
                            <thead>
                                <tr>
                                    <th>Obat</th>
                                    <th>Qty</th>
                                    <th>Harga</th>
                                    <th>Subtotal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>

                    <button type="button" class="btn btn-secondary btn-sm mb-3" id="btnTambahObat">Tambah Obat</button>

                    <div class="row justify-content-end">
                        <div class="col-md-4">
                            <div class="panel-card">
                                <div class="mb-2">
                                    <label class="form-label">Subtotal</label>
                                    <input type="number" id="subtotalSemua" class="form-control" readonly>
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">Grand Total</label>
                                    <input type="number" id="grandTotal" name="grand_total" class="form-control" readonly>
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">Bayar</label>
                                    <input type="number" id="bayar" class="form-control">
                                </div>
                                <div>
                                    <label class="form-label">Kembalian</label>
                                    <input type="number" id="kembalian" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" id="btnSimpanResep">Simpan Resep</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    (function () {
        const obatOptions = `<?php foreach ($obat as $o): ?><option value="<?= $o->id ?>" data-harga="<?= (int) $o->harga ?>"><?= htmlspecialchars($o->nama_obat, ENT_QUOTES, 'UTF-8') ?></option><?php endforeach; ?>`;
        const tbody = document.querySelector('#tabelObat tbody');
        const btnTambah = document.getElementById('btnTambahObat');
        const subtotalSemua = document.getElementById('subtotalSemua');
        const grandTotal = document.getElementById('grandTotal');
        const bayar = document.getElementById('bayar');
        const kembalian = document.getElementById('kembalian');
        const resepIdInput = document.getElementById('resepId');
        const pasienIdInput = document.getElementById('pasienId');
        const dokterIdInput = document.getElementById('dokterId');
        const tanggalResepInput = document.getElementById('tanggalResep');
        const modalTitle = document.getElementById('modalResepTitle');
        const btnSimpanResep = document.getElementById('btnSimpanResep');
        const btnBukaTambahResep = document.getElementById('btnBukaTambahResep');

        function hitungRingkasan() {
            let total = 0;
            tbody.querySelectorAll('.subtotal-input').forEach(function (el) {
                total += parseInt(el.value || '0', 10);
            });
            subtotalSemua.value = total;
            grandTotal.value = total;
            const bayarVal = parseInt(bayar.value || '0', 10);
            kembalian.value = Math.max(bayarVal - total, 0);
        }

        function hitungBaris(row) {
            const obatSelect = row.querySelector('.obat-select');
            const qtyInput = row.querySelector('.qty-input');
            const hargaInput = row.querySelector('.harga-input');
            const subtotalInput = row.querySelector('.subtotal-input');
            const selected = obatSelect.options[obatSelect.selectedIndex];
            const harga = parseInt((selected && selected.dataset.harga) || '0', 10);
            hargaInput.value = harga;
            const qty = parseInt(qtyInput.value || '0', 10);
            subtotalInput.value = qty * harga;
            hitungRingkasan();
        }

        function tambahBaris(item = null) {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td>
                    <select name="obat_id[]" class="form-control obat-select" required>
                        <option value="">Pilih Obat</option>
                        ${obatOptions}
                    </select>
                </td>
                <td><input type="number" min="1" name="qty[]" class="form-control qty-input" value="${item && item.qty ? item.qty : 1}" required></td>
                <td><input type="number" name="harga[]" class="form-control harga-input" readonly></td>
                <td><input type="number" name="subtotal[]" class="form-control subtotal-input" readonly></td>
                <td><button type="button" class="btn btn-danger btn-sm btn-hapus-baris">Hapus</button></td>
            `;
            tbody.appendChild(tr);
            if (item && item.obat_id) {
                tr.querySelector('.obat-select').value = String(item.obat_id);
            }
            hitungBaris(tr);

            tr.querySelector('.obat-select').addEventListener('change', function () { hitungBaris(tr); });
            tr.querySelector('.qty-input').addEventListener('input', function () { hitungBaris(tr); });
            tr.querySelector('.btn-hapus-baris').addEventListener('click', function () {
                tr.remove();
                hitungRingkasan();
            });
        }

        function resetFormResep() {
            resepIdInput.value = '';
            pasienIdInput.value = '';
            dokterIdInput.value = '';
            tanggalResepInput.value = '<?= date('Y-m-d') ?>';
            tbody.innerHTML = '';
            bayar.value = '';
            modalTitle.textContent = 'Form Detail Resep';
            btnSimpanResep.textContent = 'Simpan Resep';
            tambahBaris();
        }

        btnBukaTambahResep.addEventListener('click', resetFormResep);

        document.querySelectorAll('.btn-edit-resep').forEach(function (btn) {
            btn.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                fetch('<?= site_url('resep/edit_data/') ?>' + id)
                    .then(res => res.json())
                    .then(data => {
                        resepIdInput.value = data.header.id || '';
                        pasienIdInput.value = data.header.pasien_id || '';
                        dokterIdInput.value = data.header.dokter_id || '';
                        tanggalResepInput.value = data.header.tanggal || '<?= date('Y-m-d') ?>';
                        tbody.innerHTML = '';
                        bayar.value = '';
                        modalTitle.textContent = 'Edit Resep';
                        btnSimpanResep.textContent = 'Update Resep';
                        if (Array.isArray(data.detail) && data.detail.length > 0) {
                            data.detail.forEach(function (item) { tambahBaris(item); });
                        } else {
                            tambahBaris();
                        }
                    });
            });
        });

        btnTambah.addEventListener('click', tambahBaris);
        bayar.addEventListener('input', hitungRingkasan);
        tambahBaris();
    })();
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.btn-hapus-data').forEach(function (button) {
        button.addEventListener('click', function (e) {
            e.preventDefault();
            const href = this.getAttribute('href');
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    title: 'Yakin hapus resep?',
                    text: 'Data resep dan detailnya akan dihapus permanen.',
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
            } else if (confirm('Yakin hapus resep?')) {
                window.location.href = href;
            }
        });
    });
});
</script>
