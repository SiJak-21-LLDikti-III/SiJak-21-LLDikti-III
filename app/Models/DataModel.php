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
        $this->builder->select('tb_sijak.*, tb_status.*');
        $this->builder->join('tb_status', 'tb_status.npwp_A1 = tb_sijak.npwp_A1 AND tb_status.mperlan_H04-H05 = tb_sijak.mperlan_H04-H05', 'inner');
        $this->builder->orderBy('tb_sijak.mperlan_H04-H05', 'DESC'); // Menambahkan pengurutan berdasarkan mperlan_H04-H05 secara descending
        $result = $this->builder->get()->getResult();

        return $result;
    }

    public function getDataTableByID($id)
    {
        $this->builder->select('tb_sijak.*, tb_status.*');
        $this->builder->join('tb_status', 'tb_status.npwp_A1 = tb_sijak.npwp_A1', 'inner');
        $this->builder->where('tb_sijak.id', $id);
        $result = $this->builder->get()->getResult();
        return $result;
    }





    public function updateDataByNpwp($npwp, $year, $data)
    {
        // Contoh: $data = ['field1' => 'value1', 'field2' => 'value2', ...]\
        $mperlan = "mperlan_H04-H05";
        $this->builderStatus->where('npwp_A1', $npwp);
        $this->builderStatus->where('SUBSTRING(`' . $mperlan . '`, 1, 4)', $year);
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
        $this->builder->join('tb_status', 'tb_status.npwp_A1 = tb_sijak.npwp_A1 AND tb_status.mperlan_H04-H05 = tb_sijak.mperlan_H04-H05', 'inner');

        if ($year != 'all') {
            $this->builder->like('tb_sijak.mperlan_H04-H05', $year, 'after');
        }

        $result = $this->builder->get()->getResult();

        return $result;
    }

    public function updateStatusUnduh($npwp, $year, $data)
    {
        $mperlan = "mperlan_H04-H05";
        $this->db->table('tb_status')
            ->where('npwp_A1', $npwp)
            ->where('SUBSTRING(`' . $mperlan . '`, 1, 4)', $year)
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

    public function updateData($id, $data)
    {
        // Lakukan operasi update
        $this->db->table($this->table)->where('id', $id)->update($data);

        // Periksa apakah terdapat kesalahan
        if ($this->db->error()) {
            // Jika ada kesalahan, kembalikan array dengan pesan kesalahan
            return ['error' => $this->db->error()];
        } else {
            // Jika tidak ada kesalahan, kembalikan jumlah baris yang terpengaruh
            return $this->db->affectedRows();
        }
    }

    public function updateDataStatus($id, $data)
    {
        // Lakukan operasi update
        $this->db->table($this->tableStatus)->where('id', $id)->update($data);

        // Periksa apakah terdapat kesalahan
        if ($this->db->error()) {
            // Jika ada kesalahan, kembalikan array dengan pesan kesalahan
            return ['error' => $this->db->error()];
        } else {
            // Jika tidak ada kesalahan, kembalikan jumlah baris yang terpengaruh
            return $this->db->affectedRows();
        }
    }


    public function deleteData($id, $npwp)
    {
        // Cek apakah data ditemukan di kedua tabel
        $dataInSijak = $this->db->table($this->table)->where('npwp_A1', $npwp)->countAllResults();
        $dataInStatus = $this->db->table($this->tableStatus)->where('npwp_A1', $npwp)->countAllResults();

        // Jika data ditemukan di kedua tabel, lakukan penghapusan
        if ($dataInSijak > 0 && $dataInStatus > 0) {
            $this->db->table($this->table)->where('npwp_A1', $npwp)->delete();
            $this->db->table($this->tableStatus)->where('npwp_A1', $npwp)->delete();
            return true;
        } else {
            // Jika data hanya ditemukan di salah satu tabel, jangan lakukan penghapusan
            return false;
        }
    }
    public function cekDatabyMperlandanNpwp($mperlan_H05, $npwp)
    {
        $mperlan="mperlan_H04-H05";
        // Cek apakah data ditemukan di kedua tabel
        $dataInSijak = $this->db->table($this->table)
                        ->where('npwp_A1', $npwp)
                        ->where($mperlan, $mperlan_H05)
                        ->countAllResults();
        $dataInStatus = $this->db->table($this->tableStatus)
                        ->where('npwp_A1', $npwp)
                        ->where($mperlan, $mperlan_H05)
                        ->countAllResults();

        // Jika data ditemukan di kedua tabel, lakukan penghapusan
        if ($dataInSijak > 0 && $dataInStatus > 0) {
            $this->db->table($this->table)->where('npwp_A1', $npwp)->delete();
            $this->db->table($this->tableStatus)->where('npwp_A1', $npwp)->delete();
            return true;
        } else {
            // Jika data hanya ditemukan di salah satu tabel, jangan lakukan penghapusan
            return false;
        }
    }




}
