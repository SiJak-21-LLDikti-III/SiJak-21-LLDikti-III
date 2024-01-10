<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class IdentitasPajak extends Migration
{
    public function up()
    {
        // Membuat tabel
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'npwp' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'nama_instansi' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'id_sub_unit' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'tanggal' => [
                'type' => 'DATE',
            ],
            'nama_penandatangan' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('tb_identitas');

        // Menambahkan data ke tabel
        $data = [
            'id' => 1,
            'npwp' => '963536958005000',
            'nama_instansi' => 'LEMBAGA LAYANAN PENDIDIKAN TINGGI WILAYAH III DKI JAKARTA DITJEN PENDIDIKAN TINGGI KEMENTERIAN PENDIDIKAN DAN KEBUDAYAAN',
            'id_sub_unit' => '',
            'tanggal' => '2023-11-28',
            'nama_penandatangan' => 'ELIH ERMAWATI'
        ];

        $this->db->table('tb_identitas')->insert($data);
    }

    public function down()
    {
        // Menghapus tabel
        $this->forge->dropTable('tb_identitas');
    }
}
