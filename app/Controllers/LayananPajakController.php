<?php

namespace App\Controllers;

use App\Models\HomeModel;
use App\Models\DataModel;


class LayananPajakController extends BaseController
{
    protected $HomeModel;
    protected $DataModel;

    public function __construct()
    {
        $this->HomeModel = new HomeModel();
        $this->DataModel = new DataModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Layanan Pemotongan Pajak Penghasilan LLDikti III',
        ];
        return view('pages/layananpajak', $data);
    }
    public function unduh($npwp, $birthDate, $yearOption) //biasa
    {
        $HomeModel = new HomeModel();
        $userData = $HomeModel->getUserData($npwp, $birthDate, $yearOption);
        $IDPP = $HomeModel->getIDPP();
        log_message('info', 'data: ' . print_r($IDPP, true));
        $data = [
            'title' => 'Layanan Pemotongan Pajak Penghasilan LLDikti III',
            'user' => $userData,
            'IDPP' => $IDPP
        ];
        return view('pages/templateV2', $data);
    }
    public function unggah()
    {
        // Mendapatkan nilai dari parameter npwp dan tahun dari URL
        $npwp = $this->request->getPost('npwp');
        $yearOption = $this->request->getPost('yearOption');
        $birthDate= $this->request->getPost('birthDate');

        // log_message("info", "npwp: " . print_r($npwp, true));
        // log_message("info", "tahun: " . print_r($yearOption, true));



        $fileUpload = $this->request->getFile('unggahFile');

        $validationRule = [
            'unggahFile' => [
                'label' => 'File',
                'rules' => [
                    'uploaded[unggahFile]',
                    'max_size[unggahFile,10240]', // 10 MB
                ],
            ],
        ];

        if (!$this->validate($validationRule)) {
            $data = ['errors' => $this->validator->getErrors()];
            return redirect()->to(site_url('/pembatalan'))->with('error', 'Terjadi Kesalahan: ' . implode(', ', $data['errors']));
        }

        $fileExtension = $fileUpload->getClientExtension();
        $dataPegawai= $this->HomeModel->getUserData($npwp, $birthDate, $yearOption);
        // log_message("info", "dataPegawai: " . print_r($dataPegawai, true));

        $nama = $dataPegawai->nama_A3;
        // log_message("info", "nama: " . print_r($nama, true));

        // Tentukan folder penyimpanan berdasarkan ekstensi file
        $folderPath = FCPATH . 'FileUpload/BuktiPembayaranPajak/';
        if (in_array($fileExtension, ['jpg', 'jpeg', 'gif', 'png', 'webp'])) {
            $folderPath .= 'img/';
        } elseif ($fileExtension === 'pdf') {
            $folderPath .= 'pdf/';
        }

        $fileName = $npwp . "_" . $nama . "_" . $yearOption . '.' . $fileExtension;

        if ($fileUpload->isValid() && !$fileUpload->hasMoved()) {
            $fileUpload->move($folderPath, $fileName);

            // Lakukan apa yang diperlukan dengan file yang sudah diunggah
            // Misalnya, simpan data ke database atau lakukan proses lainnya
            // melakukan update
            $dataToUpdate = [
                'status_bukti_bayar' => 'sudah diunggah',
                'file_bukti_bayar' => $fileName,
            ];

            // Panggil method updateDataByNpwp untuk melakukan update
            $affectedRows = $this->DataModel->updateDataByNpwp($npwp, $dataToUpdate);

            if ($affectedRows > 0) {
                // Update berhasil
                // log_message("info", "File berhasil diunggah: " . $fileName);
                return redirect()->to(site_url('/layanan-pajak'))->with('success', 'File berhasil diunggah.');
            } else {
                // Update gagal atau data tidak ditemukan
                return redirect()->to(site_url('/layanan-pajak'))->with('error', 'Terjadi kesalahan saat mengupdate data atau data tidak ditemukan.');
            }

        } else {
            // return $this->response->setJSON(['status' => 'error', 'message' => 'Terjadi kesalahan saat mengunggah file.']);
            return redirect()->to(site_url('/layanan-pajak'))->with('error', 'Terjadi kesalahan saat mengunggah file.');
        }
    }

}
