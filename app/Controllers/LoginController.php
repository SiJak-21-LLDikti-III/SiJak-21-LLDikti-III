<?php

namespace App\Controllers;

class LoginController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Login - Layanan Pemotongan Pajak Penghasilan LLDikti III',
        ];
        return view('pages/login', $data);
    }
}
