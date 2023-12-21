<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="content-wrapper">

    <div class="container-fluid">
        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success alert-dismissible show fade" role="alert">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert"></button>
                    <b>Berhasil !</b>
                    <?= session()->getFlashdata('success'); ?>
                </div>
            </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')) : ?>
            <div class="alert alert-danger alert-dismissible show fade" role="alert">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert"></button>
                    <b>Gagal !</b>
                    <?= session()->getFlashdata('error'); ?>
                </div>
            </div>
        <?php endif; ?>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body p-5">
                        <h3 class="font-weight-bold">Unggah Bukti Potong Pajak PPh 21</h3>
                        <form action="">
                            <div class="form-group row">
                                <label for="input" class="col-sm-2 col-form-label">Tahun</label>
                                <div class="col-sm-10">
                                    <select class="form-control shadow-sm" id="year" name="year">
                                        <?php
                                        $currentYear = date("Y");
                                        $startYear = $currentYear - 100; // 100 tahun terakhir
                                        for ($year = $currentYear; $year >= $startYear; $year--) {
                                            echo "<option value='$year'>$year</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="input" class="col-sm-2 col-form-label">Unggah File</label>
                                <div class="col-sm-10">
                                    <label for="formFile" class="btn btn-primary w-100 pl-5 pr-5">
                                        <span id="fileName">Pilih File</span>
                                        <input type="file" id="formFile" class="d-none" onchange="displayFileName(this)">
                                    </label>
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary w-100" onclick="uploadFile()">Unggah Bukti Potong</button>
                        </form>

                        <div class="table-responsive mt-4">
                            <table class="table table-bordered text-white" id="myTable" width="100%" cellspacing="0">
                                <thead class="bg-primary">
                                    <tr>
                                        <th>No</th>
                                        <th>Tahun</th>
                                        <th>NPWP</th>
                                        <th>Nama</th>
                                        <th>PPh 21 Terpotong</th>
                                        <th>PPh 21 Terutang</th>
                                        <th>Unduh Bukti</th>
                                        <th>Bukti Bayar</th>
                                        <th>Status Unduh</th>
                                        <th>Status Bukti Bayar</th>
                                        <th>File Bukti Bayar</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?= $this->endSection(); ?>