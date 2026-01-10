<?php $this->load->view('layouts/header_admin'); ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-chart-area"></i> Data Hasil Akhir</h1>
</div>
<?php
$is_admin = $this->session->userdata('id_user_level') == "1";
?>

<div class="card shadow mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Hasil Akhir Perankingan</h6>
    </div>
    <div class="">
        <form method="get" action="<?= base_url('perhitungan/hasil') ?>" class="mt-2">
            <div class="row">
                <div class="col-md-4 ml-4">
                    <select name="bulan" class="form-control">
                        <option value="">-- Pilih Bulan --</option>
                        <?php
                        $bulan = [
                            1 => 'Januari',
                            2 => 'Februari',
                            3 => 'Maret',
                            4 => 'April',
                            5 => 'Mei',
                            6 => 'Juni',
                            7 => 'Juli',
                            8 => 'Agustus',
                            9 => 'September',
                            10 => 'Oktober',
                            11 => 'November',
                            12 => 'Desember'
                        ];
                        $bulan_pilih = $this->input->get('bulan') ?? date('n');
                        foreach ($bulan as $k => $v):
                        ?>
                            <option value="<?= $k ?>" <?= ($k == $bulan_pilih) ? 'selected' : '' ?>>
                                <?= $v ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>

                <div class="col-md-3">
                    <input type="number" name="tahun" class="form-control"
                        value="<?= $this->input->get('tahun') ?? date('Y') ?>">
                </div>

                <div class="col-md-3">
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-search"></i> Tampilkan
                    </button>
                    <a href="<?= base_url('Laporan/cetak_laporan_hasil?bulan=' . ($bulan_pilih ?? date('n')) . '&tahun=' . ($tahun ?? date('Y'))) ?>"
                        class="btn btn-primary">
                        <i class="fa fa-print"></i> Cetak Data
                    </a>
                </div>
            </div>
        </form>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead class="bg-success text-white">
                    <tr align="center">
                        <th>Nik</th>
                        <th>Alternatif / Nama Karyawan</th>
                        <th>Departemen</th>
                        <?php if ($is_admin): ?>
                            <th>Nilai Preferensi</th>
                        <?php endif; ?>
                        <th width="15%">Ranking</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($hasil as $keys): ?>
                        <tr align="center">
                            <td>
                                <?php
                                $nim_alternatif = $this->Perhitungan_model->get_hasil_alternatif($keys->id_alternatif);
                                echo $nim_alternatif['nik'];
                                ?>

                            </td>

                            <td align="left" style="padding-left: 5px;">

                                <?php
                                $nama_alternatif = $this->Perhitungan_model->get_hasil_alternatif($keys->id_alternatif);
                                echo $nama_alternatif['nama'];
                                ?>

                            </td>

                            <td style="padding-left: 5px;">

                                <?php
                                $jurusan_alternatif = $this->Perhitungan_model->get_hasil_alternatif($keys->id_alternatif);
                                echo $jurusan_alternatif['departemen'];
                                ?>

                            </td>
                            <?php if ($is_admin): ?>
                                <td><?= $keys->nilai ?></td>
                            <?php endif; ?>
                            <td><?= $no; ?></td>
                        </tr>
                    <?php
                        $no++;
                    endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
$this->load->view('layouts/footer_admin');
?>