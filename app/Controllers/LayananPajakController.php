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
        $birthDate = $this->request->getPost('birthDate');

        $fileUpload = $this->request->getFile('unggahFile');

        // Validasi apakah file diunggah atau tidak
        if (!$fileUpload->isValid()) {
            return redirect()->to(site_url('/layanan-pajak'))->with('error', 'Mohon unggah file terlebih dahulu.');
        }

        // Validasi ukuran dan jenis file
        $validationRule = [
            'unggahFile' => [
                'label' => 'File',
                'rules' => [
                    'uploaded[unggahFile]',
                    'max_size[unggahFile,10240]', // 10 MB
                    'ext_in[unggahFile,pdf,jpg,jpeg,gif,png,webp]' // Validasi ekstensi file
                ],
            ],
        ];

        if (!$this->validate($validationRule)) {
            $data = ['errors' => $this->validator->getErrors()];
            return redirect()->to(site_url('/pembatalan'))->with('error', 'Terjadi Kesalahan: ' . implode(', ', $data['errors']));
        }

        $fileExtension = $fileUpload->getClientExtension();
        $dataPegawai = $this->HomeModel->getUserData($npwp, $birthDate, $yearOption);

        if (!$dataPegawai) {
            return redirect()->to(site_url('/layanan-pajak'))->with('error', 'Data tidak ditemukan.');
        }

        $nama = $dataPegawai->nama_A3;
        log_message("info", "data: " . print_r($dataPegawai, true));
        // $file = $dataPegawai -> file_bukti_bayar;

        // Tentukan folder penyimpanan berdasarkan ekstensi file
        $folderPath = FCPATH . 'FileUpload/BuktiPembayaranPajak/';
        if (in_array($fileExtension, ['jpg', 'jpeg', 'gif', 'png', 'webp'])) {
            $folderPath .= 'img/';
        } elseif ($fileExtension === 'pdf') {
            $folderPath .= 'pdf/';
        }

        // Nama file baru
        $fileName = $npwp . "_" . $nama . "_" . $yearOption . '.' . $fileExtension;
        // $removeFile= $folderPath . $file;
        // Path lengkap file baru
        $filePath = $folderPath . $fileName;

        // Cek apakah file lama sudah ada, dan hapus jika ada
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        if ($fileUpload->isValid()) {
            $fileUpload->move($folderPath, $fileName);

            //cek apakah file telah dipindahkan
            if ($fileUpload->hasMoved()) {
                log_message("info", "File has moved");

                // Update data pada database
                $dataToUpdate = [
                    'status_bukti_bayar' => '1',
                    'file_bukti_bayar' => $fileName,
                ];

                // Panggil method updateDataByNpwp untuk melakukan update
                $affectedRows = $this->DataModel->updateDataByNpwp($npwp, $dataToUpdate);
                log_message("info", "affectedRows: " . $affectedRows);

                // Update berhasil
                return redirect()->to(site_url('/layanan-pajak'))->with('success', 'File berhasil diunggah.');
            } else {
                log_message("info", "File has not moved");
                // Terjadi kesalahan saat mengupdate data atau data tidak ditemukan
                return redirect()->to(site_url('/layanan-pajak'))->with('error', 'Terjadi kesalahan saat mengupdate data atau data tidak ditemukan.');
            }
        } else {
            // Terjadi kesalahan saat mengunggah file
            return redirect()->to(site_url('/layanan-pajak'))->with('error', 'Terjadi kesalahan saat mengunggah file.');
        }

    }


}