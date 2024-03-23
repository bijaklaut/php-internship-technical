<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class AddDetailPenjualan extends Migration
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
            'no_faktur' => [
                'type' => 'VARCHAR',
                'constraint' => 15,
                'unique' => true
            ],
            'kode_barang' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
                'unique' => true
            ],
            'qty' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'harga' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'sub_total' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'created_user' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                "default" => "admin"
            ],
            'edit_user' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                "default" => "admin"
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

        $this->forge->addKey('id');
        $this->forge->createTable('penjualan_detail', true);
    }

    public function down()
    {
        $this->forge->dropTable('penjualan_detail');
    }
}
