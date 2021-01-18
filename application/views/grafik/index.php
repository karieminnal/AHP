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
                                <h6 class="m-0 font-weight-bold text-primary">Grafik Tingkat Kepuasan Pelanggan</h6>
                            </div>
                            <div class="card-body">
                                <div class="grafik" style="height: 360px;"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        <?php $this->load->view('template/footer_text'); ?>
    </div>
</div>
<style>
    .ct-series-a .ct-bar {
        stroke: green;
    }
</style>

<?php $this->load->view('template/js'); ?>
<script src="<?= base_url('assets/vendor/chartist-js/dist/chartist.min.js') ?>"></script>
<script src="<?= base_url('assets/vendor/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js') ?>"></script>
<script>
    new Chartist.Bar('.grafik', {
        labels: [
            <?php foreach ($hasil as $row) : ?>
                <?= "'" . $row['nama_divisi'] . "<br>(" . $row['tingkat_kepuasan'] . "%)<br>" . $row['keterangan'] . "'" ?>,
            <?php endforeach; ?>
        ],
        series: [
            [
                <?php foreach ($hasil as $row) : ?>
                    <?= $row['tingkat_kepuasan'] ?>,
                <?php endforeach; ?>
            ]
        ]
    }, {
        seriesBarDistance: 10,
        reverseData: true,
        horizontalBars: true,
        axisY: {
            offset: 70
        }
    });
</script>
<?php $this->load->view('template/footer'); ?>