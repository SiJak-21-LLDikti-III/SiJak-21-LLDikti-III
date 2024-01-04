<?php

namespace App\Controllers;

use App\Models\HomeModel;

class LayananPajakController extends BaseController
{
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
}
