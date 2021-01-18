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
                                <h6 class="m-0 font-weight-bold text-primary">Hasil Survey Tingkat Kepuasan Pelanggan</h6>
                            </div>
                            <div class="card-body">
                                <?= anchor('hasil/cetak', 'Cetak PDF', 'class="btn btn-info mb-3" target="_blank"') ?>
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Divisi</th>
                                                <th>Tingkat Kepuasan</th>
                                                <th>Keterangan</th>
                                                <th>Jumlah Pelanggan yang Melakukan Survey</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($hasil as $row) : ?>
                                                <tr>
                                                    <td></td>
                                                    <td><?= $row['nama_divisi'] ?></td>
                                                    <td><?= $row['tingkat_kepuasan'] ?>%</td>
                                                    <td><?= $row['keterangan'] ?></td>
                                                    <td><?= $row['jumlah_pelanggan'] ?> orang</td>
                                                    <td>
                                                        <a href="<?= site_url('hasil/detail/' . $row['id_divisi']) ?>" class="btn btn-success btn-sm">Detail</a>
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
<script src="<?= base_url() ?>assets/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        var t = $('#dataTable').DataTable({
            "columnDefs": [{
                "searchable": false,
                "orderable": false,
                "targets": 0
            }],
            "responsive": true,
            "bLengthChange": true,
            "bInfo": true,
            "oLanguage": {
                "sSearch": "Cari : ",
                "sLengthMenu": "_MENU_ &nbsp;&nbsp;data per halaman",
                "sInfo": "Menampilkan _START_ s/d _END_ dari <b>_TOTAL_ data</b>",
                "sInfoEmpty": "",
                "sInfoFiltered": "(difilter dari _MAX_ total data)",
                "sZeroRecords": "Pencarian tidak ditemukan",
                "sEmptyTable": "Tidak ada data"
            }
        });

        t.on('order.dt search.dt', function() {
            t.column(0, {
                search: 'applied',
                order: 'applied'
            }).nodes().each(function(cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();

    });
</script>
<?php $this->load->view('template/footer'); ?>