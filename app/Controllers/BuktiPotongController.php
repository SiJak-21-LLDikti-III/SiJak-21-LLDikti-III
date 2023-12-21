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
        return view('pages/buktipotong');
    }
    public function uploadExcel()
    {
        $file = $this->request->getFile('excel_file');
        // log_message("info", "type: " . print_r($type, true));
        if ($file->isValid() && in_array($file->getClientExtension(), ['xls', 'xlsx'])) {
            try {
                // Baca file Excel
                $spreadsheet = IOFactory::load($file->getPathname());

                // Ambil sheet pertama (asumsi data ada di sheet pertama)
                $worksheet = $spreadsheet->getActiveSheet();

                // Loop melalui baris-baris data
                foreach ($worksheet->getRowIterator(2) as $row) {
                    $cellIterator = $row->getCellIterator();
                    $cellIterator->setIterateOnlyExistingCells(false); // Memungkinkan iterasi sel kosong juga

                    $data = [];
                    foreach ($cellIterator as $cell) {
                        $data[] = $cell->getValue();
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

                    // // Misalkan $originalDate adalah tanggal dalam format Excel (sebagai angka)
                    // $tanggal_lahir = $data[15];
                    // $tanggal_ditetapkan = $data[40];

                    // // Ubah format tanggal ke timestamp Unix
                    // $tanggal_lahirFormat = Date::excelToTimestamp($tanggal_lahir);
                    // $tanggal_ditetapkanFormat = Date::excelToTimestamp($tanggal_ditetapkan);

                    // // Ubah timestamp menjadi format tanggal 'Y-m-d'
                    // $formattedDatetglLahir = date('Y-m-d', $tanggal_lahirFormat);
                    // $formattedDateDitetapkan = date('Y-m-d', $tanggal_ditetapkanFormat);
                    // dd($formattedDate);
                    // dd($data[40]);
                    // dd($data[15]);

                    // Sesuaikan data dengan kolom-kolom yang sesuai di tabel 'tb_akm'
                    $this->dataModel->builder->insert([
                        'no' => $data[0],
                        'tahun' => date('Y-m-d', strtotime($data[1])), // Ubah format tanggal sesuai dengan skema tabel
                        'npwp' => $data[2],
                        'nip' => $data[3],
                        'nama' => $data[4],
                        'pangkat' => $data[5],
                        'nama_jabatan' => $data[6],
                        'nik' => $data[7],
                        'gaji' => $data[8],
                        'tj_istri' => $data[9],
                        'tj_anak' => $data[10] ?: null,
                        'jml_gaji' => $data[11],
                        'tj_perbaikan' => $data[12] ?: null,
                        'tj_struktural' => $data[13],
                        'tj_beras' => $data[14],
                        'jml_bruto_1' => $data[15],
                        'tj_lain' => $data[16] ?: null,
                        'ph_tetap' => $data[17],
                        'jml_bruto_2' => $data[18],
                        'biaya_jabatan' => $data[19],
                        'iuran_pensiun' => $data[20],
                        'jml_pengurangan' => $data[21],
                        'jml_ph' => $data[22],
                        'ph_neto' => $data[23] ?: null,
                        'jml_ph_neto' => $data[24],
                        'ptktp' => $data[25],
                        'ph_kena_pajak' => $data[26],
                        'pph_ph' => $data[27],
                        'pph_potong' => $data[28],
                        'pph_utang' => $data[29],
                        'pph_potong_lunas' => $data[30] ?: null,
                        'atas_gaji' => $data[31] ?: null,
                        'atas_ph' => $data[32] ?: null,
                    ]);
                }

                // Selanjutnya, Anda dapat melakukan operasi dengan $spreadsheet
                return redirect()->to(site_url('/'))->with('success', 'File Excel berhasil diunggah');
            } catch (\Exception $e) {
                // Handle kesalahan jika terjadi
                return redirect()->to(site_url('/'))->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
            }
        } else {
            // Handle kesalahan jika file tidak valid
            return redirect()->to(site_url('/'))->with('error', 'File yang diunggah harus berformat .xls atau .xlsx');
        }
    }
}
