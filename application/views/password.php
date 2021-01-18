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
                                <h6 class="m-0 font-weight-bold text-primary">Ubah Password</h6>
                            </div>
                            <div class="card-body">
                                <?= $this->session->flashdata('pesan') ?>
                                <?= form_open('password') ?>
                                <div class="form-group">
                                    <label>Password Lama</label>
                                    <input type="text" name="password" class="form-control" value="<?= set_value('password') ?>">
                                    <small class="form-text text-danger"><?= form_error('password') ?></small>
                                </div>
                                <div class="form-group">
                                    <label>Password Baru</label>
                                    <input type="text" name="password_baru" class="form-control" value="<?= set_value('password_baru') ?>">
                                    <small class="form-text text-danger"><?= form_error('password_baru') ?></small>
                                </div>
                                <div class="form-group">
                                    <label>Ulangi Password Baru</label>
                                    <input type="text" name="ulangi" class="form-control" value="<?= set_value('ulangi') ?>">
                                    <small class="form-text text-danger"><?= form_error('ulangi') ?></small>
                                </div>
                                <button type="submit" name="simpan" class="btn btn-primary">Ubah</button>
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