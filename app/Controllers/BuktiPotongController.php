<?php

namespace App\Controllers;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use App\Models\DataModel;

class BuktiPotongController extends BaseController
{
    private $dataModel;


    public function __construct()
    {
        $this->dataModel = new DataModel();
    }
    public function index()
    {
        $dataTable = $this->dataModel->getAllDataTable();
        // log_message('info',"data bukti potong :".print_r($dataTable,true));
        $data = [
            'title' => 'Admin - Bukti Potong',
            'dataTable' => $dataTable
        ];
        // log_message("info", "data: " . print_r($data['dataTable'], true));
        return view('pages/buktipotong', $data);
    }
    public function uploadExcel()
    {
        $file = $this->request->getFile('excel_file');
        if ($file->isValid() && !in_array($file->getClientExtension(), ['xls', 'xlsx'])) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'File yang diunggah harus berformat .xls atau .xlsx']);
        }


        // Inisialisasi variabel jumlah data berhasil dan gagal
        $successCount = 0;
        $failureCount = 0;
        $failedData = [];

        // log_message("info", "type: " . print_r($file, true));
        if ($file->isValid() && in_array($file->getClientExtension(), ['xls', 'xlsx'])) {
            try {
                // Baca file Excel
                $spreadsheet = IOFactory::load($file->getPathname());

                // Ambil sheet pertama (asumsi data ada di sheet pertama)
                $worksheet = $spreadsheet->getActiveSheet();
                $nilaiskrng = 1;
                // Loop melalui baris-baris data
                foreach ($worksheet->getRowIterator(2) as $row) {
                    $cellIterator = $row->getCellIterator();
                    $cellIterator->setIterateOnlyExistingCells(false); // Memungkinkan iterasi sel kosong juga

                    $data = [];
                    foreach ($cellIterator as $cell) {
                        // $data[] = $cell->getValue();
                        // $cellValue = $cell->getValue();
                        $cellValue =  $cell->getCalculatedValue();
                        $cellReal = $cell->getFormattedValue();
                        $cellType = $cell->getDataType();

                        // Log data dan tipe sel setiap kali membaca baris
                        // log_message('info', 'Data Baris-' . $nilaiskrng . ': ' . $cellValue . ' - diexcel: ' . $cellReal . ' - Tipe: ' . $cellType);
                        // log_message('info', 'Data Baris: ' . $cellValue . 'data diexcel : '.$cellReal.' - Tipe: ' . $cellType);
                        $nilaiskrng++;
                        // Konversi nilai tanggal jika tipe datanya adalah 'n'
                        if ($cellType === 'n' && Date::isDateTime($cell)) {
                            // Tambahkan pemeriksaan tipe data sebelum menggunakan floor()
                            if (is_numeric($cellValue)) {
                                $dateObject = Date::excelToDateTimeObject($cellValue);
                                $formattedDate = $dateObject->format('Y-m-d');
                                $data[] = $formattedDate;
                            } else {
                                $data[] = $cellValue;
                            }
                        } else {
                            $data[] = $cellValue;
                        }
                    }



                    // Mengisi kolom yang kosong dengan null kecuali kolom 'id'
                    for ($i = 0; $i < count($data); $i++) {
                        // Kolom 'id' tidak diisi dengan null
                        if ($i === 0) {
                            continue;
                        }

                        // Jika nilai sel kosong, isi dengan null
                        if (empty($data[$i])) {
                            $data[$i] = null;
                        }
                    }

                    // Cek apakah kombinasi mperlan_H04-H05 dan npwp_A1 sudah ada di database
                    $existingData = $this->dataModel->builder->getWhere([
                        'mperlan_H04-H05' => $data[3],
                        'npwp_A1' => $data[4],
                    ])->getRow();

                    $existingDataStatus = $this->dataModel->builderStatus->getWhere([
                        'mperlan_H04-H05' => $data[3],
                        'npwp_A1' => $data[4],
                    ])->getRow();

                    if ($existingData || $existingDataStatus) {
                        // Jika data sudah ada, tambahkan ke jumlah data yang gagal
                        $failureCount++;
                        $failedData[] = ['npwp' => $data[4], 'mperlan_H04-H05' => $data[3]];
                        continue; // Lewati iterasi ini dan lanjutkan ke data berikutnya
                    }

                    $this->dataModel->builder->insert([
                        'no_H01' => $data[0],
                        'spt_H02' => $data[1] ?: 0,
                        'pembatalan_H03' => $data[2] ?: 0,
                        'mperlan_H04-H05' => $data[3],
                        'npwp_A1' => $data[4],
                        // 'nip_A2' => number_format($data[5], 0, '', ''),  // Ubah format mnjdi string
                        'nip_A2' => $data[5],  // Ubah format mnjdi string
                        'nama_A3' => $data[6],
                        'pangkat_A4' => $data[7],
                        'tgl_lahir' => date('Y-m-d', strtotime($data[8])),
                        'nama_jabatan_A5' => $data[9],
                        'jenis_kelamin_A6' => $data[10],
                        'nik_A7' => $data[11],
                        'status_A8' => $data[12],
                        'kd_pajak' => $data[13],
                        'gaji_pokok' => $data[14],
                        'tj_istri' => $data[15],
                        'tj_anak' => (int)($data[16] ?: 0),
                        'jml_gaji' => (int)($data[17] ?: 0),
                        'tj_perbaikan' => (int)($data[18] ?: 0),
                        'tj_struktural' => (int)($data[19] ?: 0),
                        'tj_beras' => (int)$data[20],
                        'jml_bruto_1' => (int)$data[21],
                        'tj_lain' => (int)($data[22] ?: 0),
                        'ph_tetap' => (int)($data[23] ?: 0),
                        'jml_bruto_2' => (int)($data[24] ?: 0),
                        'biaya_jabatan' => (int)($data[25] ?: 0),
                        'iuran_pensiun' => (int)($data[26] ?: 0),
                        'jml_pengurangan' => (int)($data[27] ?: 0),
                        'jml_ph' => (int)($data[28] ?: 0),
                        'ph_neto' => (int)($data[29] ?: 0),
                        'jml_ph_neto' => (int)($data[30] ?: 0),
                        'ptkp' => (int)($data[31] ?: 0),
                        'ph_kena_pajak' => (int)($data[32] ?: 0),
                        'pph_ph' => (int)($data[33] ?: 0),
                        'pph_potong' => (int)($data[34] ?: 0),
                        'pph_utang' => (int)($data[35] ?: 0),
                        'atas_gaji_23A' => (int)($data[36] ?: 0),
                        'atas_ph_23B' => (int)($data[37] ?: 0),
                        'status_pegawai' => $data[38] ?: null,
                    ]);

                    $this->dataModel->builderStatus->insert([
                        'mperlan_H04-H05' => $data[3],
                        'npwp_A1' => $data[4],
                    ]);

                    // Tambahkan ke jumlah data yang berhasil
                    $successCount++;
                }

                // Setelah berhasil mengunggah file
                $message = 'File Excel berhasil diunggah';
                if ($failureCount > 0) {
                    $message .= " dengan $failureCount data gagal.";
                }

                // session()->setFlashdata('success', $message);
                // session()->setFlashdata('failureCount', $failureCount);
                // session()->setFlashdata('failedData', $failedData);

                return $this->response->setJSON(['status' => 'success', 'message' => $message, 'successCount' => $successCount, 'failureCount' => $failureCount, 'failedData' => $failedData]);
            } catch (\Exception | \Throwable $e) {
                // Handle kesalahan jika terjadi
                log_message("info", 'Terjadi kesalahan: ' . print_r($e->getMessage(), true));
                session()->setFlashdata('error', 'Terjadi kesalahan: ' . $e->getMessage());
                return $this->response->setJSON(['status' => 'error', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()]);
            }
        }
    }
    public function fetchData($year)
    {
        log_message("info", "year:" . print_r($year, true));
        // Ambil data dari tabel tb_sijak berdasarkan tahun
        $data = $this->dataModel->getDataByYear($year);
        // log_message("info", "data:". print_r($data,true));

        // Kembalikan data sebagai respons
        return $this->response->setJSON($data);
    }
}
