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
                                <h6 class="m-0 font-weight-bold text-primary">Ubah Data Pegawai</h6>
                            </div>
                            <div class="card-body">
                                <?= $this->session->flashdata('pesan') ?>
                                <?= form_open('pegawai/ubah/' . $pegawai->id_pegawai) ?>
                                <?= form_hidden('no_induk_awal', $pegawai->no_induk) ?>
                                <?= form_hidden('username_awal', $pegawai->username) ?>
                                <div class="form-group">
                                    <label>No Induk</label>
                                    <input type="text" name="no_induk" class="form-control" value="<?= set_value('no_induk', $pegawai->no_induk) ?>">
                                    <small class="form-text text-danger"><?= form_error('no_induk') ?></small>
                                </div>
                                <div class="form-group">
                                    <label>Nama Pegawai</label>
                                    <input type="text" name="nama_pegawai" class="form-control" value="<?= set_value('nama_pegawai', $pegawai->nama_pegawai) ?>">
                                    <small class="form-text text-danger"><?= form_error('nama_pegawai') ?></small>
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <input type="text" name="alamat" class="form-control" value="<?= set_value('alamat', $pegawai->alamat) ?>">
                                    <small class="form-text text-danger"><?= form_error('alamat') ?></small>
                                </div>
                                <div class="form-group">
                                    <label>No HP</label>
                                    <input type="text" name="no_hp" class="form-control" value="<?= set_value('no_hp', $pegawai->no_hp) ?>">
                                    <small class="form-text text-danger"><?= form_error('no_hp') ?></small>
                                </div>
                                <div class="form-group">
                                    <label>Divisi</label>
                                    <select name="id_divisi" class="form-control">
                                        <?php foreach ($divisi as $row) : ?>
                                            <option value="<?= $row->id_divisi ?>" <?= set_select('id_divisi', $row->id_divisi, $pegawai->id_divisi == $row->id_divisi ? TRUE : FALSE) ?>><?= $row->nama_divisi ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <small class="form-text text-danger"><?= form_error('id_divisi') ?></small>
                                </div>
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" name="username" class="form-control" value="<?= set_value('username', $pegawai->username) ?>">
                                    <small class="form-text text-danger"><?= form_error('username') ?></small>
                                </div>
                                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                                <a href="<?= site_url('pegawai') ?>" class="btn btn-secondary">Kembali</a>
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