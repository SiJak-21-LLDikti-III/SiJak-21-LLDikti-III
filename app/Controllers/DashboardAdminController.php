<?php

namespace App\Controllers;

class DashboardAdminController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Admin - Layanan Pemotongan Pajak Penghasilan LLDikti III',
        ];
        return view('pages/dashboard', $data);
    }
}
