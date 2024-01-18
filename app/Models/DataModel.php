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

        if ($year != 'all') {
            $this->builder->like('mperlan_H04-H05', $year, 'after');
        }

        $result = $this->builder->get()->getResult();

        return $result;
    }

    public function updateStatusUnduh($npwp, $data)
    {
        $this->db->table('tb_status')
            ->where('npwp', $npwp)
            ->update($data);
    }

    //For DASHBOARD
    public function getCountData()
    {
        $this->builder->select('count(*) as count');
        $result = $this->builder->get()->getResultArray();
        return $result[0]['count'];
    }

    public function getCountData_StatusUnduh()
    {
        $this->builderStatus->select('count(*) as count');
        $this->builderStatus->where('status_unduh', 1);
        $result = $this->builderStatus->get()->getResultArray();
        return $result[0]['count'];
    }

    public function getCountData_StatusUnggah()
    {
        $this->builderStatus->select('count(*) as count');
        $this->builderStatus->where('status_bukti_bayar', 1);
        $result = $this->builderStatus->get()->getResultArray();
        return $result[0]['count'];
    }
}
