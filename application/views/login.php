<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Login - Sistem Pendukung Keputusan Penilaian Tingkat Kepuasan Pelanggan</title>

    <link href="<?= base_url() ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <link href="<?= base_url() ?>assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/css/custom.css" rel="stylesheet">

    <link rel="shortcut icon" href="<?= base_url('assets/images/icon.png') ?>" type="image/x-icon">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-md-6">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="imgwrapper mt-2">
                                    <img src="<?= base_url('assets/images/header.png') ?>" alt="header">
                                </div>
                                <div class="px-5 mt-4">
                                    <?= form_open('login/cek', 'class="user"') ?>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" name="username" placeholder="Masukkan username" value="<?= set_value('username') ?>">
                                        <div class="text-danger"><?= form_error('username') ?></div>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" name="password" placeholder="Masukkan password" value="<?= set_value('password') ?>">
                                        <div class="text-danger"><?= form_error('password') ?></div>
                                    </div>
                                    <button type="submit" name="login" class="btn btn-primary btn-user btn-block mb-4">Login</button>
                                    <?= form_close() ?>
                                    <div class="text-center"><?= $this->session->flashdata('pesan') ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url() ?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url() ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url() ?>assets/js/sb-admin-2.min.js"></script>

</body>

</html>