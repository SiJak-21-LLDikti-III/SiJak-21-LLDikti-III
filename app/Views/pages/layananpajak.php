<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= $title ?></title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?= base_url('skydash-template/vendors/feather/feather.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('skydash-template/vendors/ti-icons/css/themify-icons.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('skydash-template/vendors/css/vendor.bundle.base.css'); ?>">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="<?= base_url('skydash-template/vendors/datatables.net-bs4/dataTables.bootstrap4.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('skydash-template/vendors/ti-icons/css/themify-icons.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('skydash-template/js/select.dataTables.min.css'); ?>">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="<?= base_url('skydash-template/css/vertical-layout-light/style.css'); ?>">
    <!-- endinject -->
    <link rel="shortcut icon" href="<?= base_url('skydash-template/images/favicon.png'); ?>" />

    <!-- Data Table -->
    <link href="<?= base_url('skydash-template/vendors/datatables/dataTables.bootstrap4.min.css'); ?>" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">

    <link rel="stylesheet" href="<?= base_url('skydash-template/css/style.css'); ?>">
</head>

<body>
    <!-- Navbar White -->
    <nav class="navbar navbar-light bg-light">
        <div class="mx-auto">
            <a class="navbar-brand" href="<?= base_url(); ?>">
                <img src="<?= base_url('skydash-template/images/LogoDikbud.svg'); ?>" width="30" height="30" class="d-inline-block align-top mr-3" alt="">
                <span class="font-weight-bold">DASHBOARD LLDIKTI III</span>
            </a>
        </div>
    </nav>

    <!-- Navbar Blue -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary navbar-biru">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse flex-column flex-md-row mx-3" id="navbarNav">
            <a class="navbar-brand d-flex align-items-center p-2" href="#">
                <span>
                    <iconify-icon icon="material-symbols:home-outline" width="25"></iconify-icon>
                </span>
                <span class="ml-2">Data Perguruan Tinggi</span>
            </a>
            <a class="navbar-brand d-flex align-items-center p-2" href="#">
                <span>
                    <iconify-icon icon="ph:users" width="25"></iconify-icon>
                </span>
                <span class="ml-2">Dosen</span>
            </a>
            <a class="navbar-brand d-flex align-items-center p-2" href="#">
                <span>
                    <iconify-icon icon="ic:outline-email" width="25"></iconify-icon>
                </span>
                <span class="ml-2">Layanan ULT</span>
            </a>
        </div>
    </nav>

    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body text-center pt-5 pb-5">
                        <h3 class="font-weight-bold mb-4">Layanan Pemotongan Pajak PPh 21</h3>

                        <div class="d-flex justify-content-around flex-wrap">
                            <div class="mb-3">
                                <img src="<?= base_url('skydash-template/images/download-cloud.svg'); ?>" alt="">
                                <div class="font-weight-bold mt-3 mb-3">Unduh Bukti Potong Pajak</div>
                                <button type="button" class="btn btn-primary w-100" onclick="unduh()" id="unduh">Unduh</button>
                                <!-- <br><br>
                                <button type="button" class="btn btn-primary w-100" onclick="unduh_mpdf()" id="unduh">Unduh (Mpdf)</button> -->
                            </div>
                            <script>
                                // function unduh_mpdf() {
                                //     window.open("layanan-pajak/unduh-mpdf", '_blank');
                                // }

                                function unduh() {
                                    window.open("layanan-pajak/unduh", '_blank');
                                }
                            </script>

                            <div class="mb-3">
                                <img src="<?= base_url('skydash-template/images/upload-cloud.svg'); ?>" alt="">
                                <div class="font-weight-bold mt-3 mb-3">Unggah Bukti Pembayaran Pajak</div>
                                <label for="formFile" class="btn btn-primary w-100">
                                    <span id="fileName">Unggah</span>
                                    <input class="d-none" type="file" id="formFile" onchange="displayFileName(this)">
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- partial:partials/_footer.html -->
    <footer class="footer">
        <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2021. Premium <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from
                BootstrapDash. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="ti-heart text-danger ml-1"></i></span>
        </div>
        <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Distributed by <a href="https://www.themewagon.com/" target="_blank">Themewagon</a></span>
        </div>
    </footer>
    <!-- partial -->

    <!-- plugins:js -->
    <script src="<?= base_url('skydash-template/vendors/js/vendor.bundle.base.js'); ?>"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="<?= base_url('skydash-template/vendors/chart.js/Chart.min.js'); ?>"></script>
    <script src="<?= base_url('skydash-template/vendors/datatables.net/jquery.dataTables.js'); ?>"></script>
    <script src="<?= base_url('skydash-template/vendors/datatables.net-bs4/dataTables.bootstrap4.js'); ?>"></script>
    <script src="<?= base_url('skydash-template/js/dataTables.select.min.js'); ?>"></script>

    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="<?= base_url('skydash-template/js/off-canvas.js'); ?>"></script>
    <script src="<?= base_url('skydash-template/js/hoverable-collapse.js'); ?>"></script>
    <script src="<?= base_url('skydash-template/js/template.js'); ?>"></script>
    <script src="<?= base_url('skydash-template/js/settings.js'); ?>"></script>
    <script src="<?= base_url('skydash-template/js/todolist.js'); ?>"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="<?= base_url('skydash-template/js/dashboard.js'); ?>"></script>
    <script src="<?= base_url('skydash-template/js/Chart.roundedBarCharts.js'); ?>"></script>
    <!-- End custom js for this page-->

    <!-- Iconify -->
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>

    <!-- Data Table -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

    <!-- Script Lokal -->
    <script src="<?= base_url('skydash-template/js/script.js'); ?>"></script>

    <!-- Captcha Robot -->
    <script src='https://www.google.com/recaptcha/api.js'></script>

</body>

</html>