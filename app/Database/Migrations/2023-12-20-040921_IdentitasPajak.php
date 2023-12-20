<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class IdentitasPajak extends Migration
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
            'npwp' => [
                'type' => 'INTEGER',
                'constraint' => '15',
            ],
            'nama_instansi' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'id_sub_unit' => [
                'type' => 'INTEGER',
                'constraint' => '19',
                'null' => true,
            ],
            'tanggal' => [
                'type' => 'DATE',
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('tb_identitas');
    }

    public function down()
    {
        $this->forge->dropTable('tb_identitas');
    }
}
