<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableSiJak extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'no' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'tahun' => [
                'type' => 'DATE',
            ],
            'npwp' => [
                'type' => 'INTEGER',
                'constraint' => '15',
            ],
            'nip' => [
                'type' => 'INTEGER',
                // 'constraint' => '',
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'pangkat' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'nama_jabatan' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            // 'jenis_kelamin' => [
            //     'type' => 'INTEGER',
            //     'constraint' => '15',
            // ],
            'nik' => [
                'type' => 'INTEGER',
                'constraint' => '16',
            ],
            // 'kd_pajak' => [
            //     'type' => 'VARCHAR',
            //     'constraint' => '15',
            // ],
            'gaji' => [
                'type' => 'INTEGER',
                'constraint' => '15',
            ],
            'tj_istri' => [
                'type' => 'INTEGER',
                'constraint' => '15',
            ],
            'tj_anak' => [
                'type' => 'INTEGER',
                'constraint' => '15',
                'null' => true,
            ],
            'jml_gaji' => [
                'type' => 'INTEGER',
                'constraint' => '15',
            ],
            'tj_perbaikan' => [
                'type' => 'INTEGER',
                'constraint' => '15',
                'null' => true,
            ],
            'tj_struktural' => [
                'type' => 'INTEGER',
                'constraint' => '15',
            ],
            'tj_beras' => [
                'type' => 'INTEGER',
                'constraint' => '15',
            ],
            'jml_bruto_1' => [
                'type' => 'INTEGER',
                'constraint' => '15',
            ],
            'tj_lain' => [
                'type' => 'INTEGER',
                'constraint' => '15',
                'null' => true,
            ],
            'ph_tetap' => [
                'type' => 'INTEGER',
                'constraint' => '15',
            ],
            'jml_bruto_2' => [
                'type' => 'INTEGER',
                'constraint' => '15',
            ],
            'biaya_jabatan' => [
                'type' => 'INTEGER',
                'constraint' => '15',
            ],
            'iuran_pensiun' => [
                'type' => 'INTEGER',
                'constraint' => '15',
            ],
            'jml_pengurangan' => [
                'type' => 'INTEGER',
                'constraint' => '15',
            ],
            'jml_ph' => [
                'type' => 'INTEGER',
                'constraint' => '15',
            ],
            'ph_neto' => [
                'type' => 'INTEGER',
                'constraint' => '15',
                'null' => true,
            ],
            'jml_ph_neto' => [
                'type' => 'INTEGER',
                'constraint' => '15',
            ],
            'ptktp' => [
                'type' => 'INTEGER',
                'constraint' => '15',
            ],
            'ph_kena_pajak' => [
                'type' => 'INTEGER',
                'constraint' => '15',
            ],
            'pph_ph' => [
                'type' => 'INTEGER',
                'constraint' => '15',
            ],
            'pph_potong' => [
                'type' => 'INTEGER',
                'constraint' => '15',
            ],
            'pph_utang' => [
                'type' => 'INTEGER',
                'constraint' => '15',
            ],
            'pph_potong_lunas' => [
                'type' => 'INTEGER',
                'constraint' => '15',
                'null' => true,
            ],
            'atas_gaji' => [
                'type' => 'INTEGER',
                'constraint' => '15',
                'null' => true,
            ],
            'atas_ph' => [
                'type' => 'INTEGER',
                'constraint' => '15',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('no', true);
        $this->forge->createTable('tb_sijak');
    }

    public function down()
    {
        $this->forge->dropTable('tb_sijak');
    }
}
