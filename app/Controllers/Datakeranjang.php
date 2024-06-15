<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\KeranjangModel;
use App\Models\BarangModel;
use App\Models\StatusPembelianModel;
use App\Models\UserModel;

class Datakeranjang extends BaseController
{
    protected $modelKeranjang;
    protected $modelBarang;
    protected $modelStatusPembelian;
    protected $modelUser;
    protected $session;

    public function __construct()
    {

        $this->session = \Config\Services::session();
        $this->modelBarang = new BarangModel();
        $this->modelKeranjang = new KeranjangModel();
        $this->modelStatusPembelian = new StatusPembelianModel();
        $this->modelUser = new UserModel();
    }
    public function index()
    {
        if ($this->session->has('userData')) {
            $userID = $this->session->get('userData')['id'];

            // Mengambil semua riwayat transaksi user dari tabel status pembelian
            $riwayatTransaksi = $this->modelStatusPembelian
                ->select('status_pembelian.*, barang.*, user.username, user.email, daftar_status.*, status_pembelian.id')
                ->join('user', 'user.id = status_pembelian.user_id')
                ->join('barang', 'barang.id = status_pembelian.barang_id')
                ->join('daftar_status', 'daftar_status.id = status_pembelian.status_id')
                ->where('status_pembelian.user_id', $userID)
                ->orderBy('status_pembelian.id', 'DESC')
                ->findAll();

            $tanggalPembelian = [];

            foreach ($riwayatTransaksi as $transaksi) {
                $tanggalPembelian[] = $transaksi['tanggal_pembelian'];
            }

            $data = [
                'riwayatTransaksi' => $riwayatTransaksi,
                'tanggalPembelian' => $tanggalPembelian,
                'title' => 'Riwayat Transaksi'
                // Anda bisa menambahkan data lainnya yang ingin ditampilkan di view di sini
            ];

            return view('user/riwayat', $data);
        }
    }
}
