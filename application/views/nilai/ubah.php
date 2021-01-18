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
                                <h6 class="m-0 font-weight-bold text-primary">Ubah Data Nilai</h6>
                            </div>
                            <div class="card-body">
                                <?= $this->session->flashdata('pesan') ?>
                                <?= form_open('nilai/ubah/' . $nilai->id_nilai) ?>
                                <?= form_hidden('nama_nilai_awal', $nilai->nama_nilai) ?>
                                <div class="form-group">
                                    <label>Rentang Nilai</label>
                                    <div class="input-group">
                                        <input type="text" name="batas_1" placeholder="Nilai batas 1" class="form-control" value="<?= set_value('batas_1', $nilai->batas_1) ?>">
                                        <input type="text" name="batas_2" placeholder="Nilai batas 2" class="form-control" value="<?= set_value('batas_2', $nilai->batas_2) ?>">
                                    </div>
                                    <small class="form-text text-danger"><?= form_error('batas_1') ?></small>
                                    <small class="form-text text-danger"><?= form_error('batas_2') ?></small>
                                </div>
                                <div class="form-group">
                                    <label>Nama Nilai</label>
                                    <input type="text" name="nama_nilai" class="form-control" value="<?= set_value('nama_nilai', $nilai->nama_nilai) ?>">
                                    <small class="form-text text-danger"><?= form_error('nama_nilai') ?></small>
                                </div>
                                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                                <a href="<?= site_url('nilai') ?>" class="btn btn-secondary">Kembali</a>
                                <?= form_close() ?>
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