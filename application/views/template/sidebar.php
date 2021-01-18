<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url() ?>">
        <div class="sidebar-brand-icon">
            <i class="fas fa-poll-h"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Survey</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?= $this->uri->segment(1) == 'home' || $this->uri->segment(1) == '' ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url() ?>">
            <i class="fas fa-fw fa-home"></i>
            <span>Home</span></a>
    </li>

    <?php if (in_array($this->session->userdata('level'), array('Admin'))) : ?>
        <li class="nav-item <?= $this->uri->segment(1) == 'pertanyaan' ? 'active' : '' ?>">
            <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsepertanyaan" aria-expanded="true" aria-controls="collapsePages">
                <i class="fas fa-fw fa-poll-h"></i>
                <span>Pertanyaan</span>
            </a>
            <div id="collapsepertanyaan" class="collapse <?= $this->uri->segment(1) == 'pertanyaan' ? 'show' : '' ?>" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item <?= $this->uri->segment(1) == 'pertanyaan' && $this->uri->segment(2) == 'tambah' ? 'active' : '' ?>" href="<?= site_url('pertanyaan/tambah') ?>">Tambah Pertanyaan</a>
                    <a class="collapse-item <?= $this->uri->segment(1) == 'pertanyaan' && $this->uri->segment(2) == '' ? 'active' : '' ?>" href="<?= site_url('pertanyaan') ?>">Data Pertanyaan</a>
                    <a class="collapse-item <?= $this->uri->segment(1) == 'pertanyaan' && $this->uri->segment(2) == 'prioritas' ? 'active' : '' ?>" href="<?= site_url('pertanyaan/prioritas') ?>">Prioritas</a>
                </div>
            </div>
        </li>
    <?php endif; ?>

    <?php if (in_array($this->session->userdata('level'), array('Admin'))) : ?>
        <li class="nav-item <?= $this->uri->segment(1) == 'nilai' ? 'active' : '' ?>">
            <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsenilai" aria-expanded="true" aria-controls="collapsePages">
                <i class="fas fa-fw fa-check"></i>
                <span>Nilai</span>
            </a>
            <div id="collapsenilai" class="collapse <?= $this->uri->segment(1) == 'nilai' ? 'show' : '' ?>" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item <?= $this->uri->segment(1) == 'nilai' && $this->uri->segment(2) == 'tambah' ? 'active' : '' ?>" href="<?= site_url('nilai/tambah') ?>">Tambah Nilai</a>
                    <a class="collapse-item <?= $this->uri->segment(1) == 'nilai' && $this->uri->segment(2) == '' ? 'active' : '' ?>" href="<?= site_url('nilai') ?>">Data Nilai</a>
                    <a class="collapse-item <?= $this->uri->segment(1) == 'nilai' && $this->uri->segment(2) == 'prioritas' ? 'active' : '' ?>" href="<?= site_url('nilai/prioritas') ?>">Prioritas</a>
                </div>
            </div>
        </li>

        <li class="nav-item <?= $this->uri->segment(1) == 'pelanggan' ? 'active' : '' ?>">
            <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsepelanggan" aria-expanded="true" aria-controls="collapsePages">
                <i class="fas fa-fw fa-user"></i>
                <span>Pelanggan</span>
            </a>
            <div id="collapsepelanggan" class="collapse <?= $this->uri->segment(1) == 'pelanggan' ? 'show' : '' ?>" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item <?= $this->uri->segment(1) == 'pelanggan' && $this->uri->segment(2) == 'tambah' ? 'active' : '' ?>" href="<?= site_url('pelanggan/tambah') ?>">Tambah Pelanggan</a>
                    <a class="collapse-item <?= $this->uri->segment(1) == 'pelanggan' && $this->uri->segment(2) == '' ? 'active' : '' ?>" href="<?= site_url('pelanggan') ?>">Data Pelanggan</a>
                </div>
            </div>
        </li>

        <li class="nav-item <?= $this->uri->segment(1) == 'pegawai' ? 'active' : '' ?>">
            <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsepegawai" aria-expanded="true" aria-controls="collapsePages">
                <i class="fas fa-fw fa-users"></i>
                <span>Pegawai</span>
            </a>
            <div id="collapsepegawai" class="collapse <?= $this->uri->segment(1) == 'pegawai' ? 'show' : '' ?>" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item <?= $this->uri->segment(1) == 'pegawai' && $this->uri->segment(2) == 'tambah' ? 'active' : '' ?>" href="<?= site_url('pegawai/tambah') ?>">Tambah Pegawai</a>
                    <a class="collapse-item <?= $this->uri->segment(1) == 'pegawai' && $this->uri->segment(2) == '' ? 'active' : '' ?>" href="<?= site_url('pegawai') ?>">Data Pegawai</a>
                </div>
            </div>
        </li>

        <li class="nav-item <?= $this->uri->segment(1) == 'divisi' ? 'active' : '' ?>">
            <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsedivisi" aria-expanded="true" aria-controls="collapsePages">
                <i class="fas fa-fw fa-cogs"></i>
                <span>Divisi</span>
            </a>
            <div id="collapsedivisi" class="collapse <?= $this->uri->segment(1) == 'divisi' ? 'show' : '' ?>" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item <?= $this->uri->segment(1) == 'divisi' && $this->uri->segment(2) == 'tambah' ? 'active' : '' ?>" href="<?= site_url('divisi/tambah') ?>">Tambah Divisi</a>
                    <a class="collapse-item <?= $this->uri->segment(1) == 'divisi' && $this->uri->segment(2) == '' ? 'active' : '' ?>" href="<?= site_url('divisi') ?>">Data Divisi</a>
                </div>
            </div>
        </li>

        <li class="nav-item <?= $this->uri->segment(1) == 'hasil' ? 'active' : '' ?>">
            <a class="nav-link" href="<?= site_url('hasil') ?>">
                <i class="fas fa-fw fa-list-ol"></i>
                <span>Hasil Survey</span></a>
        </li>
    <?php endif; ?>

    <?php if (in_array($this->session->userdata('level'), array('Pelanggan'))) : ?>
        <li class="nav-item <?= $this->uri->segment(1) == 'survey' ? 'active' : '' ?>">
            <a class="nav-link" href="<?= site_url('survey') ?>">
                <i class="fas fa-fw fa-poll-h"></i>
                <span>Survey</span></a>
        </li>
    <?php endif; ?>

    <?php if (in_array($this->session->userdata('level'), array('Pegawai', 'Admin'))) : ?>
        <li class="nav-item <?= $this->uri->segment(1) == 'grafik' ? 'active' : '' ?>">
            <a class="nav-link" href="<?= site_url('grafik') ?>">
                <i class="fas fa-fw fa-chart-bar"></i>
                <span>Grafik</span></a>
        </li>
    <?php endif; ?>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->