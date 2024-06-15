<?php

namespace App\Models;

use CodeIgniter\Model;

class KeranjangModel extends Model
{
    protected $table            = 'keranjang';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['user_id', 'barang_id', 'jumlah'];

    public function getKeranjang()
    {
        return $this->findAll();
    }

    public function getKeranjangById($user_id)
    {
        return $this->select('keranjang.*, barang.*, keranjang.id')
            ->join('barang', 'barang.id = keranjang.barang_id') //Dari tabel komik, kita ambil idnya dan dijoin ke tabel keranjang field komik_id
            ->where('keranjang.user_id', $user_id)
            ->findAll();
    }

    public function getCheckoutCountAllFindAll()
    {
        return $this->select('keranjang.*, barang.*, keranjang.id')
            ->join('barang', 'barang.id = keranjang.barang_id')
            ->countAllResults();
    }

    public function insertKeranjang($data)
    {
        return $this->insert($data);
    }

    public function updateKeranjang($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteKeranjang($id)
    {
        return $this->delete($id);
    }
}
