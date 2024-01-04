<?php

namespace App\Controllers;

class LayananPajakController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Layanan Pemotongan Pajak Penghasilan LLDikti III',
        ];
        return view('pages/layananpajak', $data);
    }
    public function unduh($npwp, $BirthDate, $yearOption) //biasa
    {

        $data = [
            'title' => 'Cetak',
        ];
        log_message("info", "data: " . print_r($npwp, true));
        return view('pages/templateV2', $data);
    }
}
