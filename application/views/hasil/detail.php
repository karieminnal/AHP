<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<?php $this->load->view('template/header'); ?>

<div id="wrapper">
    <?php $this->load->view('template/sidebar'); ?>
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <?php $this->load->view('template/topbar'); ?>

            <div class="container-fluid">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Detail Hasil Penilaian Metode AHP Divisi <?= $divisi->nama_divisi ?></h6>
                            </div>
                            <div class="card-body">
                                <?= anchor('hasil', 'Kembali', 'class="btn btn-info mb-3"') ?>

                                <div class="table-responsive">
                                    <h4>Data Pelanggan</h4>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th class="text-center">Nama</th>
                                                <?php foreach ($pertanyaan as $row) : ?>
                                                    <th class="text-center"><?= $row->nama_pertanyaan ?></th>
                                                <?php endforeach; ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 0;
                                            foreach ($pelanggan as $row_pelanggan) : ?>
                                                <tr>
                                                    <td class="text-center"><?= ++$no ?></td>
                                                    <td><?= $row_pelanggan->nama_pelanggan ?></td>
                                                    <?php foreach ($pertanyaan as $row_pertanyaan) : ?>
                                                        <td class="text-center"><?= $nilai[$row_pelanggan->id_pelanggan][$row_pertanyaan->id_pertanyaan] ?></td>
                                                    <?php endforeach; ?>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>

                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4>Data Pertanyaan</h4>
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">No</th>
                                                        <th class="text-center">Kode</th>
                                                        <th class="text-center">Pertanyaan</th>
                                                        <th class="text-center">Prioritas</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $no = 0;
                                                    foreach ($pertanyaan as $row) : ?>
                                                        <tr>
                                                            <td class="text-center"><?= ++$no ?></td>
                                                            <td><?= $row->kode_pertanyaan ?></td>
                                                            <td><?= $row->nama_pertanyaan ?></td>
                                                            <td class="text-center"><?= $row->prioritas ?></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h4>Data Nilai</h4>
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">No</th>
                                                        <th class="text-center">Nama</th>
                                                        <th class="text-center">Prioritas</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $no = 0;
                                                    foreach ($data_nilai as $row) : ?>
                                                        <tr>
                                                            <td class="text-center"><?= ++$no ?></td>
                                                            <td><?= $row->nama_nilai ?></td>
                                                            <td class="text-center"><?= $row->prioritas ?></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <hr>
                                <div class="table-responsive">
                                    <h4>Hasil Prioritas</h4>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th class="text-center">Nama</th>
                                                <?php foreach ($pertanyaan as $row) : ?>
                                                    <th class="text-center"><?= $row->kode_pertanyaan ?></th>
                                                <?php endforeach; ?>
                                                <th class="text-center">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 0;
                                            foreach ($pelanggan as $row_pelanggan) :
                                                $total = 0;
                                            ?>
                                                <tr>
                                                    <td class="text-center"><?= ++$no ?></td>
                                                    <td><?= $row_pelanggan->nama_pelanggan ?></td>
                                                    <?php foreach ($pertanyaan as $row_pertanyaan) :
                                                        $total += $nilai_prioritas[$row_pelanggan->id_pelanggan][$row_pertanyaan->id_pertanyaan];
                                                    ?>
                                                        <td class="text-center"><?= $nilai_prioritas[$row_pelanggan->id_pelanggan][$row_pertanyaan->id_pertanyaan] ?></td>
                                                    <?php endforeach; ?>
                                                    <td class="text-center font-weight-bold"><?= $total ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>

                                <hr>
                                <div class="table-responsive">
                                    <h4>Hasil Metode AHP</h4>
                                    <table class="table table-bordered mt-2">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th class="text-center">Nama Pelanggan</th>
                                                <th class="text-center">Nilai AHP</th>
                                                <th class="text-center">Tingkat Kepuasan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 0;
                                            $total = 0;
                                            foreach ($hasil as $row) :
                                                $total += $row['tingkat_kepuasan'];
                                            ?>
                                                <tr>
                                                    <td class="text-center"><?= ++$no ?></td>
                                                    <td><?= $row['nama_pelanggan'] ?></td>
                                                    <td class="text-center"><?= $row['nilai_ahp'] ?></td>
                                                    <td class="text-center"><?= $row['tingkat_kepuasan'] ?>%</td>
                                                </tr>
                                            <?php endforeach; ?>
                                            <tr>
                                                <td colspan="3" class="text-center"><strong>Nilai Rata-Rata</strong></td>
                                                <td class="text-center font-weight-bold"><?= round($total / count($hasil), 0) ?>%</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        <?php $this->load->view('template/footer_text'); ?>
    </div>
</div>

<?php $this->load->view('template/js'); ?>
<?php $this->load->view('template/footer'); ?>