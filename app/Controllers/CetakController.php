<?php

namespace App\Controllers;

use App\Models\CetakModel;

class CetakController extends BaseController
{
    public function index()
    {
        require_once __DIR__ . '/vendor/autoload.php';
        $mpdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'margin_left' => 12, 7,
            'margin_right' => 12, 7,
            'margin_top' => 17, 8,
            'margin_bottom' => 17, 8,
            'orientation' => 'P'
        ]);
        $mpdf->WriteHTML('<h1>Hello world!</h1>');
        $mpdf->Output();
        return view('pages/cetak');
    }
}
