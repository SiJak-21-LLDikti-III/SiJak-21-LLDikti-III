<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="content-wrapper">
    <div class="card">
        <div class="card-body p-5">
            <h3 class="font-weight-bold">Edit Bukti Potong Pajak PPh 21</h3>
            <form class="mt-5">
                <div class="form-group">
                    <label for="formGroupExampleInput">Tahun</label>
                    <div class="col-sm-12">
                        <select class="form-control shadow-sm" id="year" name="year" onchange="fetchTableData()">
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
                <div class="form-group">
                    <label for="formGroupExampleInput2">NPWP</label>
                    <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Another input">
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput">Nama</label>
                    <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Example input">
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">PPh 21 Terpotong</label>
                    <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Another input">
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput">PPh 21 Terutang</label>
                    <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Example input">
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">File Bukti Bayar</label>
                    <div class="row">
                        <!-- Menampilkan PDF di sebelah kiri dengan kolom 8 -->
                        <div class="col-md-8">
                            <iframe id="pdfViewer" src="" width="25%" height="150px"></iframe>
                        </div>
                        <!-- Tombol hapus di sebelah kanan dengan kolom 4 -->
                        <div class="d-flex align-items-center justify-content-start">
                            <button class="btn btn-danger delete-button" onclick="hapusPDF()">Hapus</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>