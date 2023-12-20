<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body p-5">
                    <h3 class="font-weight-bold">Identitas Pemotong Pajak</h3>
                    <form action="" class="">
                        <div class="form-group row">
                            <label for="input" class="col-sm-2 col-form-label">NPWP Instansi Pemerintah</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control p-0" id="input" placeholder=""
                                    value="963536958005000">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input" class="col-sm-2 col-form-label">Nama Instansi Pemerintah</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control p-0" id="input" placeholder=""
                                    value="LEMBAGA LAYANAN PENDIDIKAN TINGGI WILAYAH III DKI JAKARTA DITJEN PENDIDIKAN TINGGI KEMENTERIAN PENDIDIKAN DAN KEBUDAYAAN">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input" class="col-sm-2 col-form-label">ID Subunit Organisasi</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control p-0" id="input" placeholder="">
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
                                <input type="text" class="form-control p-0" id="input" placeholder="">
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary w-100 mt-4">Input</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>