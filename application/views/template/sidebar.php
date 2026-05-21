<div class="sidebar">
    <?php
    $current = $this->uri->segment(1);
    $namaLogin = (string) $this->session->userdata('nama');
    $usernameLogin = (string) $this->session->userdata('username');
    $roleLogin = (string) $this->session->userdata('role');
    $isKasir = strtolower($roleLogin) === 'kasir';
    ?>

    <div class="sidebar-mobile-head">
        <h4><i class="bi bi-hospital me-2"></i>SIMRS</h4>
        <button type="button" class="sidebar-dropdown-btn" id="sidebarDropdownBtn">Menu</button>
    </div>

    <div class="sidebar-menu" id="sidebarMenu">
    <?php if ($namaLogin !== '' || $usernameLogin !== '' || $roleLogin !== ''): ?>
    <div class="sidebar-account-box">
        <div class="sidebar-account-title"><i class="bi bi-person-badge me-1"></i>Akun Login</div>
        <div class="sidebar-account-item"><?= htmlspecialchars($namaLogin !== '' ? $namaLogin : '-', ENT_QUOTES, 'UTF-8') ?></div>
        <div class="sidebar-account-meta"><i class="bi bi-at me-1"></i><?= htmlspecialchars($usernameLogin !== '' ? $usernameLogin : '-', ENT_QUOTES, 'UTF-8') ?></div>
        <div class="sidebar-account-role"><i class="bi bi-shield-check me-1"></i><?= htmlspecialchars($roleLogin !== '' ? ucfirst($roleLogin) : '-', ENT_QUOTES, 'UTF-8') ?></div>
    </div>
    <?php endif; ?>

    <a href="<?= site_url('dashboard') ?>" class="<?= $current === 'dashboard' ? 'active' : '' ?>"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a>

    <?php if ($isKasir): ?>
    <a href="<?= site_url('pasien') ?>" class="<?= $current === 'pasien' ? 'active' : '' ?>"><i class="bi bi-person-vcard me-2"></i>Data Pasien</a>
    <a href="<?= site_url('resep') ?>" class="<?= $current === 'resep' ? 'active' : '' ?>"><i class="bi bi-journal-medical me-2"></i>Resep Obat</a>
    <a href="<?= site_url('laporan') ?>" class="<?= $current === 'laporan' ? 'active' : '' ?>"><i class="bi bi-clipboard-data me-2"></i>Laporan Peresepan</a>
    <?php else: ?>
    <a href="<?= site_url('user') ?>" class="<?= $current === 'user' ? 'active' : '' ?>"><i class="bi bi-people me-2"></i>User</a>
    <a href="<?= site_url('pasien') ?>" class="<?= $current === 'pasien' ? 'active' : '' ?>"><i class="bi bi-person-vcard me-2"></i>Pasien</a>
    <a href="<?= site_url('dokter') ?>" class="<?= $current === 'dokter' ? 'active' : '' ?>"><i class="bi bi-heart-pulse me-2"></i>Dokter</a>
    <a href="<?= site_url('obat') ?>" class="<?= $current === 'obat' ? 'active' : '' ?>"><i class="bi bi-capsule-pill me-2"></i>Obat</a>
    <a href="<?= site_url('resep') ?>" class="<?= $current === 'resep' ? 'active' : '' ?>"><i class="bi bi-journal-medical me-2"></i>Resep</a>
    <a href="<?= site_url('laporan') ?>" class="<?= $current === 'laporan' ? 'active' : '' ?>"><i class="bi bi-clipboard-data me-2"></i>Laporan</a>
    <?php endif; ?>

    <a href="<?= site_url('auth/logout') ?>" class="logout-link"><i class="bi bi-box-arrow-right me-2"></i>Logout</a>
    </div>

</div>
