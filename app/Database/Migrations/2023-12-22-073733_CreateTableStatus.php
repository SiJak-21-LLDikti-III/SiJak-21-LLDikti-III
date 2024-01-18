<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableStatus extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'npwp' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'unduh_bukti' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            // 'bukti_bayar' => [
            //     'type' => 'VARCHAR',
            //     'constraint' => '255',
            // ],
            'status_unduh' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'status_bukti_bayar' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'file_bukti_bayar' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
        ]);

        // $this->forge->addKey('npwp', true);
        $this->forge->createTable('tb_status');
    }

    public function down()
    {
        $this->forge->dropTable('tb_status');
    }
}
