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
                                <h6 class="m-0 font-weight-bold text-primary">Prioritas Nilai</h6>
                            </div>
                            <div class="card-body">
                                <?php if (!empty($nilai)) : ?>
                                    <?= $this->session->flashdata('pesan_sukses') ?>
                                    <?= $this->session->flashdata('pesan_error') ?>
                                    <?= form_open('nilai/prioritas') ?>
                                    <div class="table-responsive mb-4">
                                        <table class="table-prioritas">
                                            <thead>
                                                <tr>
                                                    <th class="text-center" width="25%">Nama Nilai</th>
                                                    <th class="text-center" width="50%">Skala Perbandingan</th>
                                                    <th class="text-center" width="25%">Nama Nilai</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 1;
                                                $i = 0;
                                                foreach ($nilai as $row1) :
                                                    $ii = 0;
                                                    foreach ($nilai as $row2) :
                                                        if ($i < $ii) :
                                                            $pilihan_nilai = $nilai_ahp[$row1->id_nilai][$row2->id_nilai];
                                                ?>
                                                            <tr>
                                                                <td class="text-center"><?= $row1->nama_nilai ?></td>
                                                                <td class="text-center">
                                                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                                        <label class="btn btn-success <?= $pilihan_nilai == -9 ? "active" : "" ?>"><input type="radio" id="radio_a_<?= $no ?>" name="nilai_<?= $row1->id_nilai . '_' . $row2->id_nilai ?>" value="-9" <?= $pilihan_nilai == -9 ? "checked" : "" ?>>9</label>
                                                                        <label class="btn btn-success <?= $pilihan_nilai == -8 ? "active" : "" ?>"><input type="radio" id="radio_b_<?= $no ?>" name="nilai_<?= $row1->id_nilai . '_' . $row2->id_nilai ?>" value="-8" <?= $pilihan_nilai == -8 ? "checked" : "" ?>>8</label>
                                                                        <label class="btn btn-success <?= $pilihan_nilai == -7 ? "active" : "" ?>"><input type="radio" id="radio_c_<?= $no ?>" name="nilai_<?= $row1->id_nilai . '_' . $row2->id_nilai ?>" value="-7" <?= $pilihan_nilai == -7 ? "checked" : "" ?>>7</label>
                                                                        <label class="btn btn-success <?= $pilihan_nilai == -6 ? "active" : "" ?>"><input type="radio" id="radio_d_<?= $no ?>" name="nilai_<?= $row1->id_nilai . '_' . $row2->id_nilai ?>" value="-6" <?= $pilihan_nilai == -6 ? "checked" : "" ?>>6</label>
                                                                        <label class="btn btn-success <?= $pilihan_nilai == -5 ? "active" : "" ?>"><input type="radio" id="radio_e_<?= $no ?>" name="nilai_<?= $row1->id_nilai . '_' . $row2->id_nilai ?>" value="-5" <?= $pilihan_nilai == -5 ? "checked" : "" ?>>5</label>
                                                                        <label class="btn btn-success <?= $pilihan_nilai == -4 ? "active" : "" ?>"><input type="radio" id="radio_f_<?= $no ?>" name="nilai_<?= $row1->id_nilai . '_' . $row2->id_nilai ?>" value="-4" <?= $pilihan_nilai == -4 ? "checked" : "" ?>>4</label>
                                                                        <label class="btn btn-success <?= $pilihan_nilai == -3 ? "active" : "" ?>"><input type="radio" id="radio_g_<?= $no ?>" name="nilai_<?= $row1->id_nilai . '_' . $row2->id_nilai ?>" value="-3" <?= $pilihan_nilai == -3 ? "checked" : "" ?>>3</label>
                                                                        <label class="btn btn-success <?= $pilihan_nilai == -2 ? "active" : "" ?>"><input type="radio" id="radio_h_<?= $no ?>" name="nilai_<?= $row1->id_nilai . '_' . $row2->id_nilai ?>" value="-2" <?= $pilihan_nilai == -2 ? "checked" : "" ?>>2</label>
                                                                        <label class="btn btn-success <?= $pilihan_nilai == 1 ? "active" : "" ?>"><input type="radio" id="radio_i_<?= $no ?>" name="nilai_<?= $row1->id_nilai . '_' . $row2->id_nilai ?>" value="1" <?= $pilihan_nilai == 1 ? "checked" : "" ?>>1</label>
                                                                        <label class="btn btn-success <?= $pilihan_nilai == 2 ? "active" : "" ?>"><input type="radio" id="radio_j_<?= $no ?>" name="nilai_<?= $row1->id_nilai . '_' . $row2->id_nilai ?>" value="2" <?= $pilihan_nilai == 2 ? "checked" : "" ?>>2</label>
                                                                        <label class="btn btn-success <?= $pilihan_nilai == 3 ? "active" : "" ?>"><input type="radio" id="radio_k_<?= $no ?>" name="nilai_<?= $row1->id_nilai . '_' . $row2->id_nilai ?>" value="3" <?= $pilihan_nilai == 3 ? "checked" : "" ?>>3</label>
                                                                        <label class="btn btn-success <?= $pilihan_nilai == 4 ? "active" : "" ?>"><input type="radio" id="radio_l_<?= $no ?>" name="nilai_<?= $row1->id_nilai . '_' . $row2->id_nilai ?>" value="4" <?= $pilihan_nilai == 4 ? "checked" : "" ?>>4</label>
                                                                        <label class="btn btn-success <?= $pilihan_nilai == 5 ? "active" : "" ?>"><input type="radio" id="radio_m_<?= $no ?>" name="nilai_<?= $row1->id_nilai . '_' . $row2->id_nilai ?>" value="5" <?= $pilihan_nilai == 5 ? "checked" : "" ?>>5</label>
                                                                        <label class="btn btn-success <?= $pilihan_nilai == 6 ? "active" : "" ?>"><input type="radio" id="radio_n_<?= $no ?>" name="nilai_<?= $row1->id_nilai . '_' . $row2->id_nilai ?>" value="6" <?= $pilihan_nilai == 6 ? "checked" : "" ?>>6</label>
                                                                        <label class="btn btn-success <?= $pilihan_nilai == 7 ? "active" : "" ?>"><input type="radio" id="radio_o_<?= $no ?>" name="nilai_<?= $row1->id_nilai . '_' . $row2->id_nilai ?>" value="7" <?= $pilihan_nilai == 7 ? "checked" : "" ?>>7</label>
                                                                        <label class="btn btn-success <?= $pilihan_nilai == 8 ? "active" : "" ?>"><input type="radio" id="radio_p_<?= $no ?>" name="nilai_<?= $row1->id_nilai . '_' . $row2->id_nilai ?>" value="8" <?= $pilihan_nilai == 8 ? "checked" : "" ?>>8</label>
                                                                        <label class="btn btn-success <?= $pilihan_nilai == 9 ? "active" : "" ?>"><input type="radio" id="radio_q_<?= $no ?>" name="nilai_<?= $row1->id_nilai . '_' . $row2->id_nilai ?>" value="9" <?= $pilihan_nilai == 9 ? "checked" : "" ?>>9</label>
                                                                    </div>
                                                                </td>
                                                                <td class="text-center"><?= $row2->nama_nilai ?></td>
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
                                                        <a href="#" data-href="<?= site_url('nilai/reset') ?>" data-toggle="modal" data-target="#confirm-reset" class="btn btn-danger">Reset</a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <?= form_close() ?>
                                <?php else : ?>
                                    <div class="alert alert-warning" role="alert">Tidak ada data nilai</div>
                                <?php endif; ?>

                                <?php if (isset($_POST['check']) and empty($this->session->flashdata('pesan_error'))) : ?>
                                    <h2 class="mt-4">Langkah Perhitungan</h2>
                                    <h3>Matriks Perbandingan Berpasangan</h3>
                                    <div class="table-responsive">
                                        <table class="table-prioritas">
                                            <?= $list_data ?>
                                        </table>
                                    </div>
                                    <h3 class="mt-4">Matriks Nilai (Normalisasi)</h3>
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