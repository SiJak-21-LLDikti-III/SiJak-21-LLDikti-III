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
        $npwp = $this->request->getPost('npwp');
        $birthDate = $this->request->getPost('birth'); // format YYYY-MM-DD
        $yearOption = $this->request->getPost('yearOption');
        // log_message('info', $npwp . ' | ' . $birthDate . ' | ' . $yearOption);
        $HomeModel = new HomeModel();
        $userData = $HomeModel->getUserData($npwp, $birthDate, $yearOption);
        // log_message('info', print_r($userData, true));
        if ($userData) {
            // Data ditemukan
            return $this->response->setJSON($userData);
        } else {
            // Data tidak ditemukan
            return $this->response->setStatusCode(404)->setJSON(['message' => 'Data tidak ditemukan']);
        }
    }
}
