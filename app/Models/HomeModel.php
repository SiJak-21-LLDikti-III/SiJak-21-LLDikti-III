<?php

namespace App\Models;

use CodeIgniter\Model;

class HomeModel extends Model
{
    protected $table1 = 'tb_sijak';
    protected $table2 = 'tb_identitas';

    public function getUserData($npwp, $birthDate, $yearOption)
    {
        $mperlan = "mperlan_H04-H05";
        return $this->db->table($this->table1)
            ->where('npwp_A1', $npwp)
            ->where('tgl_lahir', $birthDate)
            ->where('SUBSTRING(`' . $mperlan . '`, 1, 4)', $yearOption, false)
            ->get()
            ->getRow();
    }

    public function getIDPP()
    {
        return $this->db->table($this->table2)
            ->get()
            ->getResult();
    }
}
