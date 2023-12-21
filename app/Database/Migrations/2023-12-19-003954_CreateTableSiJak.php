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
                'type' => 'INT',
            ],
            'nip' => [
                'type' => 'varchar',
                'constraint' => '255',
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'tgl_lahir' => [
                'type' => 'DATE',
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
            //     'type' => 'INT',
            //     'constraint' => '15',
            // ],
            'nik' => [
                'type' => 'varchar',
                'constraint' => '16',
            ],
            // 'kd_pajak' => [
            //     'type' => 'VARCHAR',
            //     'constraint' => '15',
            // ],
            'gaji' => [
                'type' => 'BIGINT',
            ],
            'tj_istri' => [
                'type' => 'BIGINT',
            ],
            'tj_anak' => [
                'type' => 'BIGINT',
                'null' => true,
            ],
            'jml_gaji' => [
                'type' => 'BIGINT',
                'null' => true,
            ],
            'tj_perbaikan' => [
                'type' => 'BIGINT',
                'null' => true,
            ],
            'tj_struktural' => [
                'type' => 'INT',
                'null' => true,
            ],
            'tj_beras' => [
                'type' => 'INT',
            ],
            'jml_bruto_1' => [
                'type' => 'BIGINT',
            ],
            'tj_lain' => [
                'type' => 'INT',
                'null' => true,
            ],
            'ph_tetap' => [
                'type' => 'INT',
                'null' => true,
            ],
            'jml_bruto_2' => [
                'type' => 'BIGINT',
                'null' => true,
            ],
            'biaya_jabatan' => [
                'type' => 'INT',
                'null' => true,
            ],
            'iuran_pensiun' => [
                'type' => 'INT',
                'null' => true,
            ],
            'jml_pengurangan' => [
                'type' => 'INT',
                'null' => true,
            ],
            'jml_ph' => [
                'type' => 'BIGINT',
                'null' => true,
            ],
            'ph_neto' => [
                'type' => 'INT',
                'null' => true,
            ],
            'jml_ph_neto' => [
                'type' => 'BIGINT',
                'null' => true,
            ],
            'ptktp' => [
                'type' => 'BIGINT',
                'null' => true,
            ],
            'ph_kena_pajak' => [
                'type' => 'BIGINT',
                'null' => true,
            ],
            'pph_ph' => [
                'type' => 'INT',
                'null' => true,
            ],
            'pph_potong' => [
                'type' => 'INT',
                'null' => true,
            ],
            'pph_utang' => [
                'type' => 'INT',
                'null' => true,
            ],
            'pph_potong_lunas' => [
                'type' => 'INT',
                'null' => true,
            ],
            'atas_gaji' => [
                'type' => 'INT',
                'null' => true,
            ],
            'atas_ph' => [
                'type' => 'INT',
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
