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
        $npwp = $this->request->getGet('npwp');
        $BirthDate = $this->request->getGet('birth');
        $data = [
            'title' => 'Cetak',
        ];
        $mpdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'margin_left' => 12, 7,
            'margin_right' => 12, 7,
            'margin_top' => 17, 8,
            'margin_bottom' => 17, 8,
            'orientation' => 'P'
        ]);
        $mpdf->SetWatermarkImage('skydash-template/images/watermark.png', 2);
        $mpdf->showWatermarkImage = true;
        $mpdf->SetAuthor(base64_decode('QXJpemtpIFB1dHJhIFJhaG1hbg=='));
        $mpdf->SetCreator(base64_decode('QXJpemtpIFB1dHJhIFJhaG1hbg=='));
        $mpdf->SetSubject('Cetak Telaah dari Sistem Rekam Jejak Perguruan Tinggi');
        $mpdf->SetTitle(base64_decode('Rm9ybSAyIDogVGVsYWFoIFJla2FtIEplamFr'));
        $mpdf->SetKeywords(base64_decode('UFQsIFlheWFzYW4sIFRlbGFhaCwgUERGLCBTaVJlSmFr'));
        $html = view('pages/template', $data);
        $mpdf->WriteHTML($html);
        $mpdf->Output('Cetak.pdf', 'I');
        exit();
    }
    public function unduh() //biasa
    {
        $npwp = $this->request->getGet('npwp');
        $BirthDate = $this->request->getGet('birth');
        $data = [
            'title' => 'Cetak',
        ];
        return view('pages/templateV2', $data);
    }
}
