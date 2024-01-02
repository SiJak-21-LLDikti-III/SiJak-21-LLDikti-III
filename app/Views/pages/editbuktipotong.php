<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="content-wrapper">
    <!-- <div class="card">
        <div class="card-body p-5">
            <div class="d-flex align-items-center justify-content-between">
                <a href="" class="btn btn-primary">
                    <iconify-icon icon="ep:back" width="25"></iconify-icon>
                </a>
                <h3 class="font-weight-bold">Edit Bukti Potong Pajak PPh 21</h3>
            </div>
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
                        <div>
                            <iframe id="pdfViewer" src="" width="200px" height="150px"></iframe>
                        </div>
                        <div class="d-flex align-items-center justify-content-start ml-5">
                            <button class="btn btn-danger delete-button" onclick="hapusPDF()">Hapus</button>
                        </div>
                    </div>
                </div>
            </form>

            <button class="btn btn-primary w-100">Update</button>
        </div>
    </div> -->
    <div class="card">
        <div class="card-body mb-2">
            <div class="container-fluid">
                <div id="beginPage" class="mb-3">
                    <div class="d-sm-flex align-items-center justify-content-between mb-1">
                        <a href="" class="btn btn-primary">
                            <iconify-icon icon="ep:back" width="25"></iconify-icon>
                        </a>
                        <h1 class="h3">Edit Bukti Potong Pajak PPh 21</h1>
                        <button type="button" id="tambahData"
                            class="d-none d-sm-inline-block btn btn-lg btn-primary shadow-sm page-heading" disabled>
                            <i class="fas fa-floppy-disk" aria-hidden="true" data-action="saveData"></i>&nbsp;Update
                            Data
                        </button>
                    </div>
                    <hr class="hr mt-3">
                    <br>
                    <div class="progress mb-3">
                        <div class="progress-bar progress-bar-striped bg-primary" role="progressbar" aria-valuenow="0"
                            aria-valuemin="0" aria-valuemax="100">
                            <span class="progress-text">0%</span>
                        </div>
                    </div>


                    <ul class="nav nav-tabs" id="myTabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="step1-tab" data-toggle="tab" href="#step1" role="tab"
                                aria-controls="step1" aria-selected="true">Nomor Surat</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="step2-tab" data-toggle="tab" href="#step2" role="tab"
                                aria-controls="step2" aria-selected="false">Identitas Penerima</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="step3-tab" data-toggle="tab" href="#step3" role="tab"
                                aria-controls="step3" aria-selected="false">Rincian Penghasilan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="step4-tab" data-toggle="tab" href="#step4" role="tab"
                                aria-controls="step4" aria-selected="false">Status Pegawai</a>
                        </li>
                    </ul>

                    <hr class="mt-0 mb-6">
                    <br>

                    <div class="tab-content" id="myTabsContent">

                        <div class="tab-pane fade show active" id="step1" role="tabpanel" aria-labelledby="step1-tab">
                            <!-- Isi Form Step 1 -->
                            <div class="form-horizontal">
                                <h3 class="h3">Nomor Surat</h3>
                                <hr class="hr">
                                <br>
                                <div class="form-group row">
                                    <label for="no_pendaftaran" class="col-sm-2 col-form-label">Nomor<span
                                            class="text-danger">*</span></label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="no_pendaftaran"
                                            name="no_pendaftaran" value="" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="no_pendaftaran" class="col-sm-2 col-form-label">SPT Pembetulan Ke-<span
                                            class="text-danger">*</span></label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="no_pendaftaran"
                                            name="no_pendaftaran" value="" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="day" class="col-sm-2 col-form-label">Masa Perolehan Penghasilan</label>
                                    <div class="col-sm-3">
                                        <select class="form-control shadow-sm" id="day" name="day">
                                            <?php
                                            for ($day = 1; $day <= 31; $day++) {
                                                $dayFormatted = str_pad($day, 2, '0', STR_PAD_LEFT); // Mengubah format menjadi dua digit
                                                echo "<option value='$dayFormatted'>$dayFormatted</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <select class="form-control shadow-sm" id="month" name="month">
                                            <?php
                                            for ($month = 1; $month <= 12; $month++) {
                                                $monthFormatted = str_pad($month, 2, '0', STR_PAD_LEFT); // Mengubah format menjadi dua digit
                                                echo "<option value='$monthFormatted'>$monthFormatted</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
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
                            </div>
                        </div>

                        <div class="tab-pane fade" id="step2" role="tabpanel" aria-labelledby="step2-tab">
                            <!-- Isi Form Step 2 -->
                            <div class="form-horizontal">
                                <h3 class="h3">Identitas Penerima</h3>
                                <hr class="hr">
                                <br>
                                <div class="form-group row">
                                    <label for="nisn" class="col-2 col-form-label">NPWP<span
                                            class="text-danger">*</span></label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="nisn" name="nisn" value="" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nisn" class="col-2 col-form-label">NIP/NRP<span
                                            class="text-danger">*</span></label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="nisn" name="nisn" value="" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nisn" class="col-2 col-form-label">Nama<span
                                            class="text-danger">*</span></label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="nisn" name="nisn" value="" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nisn" class="col-2 col-form-label">Pangkat/Golongan<span
                                            class="text-danger">*</span></label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="nisn" name="nisn" value="" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nisn" class="col-2 col-form-label">Nama Jabatan<span
                                            class="text-danger">*</span></label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="nisn" name="nisn" value="" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nisn" class="col-2 col-form-label">Jenis Kelamin<span
                                            class="text-danger">*</span></label>
                                    <div class="form-check form-check-inline ml-3">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                            id="inlineRadio1" value="L">
                                        <label class="" for="inlineRadio1">Laki-Laki</label>
                                    </div>
                                    <div class="form-check form-check-inline ml-3">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                            id="inlineRadio2" value="P">
                                        <label class="" for="inlineRadio2">Perempuan</label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nisn" class="col-2 col-form-label">NIK<span
                                            class="text-danger">*</span></label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="nisn" name="nisn" value="" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="alamat_tinggal" class="col-2 col-form-label">Status/Jumlah Tanggungan
                                        Keluarga</label>
                                    <div id="formAlamat">
                                        <div class="form-row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <input type="text" name="alamat" class="form-control"
                                                        id="alamat_tinggal" placeholder="K *" value="" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <input type="text" name="rt" class="form-control" id="rt"
                                                        placeholder="TK *" value="" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <input type="text" name="rw" class="form-control" id="rw"
                                                        placeholder="HB *" value="" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="step3" role="tabpanel" aria-labelledby="step3-tab">
                            <!-- Isi Form Step 3 -->
                            <div class="form-horizontal">
                                <h3 class="h3">Rincian Penghasilan</h3>
                                <hr class="hr">
                                <br>
                                <h4 class="h4">Penghasilan Bruto</h4>
                                <hr>
                                <div class="form-group row">
                                    <label for="no_kk" class="col-2 col-form-label">Gaji Pokok/Pensiunan<span
                                            class="text-danger">*</span></label>
                                    <div class="col">
                                        <input type="number" class="form-control" id="no_kk" name="no_kk" value=""
                                            required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nik_kk" class="col-2 col-form-label">Tunjangan Istri<span
                                            class="text-danger">*</span></label>
                                    <div class="col">
                                        <input type="number" class="form-control" id="nik_kk" name="nik_kk" value=""
                                            required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="jumlah_tanggungan" class="col-2 col-form-label">Tunjangan Anak<span
                                            class="text-danger">*</span></label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="jumlah_tanggungan"
                                            name="jumlah_tanggungan" value="" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nama_ayah" class="col-2 col-form-label">Jumlah gaji dan Tunjangan
                                        Keluarga (1 S.D. 3)<span class="text-danger">*</span></label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="nama_ayah" name="nama_ayah" value=""
                                            required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="status_ayah" class="col-2 col-form-label">Tunjangan Perbaikan
                                        Penghasilan<span class="text-danger">*</span></label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="status_ayah" name="status_ayah"
                                            value="" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="nama_ibu" class="col-2 col-form-label">Tunjangan
                                        Struktural/Fungsional<span class="text-danger">*</span></label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="nama_ibu" name="nama_ibu" value=""
                                            required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="status_ibu" class="col-2 col-form-label">Tunjangan Beras<span
                                            class="text-danger">*</span></label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="status_ibu" name="status_ibu"
                                            value="" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="status_ibu" class="col-2 col-form-label">Jumlah Penghasilan Bruto (1
                                        S.D. 7)<span class="text-danger">*</span></label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="status_ibu" name="status_ibu"
                                            value="" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="status_ibu" class="col-2 col-form-label">Tunjangan Lain-Lain<span
                                            class="text-danger">*</span></label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="status_ibu" name="status_ibu"
                                            value="" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="status_ibu" class="col-2 col-form-label">Penghasilan Tetap dan Teratur
                                        Lainnya yang Pembayarannya Terpisah dari Pembayaran Gaji<span
                                            class="text-danger">*</span></label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="status_ibu" name="status_ibu"
                                            value="" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="status_ibu" class="col-2 col-form-label">Jumlah Penghasilan Bruto (4
                                        S.D. 10)<span class="text-danger">*</span></label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="status_ibu" name="status_ibu"
                                            value="" required>
                                    </div>
                                </div>

                                <h4 class="h4 mt-5">Pengurangan</h4>
                                <hr>
                                <div class="form-group row">
                                    <label for="status_ibu" class="col-2 col-form-label">Biaya Jabatan/Biaya
                                        Pensiun<span class="text-danger">*</span></label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="status_ibu" name="status_ibu"
                                            value="" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="status_ibu" class="col-2 col-form-label">Iuran Pensiun atau Iuran
                                        THT/JHT<span class="text-danger">*</span></label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="status_ibu" name="status_ibu"
                                            value="" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="status_ibu" class="col-2 col-form-label">Jumlah Pengurangan (12 S.D
                                        13)<span class="text-danger">*</span></label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="status_ibu" name="status_ibu"
                                            value="" required>
                                    </div>
                                </div>

                                <h4 class="h4 mt-5">Penghitungan PPh Pasal 21</h4>
                                <hr>
                                <div class="form-group row">
                                    <label for="status_ibu" class="col-2 col-form-label">Jumlah Penghasilan Neto
                                        (11-14)<span class="text-danger">*</span></label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="status_ibu" name="status_ibu"
                                            value="" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="status_ibu" class="col-2 col-form-label">Penghasilan Neto Masa Pajak
                                        Sebelumnya<span class="text-danger">*</span></label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="status_ibu" name="status_ibu"
                                            value="" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="status_ibu" class="col-2 col-form-label">Jumlah Penghasilan Neto Untuk
                                        Perhitungan PPh Pasal 21 (Setahun/Disetahunkan)<span
                                            class="text-danger">*</span></label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="status_ibu" name="status_ibu"
                                            value="" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="status_ibu" class="col-2 col-form-label">Penghasilan Tidak Kena Pajak
                                        (PTKP)<span class="text-danger">*</span></label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="status_ibu" name="status_ibu"
                                            value="" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="status_ibu" class="col-2 col-form-label">Penghasilan Kena Pajak
                                        Setahun/Disetahunkan (17-18)<span class="text-danger">*</span></label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="status_ibu" name="status_ibu"
                                            value="" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="status_ibu" class="col-2 col-form-label">PPh Pasal 21 atas Penghasilan
                                        Kena Pajak Setahun/Disetahunkan<span class="text-danger">*</span></label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="status_ibu" name="status_ibu"
                                            value="" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="status_ibu" class="col-2 col-form-label">PPh Pasal 21 yang Telah
                                        Dipotong Masa Pajak Sebelumnya<span class="text-danger">*</span></label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="status_ibu" name="status_ibu"
                                            value="" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="status_ibu" class="col-2 col-form-label">PPh Pasal 21 Terutang<span
                                            class="text-danger">*</span></label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="status_ibu" name="status_ibu"
                                            value="" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="status_ibu" class="col-2 col-form-label">PPh Pasal 21 yang Telah
                                        Dipotong dan Dilunasi<span class="text-danger">*</span></label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="status_ibu" name="status_ibu"
                                            value="" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="status_ibu" class="col-2 col-form-label">Atas Gaji dan Tunjangan<span
                                            class="text-danger">*</span></label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="status_ibu" name="status_ibu"
                                            value="" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="status_ibu" class="col-2 col-form-label">Atas Penghasilan Tetap dan
                                        Teratur Lainnya yang Pembayaran Terpisah Dari Pembayaran Gaji<span
                                            class="text-danger">*</span></label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="status_ibu" name="status_ibu"
                                            value="" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="step4" role="tabpanel" aria-labelledby="step4-tab">
                            <!-- Isi Form Step 2 -->
                            <div class="form-horizontal">
                                <h3 class="h3">Status Pegawai</h3>
                                <hr class="hr">
                                <div class="form-group row">
                                    <label for="nisn" class="col-2 col-form-label">Jenis Kelamin<span
                                            class="text-danger">*</span></label>
                                    <div class="form-check form-check-inline ml-3">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                            id="inlineRadio1" value="L">
                                        <label class="" for="inlineRadio1">Dipindahkan</label>
                                    </div>
                                    <div class="form-check form-check-inline ml-3">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                            id="inlineRadio2" value="P">
                                        <label class="" for="inlineRadio2">Pindahan</label>
                                    </div>
                                    <div class="form-check form-check-inline ml-3">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                            id="inlineRadio2" value="P">
                                        <label class="" for="inlineRadio2">Baru</label>
                                    </div>
                                    <div class="form-check form-check-inline ml-3">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                            id="inlineRadio2" value="P">
                                        <label class="" for="inlineRadio2">Pensiun</label>
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
<?= $this->endSection(); ?>