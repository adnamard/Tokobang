<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\KeranjangModel;
use App\Models\BarangModel;
use App\Models\StatusPembelianModel;
use App\Models\UserModel;
use App\Models\DaftarStatusModel;

class Pembayaran extends BaseController
{
    protected $modelKeranjang;
    protected $modelBarang;
    protected $modelStatusPembelian;
    protected $modelDaftarStatus;
    protected $modelUser;
    protected $session;

    public function __construct()
    {

        $this->session = \Config\Services::session();
        $this->modelBarang = new BarangModel();
        $this->modelKeranjang = new KeranjangModel();
        $this->modelStatusPembelian = new StatusPembelianModel();
        $this->modelDaftarStatus = new DaftarStatusModel();
        $this->modelUser = new UserModel();
    }

    public function menunggu()
    {
        $daftarstatuspembelian = $this->modelStatusPembelian->getStatusPembelianByIdFindAll(3);
        $status = $this->modelDaftarStatus->findAll();
        $data = [
            'title' => 'Pembayaran Pending | Komikin',
            'daftar_status_pembelian' => $daftarstatuspembelian,
            'daftar_status' => $status,
        ];
        return view('admin/menunggu', $data);
    }

    public function diterima()
    {
        $daftarstatuspembelian = $this->modelStatusPembelian->getStatusPembelianByIdFindAll(1);
        $status = $this->modelDaftarStatus->findAll();
        $data = [
            'title' => 'Pembayaran Pending | Komikin',
            'daftar_status_pembelian' => $daftarstatuspembelian,
            'daftar_status' => $status,
        ];
        return view('admin/diterima', $data);
    }

    public function ditolak()
    {
        $daftarstatuspembelian = $this->modelStatusPembelian->getStatusPembelianByIdFindAll(2);
        $status = $this->modelDaftarStatus->findAll();
        $data = [
            'title' => 'Pembayaran Pending | Komikin',
            'daftar_status_pembelian' => $daftarstatuspembelian,
            'daftar_status' => $status,
        ];
        return view('admin/ditolak', $data);
    }

    public function update($id)
    {

        $status_id = $this->request->getVar('status_id');
        $user_id = $this->request->getVar('user_id');
        $barang_id = $this->request->getVar('barang_id');
        $transaksi = $this->request->getVar('transaksi');

        $modelstatus = $this->modelStatusPembelian;
        // Data yang ingin Anda simpan
        $data = [
            'status_id' => $status_id,
            'user_id' => $user_id,
            'barang_id' => $barang_id,
            'transaksi' => $transaksi
            // Sesuaikan dengan kolom-kolom yang ada di model Anda
        ];

        // Memasukkan data ke dalam model
        $modelstatus->update($id, $data);

        if ($status_id == 1) {
            return redirect()->to('/pembayaran/diterima')->with('success', 'Status Pembayaran Berhasil Diubah');
        } elseif ($status_id == 2) {
            return redirect()->to('/pembayaran/ditolak')->with('success', 'Status Pembayaran Berhasil Diubah');
        }
    }
    public function index()
    {
        //
    }
}
