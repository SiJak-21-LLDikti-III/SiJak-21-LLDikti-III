<?php

namespace App\Controllers;
use App\Controllers\CetakController;

class LayananPajakController extends BaseController
{
    public function index()
    {
        return view('pages/layananpajak');
    }
    public function unduh() {
        //ambil dari cetakcontroller
    }
    public function upload() {
    }
}