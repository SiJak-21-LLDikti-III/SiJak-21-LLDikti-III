<?php

namespace App\Models;

use CodeIgniter\Model;

class CetakModel extends Model
{
    protected $table = 'tb_sijak';

    public function __construct()
    {
        parent::__construct();
    }

    public function getYayasanNames($selectedDate)
    {
        $sql = "SELECT DISTINCT yayasan FROM perguruan WHERE tgl_input = ? ORDER BY yayasan ASC";
        $result = $this->db->query($sql, [$selectedDate])->getResultArray();
        return $result;
    }

    public function getPTNames($selectedDate, $selectedYayasan)
    {
        $sql = 'SELECT DISTINCT nama_pt FROM perguruan WHERE tgl_input = ? AND yayasan = ? ORDER BY nama_pt ASC';
        $result = $this->db->query($sql, [$selectedDate, $selectedYayasan])->getResultArray();
        return $result;
    }

    public function getPerguruanById($id)
    {
        $sql = "SELECT * FROM perguruan WHERE id_pt = ?";
        $result = $this->db->query($sql, trim($id))->getRowArray();
        return $result;
    }

    public function getIDPerguruanByUser($usedTglInput, $usedPTValues)
    {
        $sql = "SELECT id_pt FROM perguruan WHERE tgl_input = ? AND nama_pt = ?";
        $result = $this->db->query($sql, [$usedTglInput, $usedPTValues])->getRow();
        if ($result) {
            // Mengambil nilai id_pt sebagai string
            $id_pt = $result->id_pt;
            return $id_pt;
        } else {
            // Handle jika data tidak ditemukan
            return null;
        }
    }

    public function getDataPT($usedTglInput, $usedPT)
    {
        $sql = 'SELECT * FROM perguruan WHERE tgl_input = ? AND nama_pt = ?';
        return $this->db->query($sql, [$usedTglInput, $usedPT])->getRowArray();
    }

    public function getDataProdi($usedTglInput, $usedPT)
    {
        $sql = 'SELECT * FROM prodi WHERE tgl_input = ? AND nama_pt = ?';
        return $this->db->query($sql, [$usedTglInput, $usedPT])->getResultArray();
    }
}
