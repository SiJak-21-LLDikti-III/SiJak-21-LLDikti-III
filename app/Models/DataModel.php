<?php

namespace App\Models;

use CodeIgniter\Model;

class DataModel extends Model
{
    protected $table   = 'tb_sijak';
    protected $builder;
    protected $columnNames = [];


    public function __construct()
    {
        parent::__construct();
        $this->builder = $this->db->table('tb_sijak');
        $this->columnNames = $this->getTableColumns('tb_sijak');
    }

    public function getAllDataTable()
    {
        return $this->db->table($this->table)->get()->getResult();
    }

    public function getTableColumns($tableName)
    {
        $query = $this->db->table('INFORMATION_SCHEMA.COLUMNS')
            ->select('COLUMN_NAME')
            ->where('TABLE_NAME', $tableName)
            ->get();

        return $query->getResultArray();
    }
    public function getDataByYear($year)
    {
        // Tambahkan logika untuk mengambil data dari tabel tb_sijak berdasarkan tahun
        $result = $this->db->table('tb_sijak')->where('YEAR(tahun)', $year)->get()->getResult();

        return $result;
    }


}
