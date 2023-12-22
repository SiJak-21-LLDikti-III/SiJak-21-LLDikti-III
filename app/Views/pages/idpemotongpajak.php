<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<?php $id = 1; ?>

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body p-5">
                    <h3 class="font-weight-bold">Identitas Pemotong Pajak</h3>
                    <form action="<?= base_url("pemotong-pajak/update/{$id}"); ?>" method="post">
                        <div class="form-group row">
                            <label for="input" class="col-sm-2 col-form-label">NPWP Instansi Pemerintah</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control p-0" id="npwp" name="npwp" pattern="[0-9]+" title="Hanya angka yang diperbolehkan" required value="<?= old('npwp', $record['npwp'] ?? ''); ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input" class="col-sm-2 col-form-label">Nama Instansi Pemerintah</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control p-0" id="nama_instansi" name="nama_instansi" value="<?= old('nama_instansi', $record['nama_instansi'] ?? ''); ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input" class="col-sm-2 col-form-label">ID Subunit Organisasi</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control p-0" id="id_sub_unit" name="id_sub_unit" value="<?= old('id_sub_unit', $record['id_sub_unit'] ?? ''); ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="day" class="col-sm-2 col-form-label">Tanggal</label>
                            <div class="col-sm-3">
                                <select class="form-control shadow-sm" id="day" name="day">
                                    <?php
                                    for ($day = 1; $day <= 31; $day++) {
                                        echo "<option value='$day'>$day</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <select class="form-control shadow-sm" id="month" name="month">
                                    <?php
                                    $months = [
                                        "1", "2", "3", "4", "5", "6",
                                        "7", "8", "9", "10", "11", "12"
                                    ];
                                    foreach ($months as $index => $month) {
                                        $monthNumber = $index + 1;
                                        echo "<option value='$monthNumber'>$month</option>";
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
                        <div class="form-group row">
                            <label for="input" class="col-sm-2 col-form-label">Nama Penandatangan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control p-0" id="nama_penandatangan" name="nama_penandatangan" value="<?= old('nama_penandatangan', $record['nama_penandatangan'] ?? ''); ?>">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 mt-4">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>