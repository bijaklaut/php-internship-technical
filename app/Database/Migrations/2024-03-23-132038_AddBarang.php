<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class AddBarang extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'kode_barang' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
                'unique' => true
            ],
            'nama_barang' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'unique' => true
            ],
            'harga' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'created_at' => [
                'type'    => 'TIMESTAMP',
                'default' => new RawSql('CURRENT_TIMESTAMP'),
            ],
            'updated_at' => [
                'type'    => 'TIMESTAMP',
                'default' => new RawSql('CURRENT_TIMESTAMP'),
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('barang', true);
    }

    public function down()
    {
        $this->forge->dropTable('barang');
    }
}
