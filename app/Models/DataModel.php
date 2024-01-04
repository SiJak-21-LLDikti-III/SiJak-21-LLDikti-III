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

    public function updateDataByNpwp($npwp, $data)
    {
        // Contoh: $data = ['field1' => 'value1', 'field2' => 'value2', ...]
        $this->builderStatus->where('npwp', $npwp);
        $this->builderStatus->update($data);

        return $this->db->affectedRows(); // Mengembalikan jumlah baris yang terpengaruh oleh operasi update
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
        $this->builder->select('tb_sijak.*, tb_status.*'); // Sesuaikan dengan kolom yang diperlukan
        $this->builder->join('tb_status', 'tb_status.npwp = tb_sijak.npwp_A1', 'inner');
        $this->builder->like('mperlan_H04-H05', $year, 'after');

        $result = $this->builder->get()->getResult();

        return $result;
    }



}
