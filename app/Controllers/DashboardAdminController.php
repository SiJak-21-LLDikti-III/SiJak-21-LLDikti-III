<?php

namespace App\Controllers;

class DashboardAdminController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Admin - Layanan Pemotongan Pajak Penghasilan LLDIkti III',
        ];
        return view('pages/dashboard',$data);
    }

}