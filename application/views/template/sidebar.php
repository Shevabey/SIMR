<div class="sidebar">
    <?php
    $current = $this->uri->segment(1);
    ?>

    <div class="sidebar-mobile-head">
        <h4>SIMRS</h4>
        <button type="button" class="sidebar-dropdown-btn" id="sidebarDropdownBtn">Menu</button>
    </div>

    <div class="sidebar-menu" id="sidebarMenu">

    <a href="<?= site_url('dashboard') ?>" class="<?= $current === 'dashboard' ? 'active' : '' ?>">Dashboard</a>

    <a href="<?= site_url('user') ?>" class="<?= $current === 'user' ? 'active' : '' ?>">User</a>

    <a href="<?= site_url('pasien') ?>" class="<?= $current === 'pasien' ? 'active' : '' ?>">Pasien</a>

    <a href="<?= site_url('dokter') ?>" class="<?= $current === 'dokter' ? 'active' : '' ?>">Dokter</a>

    <a href="<?= site_url('obat') ?>" class="<?= $current === 'obat' ? 'active' : '' ?>">Obat</a>

    <a href="<?= site_url('resep') ?>" class="<?= $current === 'resep' ? 'active' : '' ?>">Resep</a>

    <a href="<?= site_url('laporan') ?>" class="<?= $current === 'laporan' ? 'active' : '' ?>">Laporan</a>

    <a href="<?= site_url('auth/logout') ?>" class="logout-link">Logout</a>
    </div>

</div>
