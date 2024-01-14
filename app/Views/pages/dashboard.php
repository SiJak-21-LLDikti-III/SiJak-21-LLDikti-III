<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<!-- partial -->
<div class="content-wrapper">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="row">
                        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                            <h3 class="font-weight-bold">Welcome EL,</h3>
                            <h6 class="font-weight-normal mb-0">Di Sistem Pemotongan Pajak Penghasilan Pasal 21,<span class="text-primary"> SIJAK21!</span></h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card tale-bg">
                        <div class="card-people mt-auto">
                            <img src="<?= base_url('skydash-template/images/dashboard/people.svg'); ?>" alt="people">
                        </div>
                    </div>
                </div>
                <div class="col-md-6 grid-margin transparent">
                    <div class="row">
                        <div class="col-md-6 mb-4 stretch-card transparent">
                            <div class="card card-tale">
                                <div class="card-body">
                                    <h2 class="mb-4">Data Pajak</h2>
                                    <p class="fs-30 mb-2">2</p>
                                    <p>Data yang sudah ditambahkan ke database</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4 stretch-card transparent">
                            <div class="card card-dark-blue">
                                <div class="card-body">
                                    <h2 class="mb-4">Unduh</h2>
                                    <p class="fs-30 mb-2">61344</p>
                                    <p>Total yang sudah unduh bukti potong</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                            <div class="card card-light-blue">
                                <div class="card-body">
                                    <h2 class="mb-4">Unggah</h2>
                                    <p class="fs-30 mb-2">34040</p>
                                    <p>Total yang sudah unggah bukti bayar</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 stretch-card transparent">
                            <div class="card card-light-danger">
                                <div class="card-body">
                                    <h2 class="mb-4">Credits</h2>
                                    <p class="fs-30 mb-2">MSIB Batch 5</p>
                                    <p> Arizki, Surya, Satria, Rama, Aria, Meryl, Riefqi, Atikah</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>