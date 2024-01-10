<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableSiJak extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'no_H01' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'auto_increment' => true,
                'null' => false,
            ],
            'spt_H02' => [
                'type' => 'INT',
                'null' => true,
            ],
            'mperlan_H04-H05' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'npwp_A1' => [
                'type' => 'varchar',
                'constraint' => '255',
                'null' => false,
            ],
            'nip_A2' => [
                'type' => 'varchar',
                'constraint' => '255',
            ],
            'nama_A3' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'pangkat_A4' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'tgl_lahir' => [
                'type' => 'DATE',
            ],
            // 'tahun' => [
            //     'type' => 'DATE',
            // ],
            'nama_jabatan_A5' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'jenis_kelamin_A6' => [
                'type' => 'VARCHAR',
                'constraint' => '1',
            ],
            'nik_A7' => [
                'type' => 'varchar',
                'constraint' => '16',
            ],
            'status_A8' => [
                'type' => 'varchar',
                'constraint' => '10',
            ],
            'kd_pajak' => [
                'type' => 'VARCHAR',
                'constraint' => '2',
            ],
            'gaji_pokok' => [
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
            'ptkp' => [
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
            // 'pph_potong_lunas' => [
            //     'type' => 'INT',
            //     'null' => true,
            // ],
            'atas_gaji_23A' => [
                'type' => 'INT',
                'null' => true,
            ],
            'atas_ph_23B' => [
                'type' => 'INT',
                'null' => true,
            ],
            'status_pegawai' => [
                'type' => 'Varchar',
                'constraint' => '4',
                'null' => true,
            ],
        ]);

        // Add primary key separately
        $this->forge->addKey('no_H01', true);

        $this->forge->createTable('tb_sijak');
    }

    public function down()
    {
        $this->forge->dropTable('tb_sijak');
    }
}
