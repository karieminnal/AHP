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
                                <h6 class="m-0 font-weight-bold text-primary">Tambah Data Pertanyaan</h6>
                            </div>
                            <div class="card-body">
                                <?= $this->session->flashdata('pesan') ?>
                                <?= form_open('pertanyaan/tambah') ?>
                                <div class="form-group">
                                    <label>Kode Pertanyaan</label>
                                    <input type="text" name="kode_pertanyaan" class="form-control" readonly value="<?= set_value('kode_pertanyaan', $kode_pertanyaan) ?>">
                                    <small class="form-text text-danger"><?= form_error('kode_pertanyaan') ?></small>
                                </div>
                                <div class="form-group">
                                    <label>Nama Pertanyaan</label>
                                    <input type="text" name="nama_pertanyaan" class="form-control" value="<?= set_value('nama_pertanyaan') ?>">
                                    <small class="form-text text-danger"><?= form_error('nama_pertanyaan') ?></small>
                                </div>
                                <div class="form-group">
                                    <label>Divisi</label>
                                    <select name="id_divisi" class="form-control">
                                        <option value=""></option>
                                        <?php foreach ($divisi as $row) : ?>
                                            <option value="<?= $row->id_divisi ?>" <?= set_select('id_divisi', $row->id_divisi) ?>><?= $row->nama_divisi ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <small class="form-text text-danger"><?= form_error('id_divisi') ?></small>
                                </div>
                                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
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