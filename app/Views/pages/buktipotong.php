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
        <!-- Tempatkan di halaman HTML Anda -->
        <div id="success-alert"></div>
        <div id="error-alert"></div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body p-5">
                        <h3 class="font-weight-bold">Unggah Bukti Potong Pajak PPh 21</h3>
                        <form action="">
                            <div class="form-group row">
                                <label for="input" class="col-sm-2 col-form-label">Tahun</label>
                                <div class="col-sm-10">
                                    <select class="form-control shadow-sm" id="year" name="year"
                                        onchange="fetchTableData()">
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
                                        <input type="file" id="formFile" class="d-none" onchange="displayFileName(this)"
                                            accept=".xls,.xlsx">
                                    </label>
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary w-100" onclick="uploadFile()">Unggah Bukti
                                Potong</button>
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
                                        <th>Opsi</th>
                                    </tr>
                                </thead>

                                <tbody class="text-black">
                                    <?php foreach ($dataTable as $row) :
                                        $mperlan = "mperlan_H04-H05";
                                        $yearmperlan = substr($row->$mperlan, 0, 4);
                                    ?>

                                    <tr>
                                        <td><?= $row->no_H01 ?></td>
                                        <td><?= $yearmperlan ?></td>
                                        <td><?= $row->npwp_A1 ?></td>
                                        <td><?= $row->nama_A3 ?></td>
                                        <td><?= $row->pph_potong ?? 0 ?></td>
                                        <td><?= $row->pph_utang ?? 0 ?></td>
                                        <td><?= $row->unduh_bukti ?? '0' ?></td>
                                        <td><?= $row->bukti_bayar ?? '0' ?></td>
                                        <td><?= $row->status_unduh ?? '0' ?></td>
                                        <td><?= $row->status_bukti_bayar ?? 'Belum diunggah' ?></td>
                                        <td>
                                            <!-- Tombol Download -->
                                            <?php if ($row->file_bukti_bayar) : ?>
                                            <?php
                                                    // Path menuju folder penyimpanan
                                                    $folder_path = 'FileUpload/BuktiPembayaranPajak/';

                                                    // Mendapatkan nama file
                                                    $file_name = $row->file_bukti_bayar;

                                                    // Mendapatkan informasi tentang file
                                                    $file_info = pathinfo($folder_path . $file_name);

                                                    // Mendapatkan ekstensi file
                                                    $file_extension = $file_info['extension'] ?? '';

                                                    // Menentukan subfolder berdasarkan ekstensi
                                                    $subfolder = ($file_extension === 'pdf') ? 'pdf/' : 'img/';

                                                    // Membuat path lengkap menuju file
                                                    $file_path = $folder_path . $subfolder . $file_name;
                                                    ?>

                                            <a href="<?= base_url($file_path); ?>" class="btn btn-info p-2" download>
                                                <iconify-icon icon="bi:download" width="20"></iconify-icon>
                                            </a>
                                            <?php endif; ?>


                                        </td>
                                        <td>
                                            <!-- Tombol Edit -->
                                            <a href="<?= base_url('editbuktipotong'); ?>"
                                                class="btn btn-success mr-2 p-2">
                                                <iconify-icon icon="tabler:edit" width="20"></iconify-icon>
                                            </a>

                                            <!-- Tombol Hapus -->
                                            <a class="btn btn-danger p-2">
                                                <iconify-icon icon="mdi:trash-outline" width="20">
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>