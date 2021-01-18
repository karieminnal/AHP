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
                                <h6 class="m-0 font-weight-bold text-primary">Prioritas Pertanyaan</h6>
                            </div>
                            <div class="card-body">

                                <?= form_open('pertanyaan/prioritas', 'class="mb-4"') ?>
                                <div class="form-group">
                                    <label>Divisi</label>
                                    <select name="id_divisi" class="form-control" required>
                                        <option value=""></option>
                                        <?php foreach ($divisi as $row) : ?>
                                            <option value="<?= $row->id_divisi ?>" <?= set_select('id_divisi', $row->id_divisi, $id_divisi == $row->id_divisi ? TRUE : FALSE) ?>><?= $row->nama_divisi ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <button type="submit" name="proses" class="btn btn-success">Proses</button>
                                <?= form_close() ?>

                                <?php if (!empty($pertanyaan)) : ?>
                                    <?= $this->session->flashdata('pesan_sukses') ?>
                                    <?= $this->session->flashdata('pesan_error') ?>
                                    <?= form_open('pertanyaan/prioritas/' . $id_divisi) ?>
                                    <div class="table-responsive mb-4">
                                        <table class="table-prioritas">
                                            <thead>
                                                <tr>
                                                    <th class="text-right" width="25%">Nama Pertanyaan</th>
                                                    <th class="text-center" width="50%">Skala Perbandingan</th>
                                                    <th class="text-left" width="25%">Nama Pertanyaan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 1;
                                                $i = 0;
                                                foreach ($pertanyaan as $row1) :
                                                    $ii = 0;
                                                    foreach ($pertanyaan as $row2) :
                                                        if ($i < $ii) :
                                                            $nilai = $pertanyaan_ahp[$row1->id_pertanyaan][$row2->id_pertanyaan];
                                                ?>
                                                            <tr>
                                                                <td class="text-right"><?= $row1->nama_pertanyaan ?></td>
                                                                <td class="text-center">
                                                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                                        <label class="btn btn-success <?= $nilai == -9 ? "active" : "" ?>"><input type="radio" id="radio_a_<?= $no ?>" name="nilai_<?= $row1->id_pertanyaan . '_' . $row2->id_pertanyaan ?>" value="-9" <?= $nilai == -9 ? "checked" : "" ?>>9</label>
                                                                        <label class="btn btn-success <?= $nilai == -8 ? "active" : "" ?>"><input type="radio" id="radio_b_<?= $no ?>" name="nilai_<?= $row1->id_pertanyaan . '_' . $row2->id_pertanyaan ?>" value="-8" <?= $nilai == -8 ? "checked" : "" ?>>8</label>
                                                                        <label class="btn btn-success <?= $nilai == -7 ? "active" : "" ?>"><input type="radio" id="radio_c_<?= $no ?>" name="nilai_<?= $row1->id_pertanyaan . '_' . $row2->id_pertanyaan ?>" value="-7" <?= $nilai == -7 ? "checked" : "" ?>>7</label>
                                                                        <label class="btn btn-success <?= $nilai == -6 ? "active" : "" ?>"><input type="radio" id="radio_d_<?= $no ?>" name="nilai_<?= $row1->id_pertanyaan . '_' . $row2->id_pertanyaan ?>" value="-6" <?= $nilai == -6 ? "checked" : "" ?>>6</label>
                                                                        <label class="btn btn-success <?= $nilai == -5 ? "active" : "" ?>"><input type="radio" id="radio_e_<?= $no ?>" name="nilai_<?= $row1->id_pertanyaan . '_' . $row2->id_pertanyaan ?>" value="-5" <?= $nilai == -5 ? "checked" : "" ?>>5</label>
                                                                        <label class="btn btn-success <?= $nilai == -4 ? "active" : "" ?>"><input type="radio" id="radio_f_<?= $no ?>" name="nilai_<?= $row1->id_pertanyaan . '_' . $row2->id_pertanyaan ?>" value="-4" <?= $nilai == -4 ? "checked" : "" ?>>4</label>
                                                                        <label class="btn btn-success <?= $nilai == -3 ? "active" : "" ?>"><input type="radio" id="radio_g_<?= $no ?>" name="nilai_<?= $row1->id_pertanyaan . '_' . $row2->id_pertanyaan ?>" value="-3" <?= $nilai == -3 ? "checked" : "" ?>>3</label>
                                                                        <label class="btn btn-success <?= $nilai == -2 ? "active" : "" ?>"><input type="radio" id="radio_h_<?= $no ?>" name="nilai_<?= $row1->id_pertanyaan . '_' . $row2->id_pertanyaan ?>" value="-2" <?= $nilai == -2 ? "checked" : "" ?>>2</label>
                                                                        <label class="btn btn-success <?= $nilai == 1 ? "active" : "" ?>"><input type="radio" id="radio_i_<?= $no ?>" name="nilai_<?= $row1->id_pertanyaan . '_' . $row2->id_pertanyaan ?>" value="1" <?= $nilai == 1 ? "checked" : "" ?>>1</label>
                                                                        <label class="btn btn-success <?= $nilai == 2 ? "active" : "" ?>"><input type="radio" id="radio_j_<?= $no ?>" name="nilai_<?= $row1->id_pertanyaan . '_' . $row2->id_pertanyaan ?>" value="2" <?= $nilai == 2 ? "checked" : "" ?>>2</label>
                                                                        <label class="btn btn-success <?= $nilai == 3 ? "active" : "" ?>"><input type="radio" id="radio_k_<?= $no ?>" name="nilai_<?= $row1->id_pertanyaan . '_' . $row2->id_pertanyaan ?>" value="3" <?= $nilai == 3 ? "checked" : "" ?>>3</label>
                                                                        <label class="btn btn-success <?= $nilai == 4 ? "active" : "" ?>"><input type="radio" id="radio_l_<?= $no ?>" name="nilai_<?= $row1->id_pertanyaan . '_' . $row2->id_pertanyaan ?>" value="4" <?= $nilai == 4 ? "checked" : "" ?>>4</label>
                                                                        <label class="btn btn-success <?= $nilai == 5 ? "active" : "" ?>"><input type="radio" id="radio_m_<?= $no ?>" name="nilai_<?= $row1->id_pertanyaan . '_' . $row2->id_pertanyaan ?>" value="5" <?= $nilai == 5 ? "checked" : "" ?>>5</label>
                                                                        <label class="btn btn-success <?= $nilai == 6 ? "active" : "" ?>"><input type="radio" id="radio_n_<?= $no ?>" name="nilai_<?= $row1->id_pertanyaan . '_' . $row2->id_pertanyaan ?>" value="6" <?= $nilai == 6 ? "checked" : "" ?>>6</label>
                                                                        <label class="btn btn-success <?= $nilai == 7 ? "active" : "" ?>"><input type="radio" id="radio_o_<?= $no ?>" name="nilai_<?= $row1->id_pertanyaan . '_' . $row2->id_pertanyaan ?>" value="7" <?= $nilai == 7 ? "checked" : "" ?>>7</label>
                                                                        <label class="btn btn-success <?= $nilai == 8 ? "active" : "" ?>"><input type="radio" id="radio_p_<?= $no ?>" name="nilai_<?= $row1->id_pertanyaan . '_' . $row2->id_pertanyaan ?>" value="8" <?= $nilai == 8 ? "checked" : "" ?>>8</label>
                                                                        <label class="btn btn-success <?= $nilai == 9 ? "active" : "" ?>"><input type="radio" id="radio_q_<?= $no ?>" name="nilai_<?= $row1->id_pertanyaan . '_' . $row2->id_pertanyaan ?>" value="9" <?= $nilai == 9 ? "checked" : "" ?>>9</label>
                                                                    </div>
                                                                </td>
                                                                <td class="text-left"><?= $row2->nama_pertanyaan ?></td>
                                                            </tr>
                                                <?php
                                                            $no++;
                                                        endif;
                                                        $ii++;
                                                    endforeach;
                                                    $i++;
                                                endforeach;
                                                ?>
                                                <tr>
                                                    <td class="text-center" colspan="3">
                                                        <button type="submit" name="save" class="btn btn-primary">Simpan</button>
                                                        <button type="submit" name="check" class="btn btn-warning">Cek Konsistensi</button>
                                                        <a href="#" data-href="<?= site_url('pertanyaan/reset/' . $id_divisi) ?>" data-toggle="modal" data-target="#confirm-reset" class="btn btn-danger">Reset</a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <?= form_close() ?>
                                <?php else : ?>
                                    <?php if (!empty($id_divisi)) : ?>
                                        <div class="alert alert-warning" role="alert">Jumlah pertanyaan kurang, minimal harus ada 3 pertanyaan</div>
                                    <?php endif; ?>
                                <?php endif; ?>

                                <?php if (isset($_POST['check']) and empty($this->session->flashdata('pesan_error'))) : ?>
                                    <h2 class="mt-4">Langkah Perhitungan</h2>
                                    <h3>Matriks Perbandingan Berpasangan</h3>
                                    <div class="table-responsive">
                                        <table class="table-prioritas">
                                            <?= $list_data ?>
                                        </table>
                                    </div>
                                    <h3 class="mt-4">Matriks Nilai Pertanyaan (Normalisasi)</h3>
                                    <div class="table-responsive">
                                        <table class="table-prioritas">
                                            <?= $list_data2 ?>
                                        </table>
                                    </div>
                                    <h3 class="mt-4">Matriks Penjumlahan Setiap Baris</h3>
                                    <div class="table-responsive">
                                        <table class="table-prioritas">
                                            <?= $list_data3 ?>
                                        </table>
                                    </div>
                                    <h3 class="mt-4">Perhitungan Rasio Konsistensi</h3>
                                    <div class="table-responsive">
                                        <table class="table-prioritas">
                                            <?= $list_data4 ?>
                                        </table>
                                        <?= $list_data5 ?>
                                    </div>
                                <?php endif; ?>
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
<script>
    $(document).ready(function() {
        $('#confirm-reset').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
        });
    });
</script>
<div class="modal fade" id="confirm-reset" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Konfirmasi</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <p>Anda yakin akan mengatur ulang semua nilai perbandingan ini ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <a class="btn btn-danger btn-ok">Reset</a>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('template/footer'); ?>