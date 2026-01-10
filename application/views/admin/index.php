<?php $this->load->view('layouts/header_admin'); ?>

<?php if ($this->session->userdata('id_user_level') == '1'): ?>
    <div class="mb-4">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-home"></i> Dashboard</h1>
        </div>

        <!-- Content Row -->
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            Selamat datang <span class="text-uppercase"><b><?= $this->session->username; ?>!</b></span> Anda bisa
            mengoperasikan sistem dengan wewenang tertentu melalui pilihan menu di bawah.
        </div>
    </div>
<?php endif; ?>
<?php if ($this->session->userdata('id_user_level') == '2'): ?>
    <div class="mb-4">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-home"></i> Dashboard</h1>
        </div>

        <!-- Content Row -->
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            Selamat datang <span class="text-uppercase"><b><?= $this->session->username; ?>!</b></span> Anda bisa
            mengoperasikan sistem dengan wewenang tertentu melalui pilihan menu di bawah.
        </div>
        <div class="row">

            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><a
                                        href="<?= base_url('Perhitungan/hasil'); ?>"
                                        class="text-secondary text-decoration-none">Data Hasil Akhir</a></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-chart-area fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><a href="<?= base_url('Profile'); ?>"
                                        class="text-secondary text-decoration-none">Data Profile</a></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<div class="row">

    <div class="col-md-3">
        <div class="card shadow border-left-success">
            <div class="card-body">
                <h6>Total Alternatif</h6>
                <h3><?= $total_alternatif ?></h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow border-left-info">
            <div class="card-body">
                <h6>Total Kriteria</h6>
                <h3><?= $total_kriteria ?></h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow border-left-warning">
            <div class="card-body">
                <h6>Periode Aktif</h6>
                <h5><?= $bulan ?>/<?= $tahun ?></h5>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow border-left-primary">
            <div class="card-body">
                <h6>Ranking Terbaik</h6>
                <h5>
                    <?= $ranking_teratas ? $ranking_teratas->nilai : '-' ?>
                </h5>
            </div>
        </div>
    </div>


</div>


<?php $this->load->view('layouts/footer_admin'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>