<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body p-5">
                    <h3 class="font-weight-bold">Unggah Bukti Potong Pajak PPh 21</h3>
                    <form action="">
                        <div class="form-group row">
                            <label for="input" class="col-sm-2 col-form-label">Tahun</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="input" placeholder="">
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
                        <button type="button" class="btn btn-primary w-100">Unggah Bukti Potong</button>
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