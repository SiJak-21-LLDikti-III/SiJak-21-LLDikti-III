<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableStatus extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'BIGINT',
                'unsigned' => true,
                'auto_increment' => true,
                'null' => false,
            ],
            'npwp_A1' => [
                'type' => 'varchar',
                'constraint' => '255',
                'null' => false,
            ],
            'mperlan_H04-H05' => [
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

        // Add primary key separately
        $this->forge->addKey('id', true);
        $this->forge->createTable('tb_status');
    }

    public function down()
    {
        $this->forge->dropTable('tb_status');
    }
}
