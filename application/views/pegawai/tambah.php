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
                                <h6 class="m-0 font-weight-bold text-primary">Tambah Data Pegawai</h6>
                            </div>
                            <div class="card-body">
                                <?= $this->session->flashdata('pesan') ?>
                                <?= form_open('pegawai/tambah') ?>
                                <div class="form-group">
                                    <label>No Induk</label>
                                    <input type="text" name="no_induk" class="form-control" value="<?= set_value('no_induk') ?>">
                                    <small class="form-text text-danger"><?= form_error('no_induk') ?></small>
                                </div>
                                <div class="form-group">
                                    <label>Nama Pegawai</label>
                                    <input type="text" name="nama_pegawai" class="form-control" value="<?= set_value('nama_pegawai') ?>">
                                    <small class="form-text text-danger"><?= form_error('nama_pegawai') ?></small>
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <input type="text" name="alamat" class="form-control" value="<?= set_value('alamat') ?>">
                                    <small class="form-text text-danger"><?= form_error('alamat') ?></small>
                                </div>
                                <div class="form-group">
                                    <label>No HP</label>
                                    <input type="text" name="no_hp" class="form-control" value="<?= set_value('no_hp') ?>">
                                    <small class="form-text text-danger"><?= form_error('no_hp') ?></small>
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
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" name="username" class="form-control" value="<?= set_value('username') ?>">
                                    <small class="form-text text-danger"><?= form_error('username') ?></small>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="text" name="password" class="form-control" value="<?= set_value('password') ?>">
                                    <small class="form-text text-danger"><?= form_error('password') ?></small>
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