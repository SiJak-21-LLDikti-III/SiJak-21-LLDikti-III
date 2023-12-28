<?php

namespace App\Controllers;

use App\Models\CetakModel;

class CetakController extends BaseController
{
    protected $CetakModel;
    public function __construct()
    {
        $this->CetakModel = new CetakModel();
    }
    public function index() //unduh mpdf
    {
        $data = [
            'title' => 'Cetak',
        ];
        $mpdf = new \Mpdf\Mpdf([
            'format' => 'A4',
            'margin_left' => 12, 7,
            'margin_right' => 12, 7,
            'margin_top' => 17, 8,
            'margin_bottom' => 17, 8,
            'orientation' => 'P'
        ]);
        $mpdf->SetWatermarkImage('skydash-template/images/watermark.png', 2);
        $mpdf->showWatermarkImage = true;
        $html = view('pages/template', $data);
        $mpdf->WriteHTML($html);
        $mpdf->Output('Cetak.pdf', 'I');
    }
    public function unduh() //biasa
    {
        $data = [
            'title' => 'Cetak',
        ];
        return view('pages/templateV2', $data);
    }
}
