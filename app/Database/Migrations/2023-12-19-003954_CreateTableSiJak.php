<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableSiJak extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'tahun' => [
                'type' => 'INT',
            ],
            'npwp' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'pph_terpotong' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'pph_terutang' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'unduh_bukti' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'bukti_bayar' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'status_unduh' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'status_bukti_bayar' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'file_bukti_bayar' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('tb_sijak');
    }

    public function down()
    {
        $this->forge->dropTable('tb_sijak');
    }
}
