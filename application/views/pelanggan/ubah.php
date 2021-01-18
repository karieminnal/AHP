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
                                <h6 class="m-0 font-weight-bold text-primary">Ubah Data Pelanggan</h6>
                            </div>
                            <div class="card-body">
                                <?= $this->session->flashdata('pesan') ?>
                                <?= form_open('pelanggan/ubah/' . $pelanggan->id_pelanggan) ?>
                                <?= form_hidden('username_awal', $pelanggan->username) ?>
                                <div class="form-group">
                                    <label>Nama Pelanggan</label>
                                    <input type="text" name="nama_pelanggan" class="form-control" value="<?= set_value('nama_pelanggan', $pelanggan->nama_pelanggan) ?>">
                                    <small class="form-text text-danger"><?= form_error('nama_pelanggan') ?></small>
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <input type="text" name="alamat" class="form-control" value="<?= set_value('alamat', $pelanggan->alamat) ?>">
                                    <small class="form-text text-danger"><?= form_error('alamat') ?></small>
                                </div>
                                <div class="form-group">
                                    <label>No HP</label>
                                    <input type="text" name="no_hp" class="form-control" value="<?= set_value('no_hp', $pelanggan->no_hp) ?>">
                                    <small class="form-text text-danger"><?= form_error('no_hp') ?></small>
                                </div>
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" name="username" class="form-control" value="<?= set_value('username', $pelanggan->username) ?>">
                                    <small class="form-text text-danger"><?= form_error('username') ?></small>
                                </div>
                                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                                <a href="<?= site_url('pelanggan') ?>" class="btn btn-secondary">Kembali</a>
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