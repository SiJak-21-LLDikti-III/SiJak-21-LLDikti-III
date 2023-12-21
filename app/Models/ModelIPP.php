<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelIPP extends Model
{
    protected $table   = 'tb_identitas';
    protected $builder;
    protected $columnNames = [];
    protected $allowedFields = ['npwp', 'nama_instansi', 'id_sub_unit', 'tanggal', 'nama'];


    public function __construct()
    {
        parent::__construct();
        $this->builder = $this->db->table('tb_identitas');
        $this->columnNames = $this->getTableColumns('tb_identitas');
    }
}
