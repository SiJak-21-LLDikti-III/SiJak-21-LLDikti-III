<?php

namespace App\Controllers;

class HomeController extends BaseController
{
    public function index(): string
    {
        $data = [
            'title' => 'Layanan Pemotongan Pajak Penghasilan LLDIkti III',
        ];
        return view('pages/home',$data);
    }
}
