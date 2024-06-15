<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class StatusPembelian extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
            ],
            'barang_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
            ],
            'status_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
            ],
            'jumlah' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'tanggal_pembelian' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ]
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('user_id', 'user', 'id'); // Sesuaikan dengan nama tabel user Anda
        $this->forge->addForeignKey('barang_id', 'barang', 'id');
        $this->forge->addForeignKey('status_id', 'daftar_status', 'id'); // Sesuaikan dengan nama tabel komik Anda
        $this->forge->createTable('status_pembelian');
    }

    public function down()
    {
        //
    }
}
