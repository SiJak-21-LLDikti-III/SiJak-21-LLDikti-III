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
    public function index($id)
    {
        $dataTable = $this->dataModel->getDataTableByID($id);
        $data = [
            'title' => 'Admin - Edit Bukti Potong',
            'data' => $dataTable
        ];
        // log_message("info", "data: " . print_r($data['dataTable'], true));
        return view('pages/editbuktipotong', $data);
    }
}
