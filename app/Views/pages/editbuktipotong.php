<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="content-wrapper">
    <div class="card">
        <div class="card-body mb-2">
            <div class="container-fluid">
                <!-- Tempatkan di halaman HTML Anda -->
                <div id="success-alert"></div>
                <div id="error-alert"></div>
                <div id="beginPage" class="mb-3">
                    <div class="d-sm-flex align-items-center justify-content-between mb-1">
                        <a href="<?= base_url(); ?>bukti-potong" class="btn btn-primary">
                            <iconify-icon icon="ep:back" width="25"></iconify-icon>
                        </a>
                        <h1 class="h3">Edit Bukti Potong Pajak PPh 21</h1>
                        <button type="button" id="updateData" class="d-none d-sm-inline-block btn btn-lg btn-primary shadow-sm page-heading">
                            <i class="fas fa-floppy-disk" aria-hidden="true" data-action="saveData"></i>&nbsp;Update Data
                        </button>
                    </div>
                    <hr class="hr mt-3">
                    <br>
                    <div class="progress mb-3">
                        <div class="progress-bar progress-bar-striped bg-primary" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                            <span class="progress-text">0%</span>
                        </div>
                    </div>


                    <ul class="nav nav-tabs" id="myTabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="step1-tab" data-toggle="tab" href="#step1" role="tab" aria-controls="step1" aria-selected="true">Nomor Surat</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="step2-tab" data-toggle="tab" href="#step2" role="tab" aria-controls="step2" aria-selected="false">Kode Objek Pajak</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="step3-tab" data-toggle="tab" href="#step3" role="tab" aria-controls="step3" aria-selected="false">Identitas Penerima</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="step4-tab" data-toggle="tab" href="#step4" role="tab" aria-controls="step4" aria-selected="false">Rincian Penghasilan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="step5-tab" data-toggle="tab" href="#step5" role="tab" aria-controls="step5" aria-selected="false">Status Pegawai</a>
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
                                    <label for="no_pendaftaran" class="col-sm-2 col-form-label">H.01 Nomor<span class="text-danger">*</span></label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="no_pendaftaran" name="no_pendaftaran" value="<?= $data[0]->no_H01 ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="spt_pembetulan" class="col-sm-2 col-form-label">H.02 SPT Pembetulan Ke-<span class="text-danger">*</span></label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="spt_pembetulan" name="spt_pembetulan" value="<?= $data[0]->spt_H02 ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="pembatalan_H03" class="col-sm-2 col-form-label">H.03 Pembatalan<span class="text-danger">*</span></label>
                                    <div class="form-check form-check-inline ml-3">
                                        <input class="form-check-input" type="checkbox" name="pembatalan_H03" id="pembatalan_H03" value="1" <?= ($data[0]->pembatalan_H03 == '1') ? 'checked' : '' ?>>
                                        <label class="" for="pembatalan_H03">Ceklis</label>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="day" class="col-sm-2 col-form-label">Masa Perolehan Penghasilan</label>
                                    <div class="col-sm-3">
                                        <?php
                                        // Separate the string "2023-04-04" into three parts
                                        $dateParts = explode('-', $data[0]->{'mperlan_H04-H05'});
                                        // dd($dateParts);
                                        $selectedYear = $dateParts[0];  // Updated this line
                                        $selectedMonth1 = $dateParts[1];
                                        $selectedMonth2 = $dateParts[2];
                                        ?>
                                        <label for="month1">H.04 [mm]</label>
                                        <select class="form-control shadow-sm" id="month1" name="month1">
                                            <?php
                                            for ($month = 1; $month <= 12; $month++) {
                                                $monthFormatted = str_pad($month, 2, '0', STR_PAD_LEFT);
                                                echo "<option value='$monthFormatted' " . (($selectedMonth1 == $monthFormatted) ? 'selected' : '') . ">$monthFormatted</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="month2">H.04 [mm]</label>
                                        <select class="form-control shadow-sm" id="month2" name="month2">
                                            <?php
                                            for ($month = 1; $month <= 12; $month++) {
                                                $monthFormatted = str_pad($month, 2, '0', STR_PAD_LEFT);
                                                echo "<option value='$monthFormatted' " . (($selectedMonth2 == $monthFormatted) ? 'selected' : '') . ">$monthFormatted</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="year">H.05 [yyyy]</label>
                                        <select class="form-control shadow-sm" id="year" name="year">
                                            <?php
                                            $currentYear = date("Y");
                                            $startYear = $currentYear - 100; // 100 tahun terakhir
                                            for ($year = $currentYear; $year >= $startYear; $year--) {
                                                echo "<option value='$year' " . (($selectedYear == $year) ? 'selected' : '') . ">$year</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>



                            </div>
                        </div>

                        <div class="tab-pane fade" id="step2" role="tabpanel" aria-labelledby="step2-tab">
                            <!-- Isi Form Step 4 -->
                            <div class="form-horizontal">
                                <!-- kondisikan if status pegawai (C.01/C.02/C.03/C.04) -->
                                <h3 class="h3">KODE OBJEK PAJAK :</h3>
                                <hr class="hr">
                                <div class="form-group row">
                                    <label for="status_pegawai" class="col-2 col-form-label">KODE OBJEK PAJAK :<span class="text-danger">*</span></label>
                                    <div class="form-check form-check-inline ml-3">
                                        <input class="form-check-input" type="radio" name="kd_pajak" id="kd_pajak" value="01" <?= ($data[0]->kd_pajak == '01') ? 'checked' : '' ?>>
                                        <label class="" for="kd_pajak">21-100-01</label>
                                    </div>
                                    <div class="form-check form-check-inline ml-3">
                                        <input class="form-check-input" type="radio" name="kd_pajak" id="kd_pajak" value="02" <?= ($data[0]->kd_pajak == '02') ? 'checked' : '' ?>>
                                        <label class="" for="kd_pajak">21-100-02</label>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="tab-pane fade" id="step3" role="tabpanel" aria-labelledby="step3-tab">
                            <!-- Isi Form Step 2 -->
                            <div class="form-horizontal">
                                <h3 class="h3">Identitas Penerima</h3>
                                <hr class="hr">
                                <br>
                                <div class="form-group row">
                                    <label for="npwp" class="col-2 col-form-label">NPWP<span class="text-danger">*</span></label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="npwp" name="npwp" value="<?= $data[0]->npwp_A1 ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nip" class="col-2 col-form-label">NIP/NRP<span class="text-danger">*</span></label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="nip" name="nip" value="<?= $data[0]->nip_A2 ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nama" class="col-2 col-form-label">Nama<span class="text-danger">*</span></label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="nama" name="nama" value="<?= $data[0]->nama_A3 ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="pangkat" class="col-2 col-form-label">Pangkat/Golongan<span class="text-danger">*</span></label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="pangkat" name="pangkat" value="<?= $data[0]->pangkat_A4 ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="jabatan" class="col-2 col-form-label">Nama Jabatan<span class="text-danger">*</span></label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="jabatan" name="jabatan" value="<?= $data[0]->nama_jabatan_A5 ?>" required>
                                    </div>
                                </div>
                                <!-- kondisi if jenis kelamin dari db -->
                                <div class="form-group row">
                                    <label for="jenis_kelamin" class="col-2 col-form-label">Jenis Kelamin<span class="text-danger">*</span></label>
                                    <div class="form-check form-check-inline ml-3">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="laki_laki" value="L" <?= ($data[0]->jenis_kelamin_A6 == 'L') ? 'checked' : '' ?>>
                                        <label class="" for="laki_laki">Laki-Laki</label>
                                    </div>
                                    <div class="form-check form-check-inline ml-3">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="perempuan" value="P" <?= ($data[0]->jenis_kelamin_A6 == 'P') ? 'checked' : '' ?>>
                                        <label class="" for="perempuan">Perempuan</label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nik" class="col-2 col-form-label">NIK<span class="text-danger">*</span></label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="nik" name="nik" value="<?= $data[0]->nik_A7 ?>" required>
                                    </div>
                                </div>
                                <!-- pisahkan db (substr) -->
                                <div class="form-group row">
                                    <label for="jumlah_tanggungan" class="col-2 status-tanggungan col-form-label">Status/Jumlah Tanggungan Keluarga</label>
                                    <div id="formAlamat">
                                        <div class="form-row">
                                            <?php
                                            // Separate the string "0-0-0" into three parts
                                            $statusA8Parts = explode('-', $data[0]->status_A8);
                                            ?>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="status_k">Status K *</label>
                                                    <input type="text" name="status_k" class="form-control" id="status_k" placeholder="K *" value="<?= $statusA8Parts[0] ?>" required>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="status_tk">Status TK *</label>
                                                    <input type="text" name="status_tk" class="form-control" id="status_tk" placeholder="TK *" value="<?= $statusA8Parts[1] ?>" required>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="status_hb">Status HB *</label>
                                                    <input type="text" name="status_hb" class="form-control" id="status_hb" placeholder="HB *" value="<?= $statusA8Parts[2] ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="tab-pane fade" id="step4" role="tabpanel" aria-labelledby="step4-tab">
                            <!-- Isi Form Step 3 -->
                            <div class="form-horizontal">
                                <h3 class="h3">Rincian Penghasilan</h3>
                                <hr class="hr">
                                <br>
                                <h4 class="h4">Penghasilan Bruto</h4>
                                <hr>
                                <div class="form-group row">
                                    <label for="gaji_pokok" class="col-2 col-form-label">Gaji Pokok/Pensiunan<span class="text-danger">*</span></label>
                                    <div class="col">
                                        <input type="number" class="form-control" id="gaji_pokok" name="gaji_pokok" value="<?= $data[0]->gaji_pokok ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="tj_istri" class="col-2 col-form-label">Tunjangan Istri<span class="text-danger">*</span></label>
                                    <div class="col">
                                        <input type="number" class="form-control" id="tj_istri" name="tj_istri" value="<?= $data[0]->tj_istri ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="tj_anak" class="col-2 col-form-label">Tunjangan Anak<span class="text-danger">*</span></label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="tj_anak" name="tj_anak" value="<?= $data[0]->tj_anak ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="jml_gaji" class="col-2 col-form-label">Jumlah gaji dan Tunjangan Keluarga (1 S.D. 3)<span class="text-danger">*</span></label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="jml_gaji" name="jml_gaji" value="<?= $data[0]->jml_gaji ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="tj_perbaikan" class="col-2 col-form-label">Tunjangan Perbaikan Penghasilan<span class="text-danger">*</span></label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="tj_perbaikan" name="tj_perbaikan" value="<?= $data[0]->tj_perbaikan ?>" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="tj_struktural" class="col-2 col-form-label">Tunjangan Struktural/Fungsional<span class="text-danger">*</span></label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="tj_struktural" name="tj_struktural" value="<?= $data[0]->tj_struktural ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="tj_beras" class="col-2 col-form-label">Tunjangan Beras<span class="text-danger">*</span></label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="tj_beras" name="tj_beras" value="<?= $data[0]->tj_beras ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="jml_bruto_1" class="col-2 col-form-label">Jumlah Penghasilan Bruto (1 S.D. 7)<span class="text-danger">*</span></label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="jml_bruto_1" name="jml_bruto_1" value="<?= $data[0]->jml_bruto_1 ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="tj_lain" class="col-2 col-form-label">Tunjangan Lain-Lain<span class="text-danger">*</span></label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="tj_lain" name="tj_lain" value="<?= $data[0]->tj_lain ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="ph_tetap" class="col-2 col-form-label">Penghasilan Tetap dan Teratur Lainnya yang Pembayaran Terpisah dari Pembayaran Gaji<span class="text-danger">*</span></label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="ph_tetap" name="ph_tetap" value="<?= $data[0]->ph_tetap ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="jml_bruto_2" class="col-2 col-form-label">Jumlah Penghasilan Bruto (4 S.D. 10)<span class="text-danger">*</span></label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="jml_bruto_2" name="jml_bruto_2" value="<?= $data[0]->jml_bruto_2 ?>" required>
                                    </div>
                                </div>

                                <h4 class="h4 mt-5">Pengurangan</h4>
                                <hr>
                                <div class="form-group row">
                                    <label for="biaya_jabatan" class="col-2 col-form-label">Biaya Jabatan/Biaya Pensiun<span class="text-danger">*</span></label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="biaya_jabatan" name="biaya_jabatan" value="<?= $data[0]->biaya_jabatan ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="iuran_pensiun" class="col-2 col-form-label">Iuran Pensiun atau Iuran THT/JHT<span class="text-danger">*</span></label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="iuran_pensiun" name="iuran_pensiun" value="<?= $data[0]->iuran_pensiun ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="jml_pengurangan" class="col-2 col-form-label">Jumlah Pengurangan (12 S.D 13)<span class="text-danger">*</span></label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="jml_pengurangan" name="jml_pengurangan" value="<?= $data[0]->jml_pengurangan ?>" required>
                                    </div>
                                </div>

                                <h4 class="h4 mt-5">Penghitungan PPh Pasal 21</h4>
                                <hr>
                                <div class="form-group row">
                                    <label for="jml_ph" class="col-2 col-form-label">Jumlah Penghasilan Neto (11-14)<span class="text-danger">*</span></label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="jml_ph" name="jml_ph" value="<?= $data[0]->jml_ph ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="ph_neto" class="col-2 col-form-label">Penghasilan Neto Masa Pajak Sebelumnya<span class="text-danger">*</span></label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="ph_neto" name="ph_neto" value="<?= $data[0]->ph_neto ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="jml_ph_neto" class="col-2 col-form-label">Jumlah Penghasilan Neto Untuk Perhitungan PPh Pasal 21 (Setahun/Disetahunkan)<span class="text-danger">*</span></label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="jml_ph_neto" name="jml_ph_neto" value="<?= $data[0]->jml_ph_neto ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="ptkp" class="col-2 col-form-label">Penghasilan Tidak Kena Pajak (PTKP)<span class="text-danger">*</span></label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="ptkp" name="ptkp" value="<?= $data[0]->ptkp ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="ph_kena_pajak" class="col-2 col-form-label">Penghasilan Kena Pajak Setahun/Disetahunkan (17-18)<span class="text-danger">*</span></label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="ph_kena_pajak" name="ph_kena_pajak" value="<?= $data[0]->ph_kena_pajak ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="pph_pasal_21" class="col-2 col-form-label">PPh Pasal 21 atas Penghasilan Kena Pajak Setahun/Disetahunkan<span class="text-danger">*</span></label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="pph_pasal_21" name="pph_pasal_21" value="<?= $data[0]->pph_ph ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="pph_telah_dipotong" class="col-2 col-form-label">PPh Pasal 21 yang Telah Dipotong Masa Pajak Sebelumnya<span class="text-danger">*</span></label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="pph_telah_dipotong" name="pph_telah_dipotong" value="<?= $data[0]->pph_potong ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="pph_terutang" class="col-2 col-form-label">PPh Pasal 21 Terutang<span class="text-danger">*</span></label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="pph_terutang" name="pph_terutang" value="<?= $data[0]->pph_utang ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="pph_telah_dipotong_dilunasi" class="col col-form-label">PPh Pasal 21 yang Telah Dipotong dan Dilunasi<span class="text-danger">*</span></label>
                                    <div class="col">
                                        <!-- <input type="text" class="form-control" id="pph_telah_dipotong_dilunasi" name="pph_telah_dipotong_dilunasi" value="" required> -->
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="atas_gaji_23A" class="col-2 col-form-label">Atas Gaji dan Tunjangan<span class="text-danger">*</span></label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="atas_gaji_23A" name="atas_gaji_23A" value="<?= $data[0]->atas_gaji_23A ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="atas_ph_23B" class="col-2 col-form-label">Atas Penghasilan Tetap dan Teratur Lainnya yang Pembayaran Terpisah Dari Pembayaran Gaji<span class="text-danger">*</span></label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="atas_ph_23B" name="atas_ph_23B" value="<?= $data[0]->atas_ph_23B ?>" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="step5" role="tabpanel" aria-labelledby="step5-tab">
                            <!-- Isi Form Step 4 -->
                            <div class="form-horizontal">
                                <!-- kondisikan if status pegawai (C.01/C.02/C.03/C.04) -->
                                <h3 class="h3">Status Pegawai</h3>
                                <hr class="hr">
                                <div class="form-group row">
                                    <label for="status_pegawai" class="col-2 col-form-label">Status Pegawai<span class="text-danger">*</span></label>
                                    <div class="form-check form-check-inline ml-3">
                                        <input class="form-check-input" type="radio" name="status_pegawai" id="status_dipindahkan" value="C.01" <?= ($data[0]->status_pegawai == 'C.01') ? 'checked' : '' ?>>
                                        <label class="" for="status_dipindahkan">Dipindahkan</label>
                                    </div>
                                    <div class="form-check form-check-inline ml-3">
                                        <input class="form-check-input" type="radio" name="status_pegawai" id="status_pindahan" value="C.02" <?= ($data[0]->status_pegawai == 'C.02') ? 'checked' : '' ?>>
                                        <label class="" for="status_pindahan">Pindahan</label>
                                    </div>
                                    <div class="form-check form-check-inline ml-3">
                                        <input class="form-check-input" type="radio" name="status_pegawai" id="status_baru" value="C.03" <?= ($data[0]->status_pegawai == 'C.03') ? 'checked' : '' ?>>
                                        <label class="" for="status_baru">Baru</label>
                                    </div>
                                    <div class="form-check form-check-inline ml-3">
                                        <input class="form-check-input" type="radio" name="status_pegawai" id="status_pensiun" value="C.04" <?= ($data[0]->status_pegawai == 'C.04') ? 'checked' : '' ?>>
                                        <label class="" for="status_pensiun">Pensiun</label>
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