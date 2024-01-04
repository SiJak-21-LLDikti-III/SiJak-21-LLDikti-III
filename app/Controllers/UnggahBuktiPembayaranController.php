<?php

namespace App\Controllers;

use App\Models\dataModel;
use CodeIgniter\Files\File;


class UnggahBuktiPembayaranController extends BaseController
{
   private $dataModel;

   public function __construct()
   {
      $this->dataModel = new dataModel();
   }
   public function index()
   {

      // Mengambil nilai dari parameter npwp dan tahun dari URL
      $npwp = $this->request->getGet('npwp');
      $tahun = $this->request->getGet('yearOption');
      
      log_message("info", "npwp: " . print_r($npwp,true));
      log_message("info", "tahun: " . print_r($tahun,true));
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
      // $npwp = '123123'; // Gantilah dengan cara mendapatkan NPWP dari data yang sesuai
      $nama = 'test'; // Gantilah dengan cara mendapatkan nama dari data yang sesuai
      // $tahun = 'test'; // Gantilah dengan cara mendapatkan nama dari data yang sesuai

      // Tentukan folder penyimpanan berdasarkan ekstensi file
      $folderPath = FCPATH . 'FileUpload/BuktiPembayaranPajak/';
      if (in_array($fileExtension, ['jpg', 'jpeg', 'gif', 'png', 'webp'])) {
         $folderPath .= 'img/';
      } elseif ($fileExtension === 'pdf') {
         $folderPath .= 'pdf/';
      }

      $fileName = $npwp . "_" . $nama . "_" . $tahun . '.' . $fileExtension;

      if ($fileUpload->isValid() && !$fileUpload->hasMoved()) {
         $fileUpload->move($folderPath, $fileName);

         // Lakukan apa yang diperlukan dengan file yang sudah diunggah
         // Misalnya, simpan data ke database atau lakukan proses lainnya

         log_message("info", "File berhasil diunggah: " . $fileName);
         // return redirect()->to(site_url('/layanan-pajak'))->with('success', 'File berhasil diunggah: ' . $fileName);
         return $this->response->setJSON(['status' => 'success', 'message' => 'File berhasil diunggah '. $fileName]);
      } else {
         // return redirect()->back()->with('error', 'Terjadi kesalahan saat mengunggah file.');
         return $this->response->setJSON(['status' => 'success', 'message' => 'Terjadi kesalahan ' . $fileName]);

      }
   }



}
