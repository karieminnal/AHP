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
                                <h6 class="m-0 font-weight-bold text-primary">Survey Kepuasan Pelanggan Divisi <?= $divisi->nama_divisi ?></h6>
                            </div>
                            <div class="card-body">
                                <?= form_open('survey/divisi/' . $divisi->id_divisi) ?>
                                <?php foreach ($pertanyaan as $row) : ?>
                                    <div class="form-group">
                                        <label><?= $row->nama_pertanyaan ?></label>
                                        <?php
                                        $no = 0;
                                        foreach ($nilai as $row_sub) : ?>
                                            <div class="form-check ml-4">
                                                <input class="form-check-input" type="radio" name="pertanyaan<?= $row->id_pertanyaan ?>" id="pertanyaan<?= ++$no . $row->id_pertanyaan ?>" value="<?= $row_sub->id_nilai ?>" <?= set_radio('pertanyaan' . $row->id_pertanyaan, $row_sub->id_nilai) ?>>
                                                <label class="form-check-label" for="pertanyaan<?= $no . $row->id_pertanyaan ?>"><?= $row_sub->nama_nilai ?></label>
                                            </div>
                                        <?php endforeach; ?>
                                        <small class="form-text text-danger"><?= form_error('pertanyaan' . $row->id_pertanyaan) ?></small>
                                    </div>
                                <?php endforeach; ?>
                                <button type="submit" name="simpan" class="btn btn-primary">Kirim</button>
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