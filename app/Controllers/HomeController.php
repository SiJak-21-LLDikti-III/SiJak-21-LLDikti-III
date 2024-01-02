<?php

namespace App\Controllers;

use App\Models\HomeModel;

class HomeController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Layanan Pemotongan Pajak Penghasilan LLDikti III',
        ];
        return view('pages/home', $data);
    }
    public function checkData()
    {
        $npwp = $this->request->getVar('npwp');
        $birthDate = $this->request->getVar('birth'); // format YYYY-MM-DD

        // Validasi input (Optional: tambahkan validasi lebih lanjut sesuai kebutuhan)

        $HomeModel = new HomeModel();
        $userData = $HomeModel->getUserData($npwp, $birthDate);

        if ($userData) {
            // Data ditemukan
            return $this->response->setJSON($userData);
        } else {
            // Data tidak ditemukan
            return $this->response->setStatusCode(404)->setJSON(['message' => 'Data tidak ditemukan']);
        }
    }
}
