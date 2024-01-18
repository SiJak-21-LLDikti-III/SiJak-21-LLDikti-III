<?php

namespace App\Controllers;

use App\Models\DataModel;

class DashboardAdminController extends BaseController
{
    public $dataModel;
    public function index()
    {
        $dataModel = new DataModel();
        $data = [
            'title' => 'Admin - Layanan Pemotongan Pajak Penghasilan LLDikti III',
            'count_data' => $dataModel->getCountData(),
            'count_data_status_unduh' => $dataModel->getCountData_StatusUnduh(),
            'count_data_status_unggah' => $dataModel->getCountData_StatusUnggah(),
        ];
        return view('pages/dashboard', $data);
    }
}
