<?php

namespace App\Controllers;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use App\Models\dataModel;

class BuktiPotongController extends BaseController
{
    private $dataModel;


    public function __construct()
    {
        $this->dataModel = new dataModel();
    }
    public function index()
    {
        $dataTable = $this->dataModel->getAllDataTable();
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

                    // Sesuaikan data dengan kolom-kolom yang sesuai di tabel 'tb_akm'
                    $this->dataModel->builder->insert([
                        'no' => $data[0],
                        'tahun' => date('Y-m-d', strtotime($data[1])),
                        'npwp' => $data[2],
                        'nip' => $data[3],
                        'nama' => $data[4],
                        'tgl_lahir' => $data[5],
                        'pangkat' => $data[6],
                        'nama_jabatan' => $data[7],
                        'nik' => $data[8],
                        'gaji' => $data[9],
                        'tj_istri' => $data[10],
                        'tj_anak' => $data[11] ?: null,
                        'jml_gaji' => $data[12],
                        'tj_perbaikan' => $data[13] ?: null,
                        'tj_struktural' => $data[14],
                        'tj_beras' => $data[15],
                        'jml_bruto_1' => $data[16],
                        'tj_lain' => $data[17] ?: null,
                        'ph_tetap' => $data[18],
                        'jml_bruto_2' => $data[19], // Sesuaikan dengan field migrasi yang benar
                        'biaya_jabatan' => $data[20],
                        'iuran_pensiun' => $data[21],
                        'jml_pengurangan' => $data[22],
                        'jml_ph' => $data[23],
                        'ph_neto' => $data[24] ?: null,
                        'jml_ph_neto' => $data[25],
                        'ptktp' => $data[26],
                        'ph_kena_pajak' => $data[27],
                        'pph_ph' => $data[28],
                        'pph_potong' => $data[29],
                        'pph_utang' => $data[30],
                        'pph_potong_lunas' => $data[31] ?: null,
                        'atas_gaji' => $data[32] ?: null,
                        'atas_ph' => $data[33] ?: null,
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
        // Ambil data dari tabel tb_sijak berdasarkan tahun
        $data = $this->dataModel->getDataByYear($year);
        log_message("info", "data:". print_r($data,true));

        // Kembalikan data sebagai respons
        return $this->response->setJSON($data);
    }
}
