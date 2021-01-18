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
                                <h6 class="m-0 font-weight-bold text-primary">Pilih Divisi</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Divisi</th>
                                                <th width="25%">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 0;
                                            foreach ($divisi as $row) : ?>
                                                <tr>
                                                    <td><?= ++$no ?></td>
                                                    <td><?= $row->nama_divisi ?></td>
                                                    <td>
                                                        <?php if (!empty($pertanyaan[$row->id_divisi])) : ?>
                                                            <?php if (empty($pelanggan_pertanyaan[$row->id_divisi])) : ?>
                                                                <a href="<?= site_url('survey/divisi/' . $row->id_divisi) ?>" class="btn btn-success btn-sm">Survey</a>
                                                            <?php else : ?>
                                                                <a href="<?= site_url('survey/lihat/' . $row->id_divisi) ?>" class="btn btn-info btn-sm">Lihat</a>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
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