<?php

namespace App\Controllers;

use App\Controllers\CetakController;

class LayananPajakController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Layanan Pemotongan Pajak Penghasilan LLDikti III',
        ];
        return view('pages/layananpajak', $data);
    }
    public function upload()
    {
    }
}
