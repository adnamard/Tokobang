<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangModel extends Model
{
    protected $table            = 'barang';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['nama_barang', 'harga', 'stok', 'deskripsi', 'gambar'];

    public function getBarang($nama_barang = false) #Jika ga ada parameter maka tampilakn semua dengan findall
    {
        if ($nama_barang == false) {
            return $this->findAll();
        }

        return $this->where(['nama_barang' => $nama_barang])->first(); #kalau ada maka tampilakn array pertama
    }
}
