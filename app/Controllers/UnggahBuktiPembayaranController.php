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
      $dataFile = $this->request->getPost();
      log_message("info", "data yang diterima dari client : " . print_r($dataFile, true));

      $fileUpload = $this->request->getFile('unggahFile');
      $validationRule = [
         'unggahFile' => [
            'label' => 'File',
            'rules' => [
               'uploaded[unggahFile]',
               'mime_in[unggahFile,application/pdf,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
               'max_size[unggahFile,10240]', // 10 MB
            ],
         ],
      ];

      if (!$this->validate($validationRule)) {
         $data = ['errors' => $this->validator->getErrors()];
         return redirect()->to(site_url('/pembatalan'))->with('error', 'Terjadi Kesalahan: ' . implode(', ', $data['errors']));
      }

      $fileExtension = $fileUpload->getClientExtension();
      $npwp = '123123'; // Gantilah dengan cara mendapatkan NPWP dari data yang sesuai
      $nama = 'test'; // Gantilah dengan cara mendapatkan nama dari data yang sesuai
      $tahun = 'test'; // Gantilah dengan cara mendapatkan nama dari data yang sesuai
      $fileName = $npwp . "_" . date('Y') . '.' . $fileExtension;
      $filePath = FCPATH . 'FileUpload/BuktiPembayaranPajak/' . $fileExtension . '/' . $fileName;

      if ($fileUpload->isValid() && !$fileUpload->hasMoved()) {
         $fileUpload->move($fileExtension, $fileName);

         // Lakukan apa yang diperlukan dengan file yang sudah diunggah
         // Misalnya, simpan data ke database atau lakukan proses lainnya

         log_message("info", "File berhasil diunggah: " . $fileName);
        redirect()->back()->with('success', 'File berhasil diunggah: ' . $fileName);
      } else {
        redirect()->back()->with('error', 'Terjadi kesalahan saat mengunggah file.');
      }
   }


}
