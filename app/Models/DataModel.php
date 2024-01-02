<?php

namespace App\Models;

use CodeIgniter\Model;

class DataModel extends Model
{
    protected $table   = 'tb_sijak';
    protected $tableStatus   = 'tb_status';
    protected $builder;
    protected $builderStatus;
    protected $columnNames = [];


    public function __construct()
    {
        parent::__construct();
        $this->builder = $this->db->table('tb_sijak');
        $this->builderStatus = $this->db->table('tb_status');
        $this->columnNames = $this->getTableColumns('tb_sijak');
    }

    public function getAllDataTable()
    {
        // return $this->db->table($this->table)->get()->getResult();
        $this->builder->select('tb_sijak.*, tb_status.*'); // Gantilah 'status_field' dengan nama kolom yang sesuai
        $this->builder->join('tb_status', 'tb_status.npwp = tb_sijak.npwp_A1', 'inner');
        $result = $this->builder->get()->getResult();
        return $result;
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
        // // Tambahkan logika untuk mengambil data dari tabel tb_sijak berdasarkan tahun
        // $result = $this->db->table('tb_sijak')->where('YEAR(mperlan_H04-H05)', $year)->get()->getResult();

        // return $result;
        // Tambahkan logika untuk mengambil data dari tabel tb_sijak berdasarkan tahun
        $result = $this->db->table('tb_sijak')
        ->like('mperlan_H04-H05', $year, 'after') // 'after' berarti mencari yang cocok pada bagian belakang string
        ->get()
            ->getResult();

        return $result;
    }


}
