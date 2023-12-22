<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="<?= csrf_hash() ?>">

    <title>Login</title>

    <!-- Custom fonts for this template-->

    <link href="<?php echo base_url('assets/vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet"
        type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Custom styles for this template-->
    <link href="<?php echo base_url('assets/css/sb-admin-2.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/vendor/datatables/dataTables.bootstrap4.min.css') ?>" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css') ?>">

    <!-- CSS Table -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

</head>

<body class="bg-monas d-flex align-items-center justify-content-center">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-10 bg-gradient-primary">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="mt-3 login">
                                    <div class="text-center ">
                                        <div class="text-white text-center">
                                            <h2>Masuk Aplikasi</h2>
                                            <p class="h6 font-weight-normal">
                                                <span>Layanan Pemotongan Pajak PPH 21</span>
                                                <br>
                                                <span>Lembaga Layanan Pendidikan Tinggi Wilayah III
                                                    Jakarta</span>
                                            </p>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="p-3 login">
                                        <?= view('Myth\Auth\Views\_message_block') ?>
                                        <form action="<?= url_to('login') ?>" method="post">
                                            <?= csrf_field() ?>

                                            <?php if ($config->validFields === ['email']) : ?>
                                            <div class="form-group">
                                                <label for="login"><?= lang('Auth.email') ?></label>
                                                <input type="email"
                                                    class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>"
                                                    name="login" placeholder="<?= lang('Auth.email') ?>">
                                                <div class="invalid-feedback">
                                                    <?= session('errors.login') ?>
                                                </div>
                                            </div>

                                            <?php else : ?>
                                            <div class="form-group">
                                                <label for="login" class="text-white">Perguruan Tinggi : </label>
                                                <input type="text"
                                                    class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>"
                                                    name="login" placeholder="Nama Pengguna">
                                                <div class="invalid-feedback">
                                                    <?= session('errors.login') ?>
                                                </div>
                                            </div>
                                            <?php endif; ?>

                                            <div class="form-group">
                                                <label for="password"
                                                    class="text-white"><?= lang('Auth.password') ?></label>
                                                <div class="input-group-append">
                                                    <input type="password" name="password" id="password"
                                                        class="form-control  <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>"
                                                        placeholder="<?= lang('Auth.password') ?>">
                                                    <span class="input-group-text"><i class="fas fa-eye-slash"
                                                            style="cursor: pointer;" id="mataPassword"></i></span>
                                                </div>
                                                <div class="invalid-feedback">
                                                    <?= session('errors.password') ?>
                                                </div>
                                                <!-- <i class="fa fa-eye-slash" id="password-eye" style="cursor: pointer;"></i> -->
                                            </div>


                                            <?php if ($config->allowRemembering) : ?>
                                            <div class="form-check">
                                                <label class="form-check-label text-white">
                                                    <input type="checkbox" name="remember" class="form-check-input"
                                                        <?php if (old('remember')) : ?> checked <?php endif ?>>
                                                    <?= lang('Auth.rememberMe') ?>
                                                </label>
                                            </div>
                                            <?php endif; ?>

                                            <br>

                                            <button type="submit" id="loginBtn"
                                                class="btn btn-primary btn-block"><?= lang('Auth.loginAction') ?></button>
                                        </form>
                                        <hr>
                                        <?php if ($config->allowRegistration) : ?>
                                        <p><a href="<?= url_to('register') ?>"
                                                class="text-white"><?= lang('Auth.needAnAccount') ?></a></p>
                                        <?php endif; ?>
                                        <?php if ($config->activeResetter) : ?>
                                        <p><a href="<?= url_to('forgot') ?>"
                                                class="text-white"><?= lang('Auth.forgotYourPassword') ?></a></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>



    </div>
    <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->

    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha512-bnIvzh6FU75ZKxp0GXLH9bewza/OIw6dLVh9ICg0gogclmYGguQJWl8U30WpbsGTqbIiAwxTsbe76DErLq5EDQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->

    <script src="<?php echo base_url('assets/js/cdnjs.cloudflare.com_ajax_libs_jquery_3.4.1_jquery.min.js') ?>">
    </script>
    <script src="<?php echo base_url('assets/vendor/jquery/jquery.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>


    <!-- Core plugin JavaScript-->
    <script src="<?php echo base_url('assets/vendor/jquery-easing/jquery.easing.min.js') ?>"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?php echo base_url('assets/js/sb-admin-2.min.js') ?>"></script>

    <!-- Custom My Js-->
    <script src="<?php echo base_url('assets/js/script.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/main.js') ?>"></script>

    <!-- Page level plugins -->
    <script src="<?php echo base_url('assets/vendor/chart.js/Chart.min.js') ?>"></script>

    <!-- Page level custom scripts -->
    <script src="<?php echo base_url('assets/js/demo/chart-area-demo.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/demo/chart-pie-demo.js') ?>"></script>

    <!-- Page level plugins -->
    <script src="<?php echo base_url('assets/vendor/datatables/jquery.dataTables.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/vendor/datatables/dataTables.bootstrap4.min.js') ?>"></script>

    <!-- Page level custom scripts -->
    <script src="<?php echo base_url('assets/js/demo/datatables-demo.js') ?>"></script>


    <!-- Page level plugins -->
    <script src="<?php echo base_url('assets/vendor/datatables/jquery.dataTables.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/vendor/datatables/dataTables.bootstrap4.min.js') ?>"></script>


    <!-- Page level custom scripts -->
    <script src="<?php echo base_url('assets/js/demo/datatables-demo.js') ?>"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

    <!-- JS Table -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script>
    $(document).ready(function() {
        $('search_select_box select').selectpicker();
    });

    // ========== PASSWORD DAN MATA PASSWORD UNTUK HALAMAN LOGIN ==========
    // Dapatkan elemen input dan ikon mata
    var password = document.getElementById("password");
    var mataPassword = document.getElementById("mataPassword");

    // Tambahkan event listener untuk mengubah jenis input saat ikon mata diklik
    mataPassword.addEventListener("click", function() {
        console.log("Icon Clicked");
        if (password.type === "password") {
            password.type = "text";
            mataPassword.classList.remove("fa-eye-slash");
            mataPassword.classList.add("fa-eye");
        } else {
            password.type = "password";
            mataPassword.classList.remove("fa-eye");
            mataPassword.classList.add("fa-eye-slash");
        }
    });
    </script>

</body>

</html>