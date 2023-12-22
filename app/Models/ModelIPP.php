<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelIPP extends Model
{
    protected $table   = 'tb_identitas';
    protected $builder;
    protected $columnNames = [];
    protected $allowedFields = ['npwp', 'nama_instansi', 'id_sub_unit', 'tanggal', 'nama_penandatangan'];


    public function __construct()
    {
        parent::__construct();
        $this->builder = $this->db->table('tb_identitas');
    }

    
}
