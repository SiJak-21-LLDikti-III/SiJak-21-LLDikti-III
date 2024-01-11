<?php

namespace App\Controllers;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use App\Models\DataModel;

class EditBuktiPotongController extends BaseController
{
    private $dataModel;


    public function __construct()
    {
        $this->dataModel = new DataModel();
    }
    public function index()
    {
        $dataTable = $this->dataModel->getAllDataTable();
        $data = [
            'title' => 'Admin - Edit Bukti Potong',
            'dataTable' => $dataTable
        ];
        // log_message("info", "data: " . print_r($data['dataTable'], true));
        return view('pages/editbuktipotong', $data);
    }
}