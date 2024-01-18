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
        log_message('info',"data bukti potong :".print_r($dataTable,true));
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

                    $this->dataModel->builder->insert([
                        'no_H01' => $data[0],
                        'spt_H02' => $data[1],
                        'mperlan_H04-H05' => $data[2],
                        'npwp_A1' => $data[3],
                        'nip_A2' => $data[4],
                        'nama_A3' => $data[5],
                        'pangkat_A4' => $data[6],
                        'tgl_lahir' => date('Y-m-d', strtotime($data[7])),
                        'nama_jabatan_A5' => $data[8],
                        'jenis_kelamin_A6' => $data[9],
                        'nik_A7' => $data[10],
                        'status_A8' => $data[11],
                        'kd_pajak' => $data[12],
                        'gaji_pokok' => $data[13],
                        'tj_istri' => $data[14],
                        'tj_anak' => (int)($data[15] ?: 0),
                        'jml_gaji' => (int)($data[16] ?: 0),
                        'tj_perbaikan' => (int)($data[17] ?: 0),
                        'tj_struktural' => (int)($data[18] ?: 0),
                        'tj_beras' => (int)$data[19],
                        'jml_bruto_1' => (int)$data[20],
                        'tj_lain' => (int)($data[21] ?: 0),
                        'ph_tetap' => (int)($data[22] ?: 0),
                        'jml_bruto_2' => (int)($data[23] ?: 0),
                        'biaya_jabatan' => (int)($data[24] ?: 0),
                        'iuran_pensiun' => (int)($data[25] ?: 0),
                        'jml_pengurangan' => (int)($data[26] ?: 0),
                        'jml_ph' => (int)($data[27] ?: 0),
                        'ph_neto' => (int)($data[28] ?: 0),
                        'jml_ph_neto' => (int)($data[29] ?: 0),
                        'ptkp' => (int)($data[30] ?: 0),
                        'ph_kena_pajak' => (int)($data[31] ?: 0),
                        'pph_ph' => (int)($data[32] ?: 0),
                        'pph_potong' => (int)($data[33] ?: 0),
                        'pph_utang' => (int)($data[34] ?: 0),
                        // 'pph_potong_lunas' => (int)($data[35] ?: 0),
                        // 'atas_gaji_23A' => (int)($data[36] ?: 0),
                        // 'atas_ph_23B' => (int)($data[37] ?: 0),
                        'status_pegawai' => $data[35] ?: '0', // Jika status_pegawai bertipe varchar, ganti '0' menjadi nilai default yang sesuai
                    ]);

                    $this->dataModel->builderStatus->insert([
                        'npwp' => $data[3],
                    ]);

                }

                // Setelah berhasil mengunggah file
                return $this->response->setJSON(['status' => 'success', 'message' => 'File Excel berhasil diunggah']);
            } catch (\Exception | \Throwable $e) {
                // Handle kesalahan jika terjadi
                log_message("info", 'Terjadi kesalahan: ' . print_r($e->getMessage(), true));
                return $this->response->setJSON(['status' => 'error', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()]);
            }
        }
    }
    public function fetchData($year)
    {
        log_message("info", "year:". print_r($year,true));
        // Ambil data dari tabel tb_sijak berdasarkan tahun
        $data = $this->dataModel->getDataByYear($year);
        // log_message("info", "data:". print_r($data,true));

        // Kembalikan data sebagai respons
        return $this->response->setJSON($data);
    }

}
