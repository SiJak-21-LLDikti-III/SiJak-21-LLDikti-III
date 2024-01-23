<?php

namespace App\Controllers;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use App\Models\DataModel;

class EditBuktiPotongController extends BaseController
{
    private $dataModel;


    public function __construct()
    {
        $this->dataModel = new DataModel();
    }
    public function index($id)
    {
        $dataTable = $this->dataModel->getDataTableByID($id);
        $data = [
            'title' => 'Admin - Edit Bukti Potong',
            'data' => $dataTable
        ];
        // log_message("info", "data: " . print_r($data['data'], true));
        return view('pages/editbuktipotong', $data);
    }

    public function update($id)
    {
        // Ambil data dari formulir
        $data = $this->request->getPost();
        log_message("info", "data: " . print_r($data, true));

        $dataStatus=[
            'mperlan_H04-H05' => $data['mperlan_H04-H05'],
            'npwp_A1' => $data['npwp_A1'],
        ];

        // Lakukan update data
        $result = $this->dataModel->updateData($id, $data);
        $updateStatus = $this->dataModel->updateDataStatus($id, $dataStatus);
        
        //cetak hasil error
        log_message("info", "hasil update: " . print_r($result, true));

        // Periksa apakah update berhasil
        if ($result >= 1 && $updateStatus >= 1) {
            // Kirim tanggapan sukses ke JavaScript
            log_message("info", "data berhasil diupdate");
            return $this->response->setJSON(['status' => 'success', 'message' => 'Data Berhasil Diperbarui']);
        } else {
            // Jika update gagal, kirim tanggapan kesalahan ke JavaScript bersama dengan pesan kesalahan
            log_message("info", "data gagal diupdate");
            return $this->response->setJSON(['status' => 'error', 'message' => $result['error']]);
        }
    }


    public function delete($id)
    {
        // Buat instance dari model
        $dataModel = new DataModel();
        $npwp = $this->request->getPost('npwp');

        // Lakukan penghapusan data
        $deleted = $dataModel->deleteData($id,$npwp);

        // Periksa apakah penghapusan berhasil
        if ($deleted) {
            // Kirim tanggapan sukses ke JavaScript
            return $this->response->setJSON(['status' => 'success', 'message' => 'Data berhasil dihapus']);
        } else {
            // Jika penghapusan gagal, kirim tanggapan kesalahan ke JavaScript bersama dengan pesan kesalahan
            return $this->response->setJSON(['status' => 'error', 'message' => $dataModel->error]);
        }
    }





}
