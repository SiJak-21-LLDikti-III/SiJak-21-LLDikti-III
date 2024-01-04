<?php

namespace App\Models;

use CodeIgniter\Model;

class HomeModel extends Model
{
    protected $table = 'tb_sijak'; // Sesuaikan dengan nama tabel Anda
    protected $primaryKey = 'id'; // Sesuaikan dengan primary key tabel

    public function getUserData($npwp, $birthDate, $yearOption)
    {
        $mperlan = "mperlan_H04-H05";
        return $this->where('npwp_A1', $npwp)
            ->where('tgl_lahir', $birthDate)
            ->where('SUBSTRING(`' . $mperlan . '`, 7)', $yearOption, false)
            ->first();
    }
}
