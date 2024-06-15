<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\KeranjangModel;
use App\Models\BarangModel;
use App\Models\StatusPembelianModel;

class Keranjang extends BaseController
{
    protected $modelKeranjang;
    protected $modelBarang;
    protected $modelStatusPembelian;
    protected $session;

    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->modelBarang = new BarangModel();
        $this->modelKeranjang = new KeranjangModel();
        $this->modelStatusPembelian = new StatusPembelianModel();
    }

    public function index()

    {
        $userId = $this->session->get('userData.id');
        $keranjang = $this->modelKeranjang->getKeranjangById($userId);

        if ($keranjang == null) {
            return redirect()->to(base_url('/'))->with('error', 'Keranjang kosong, silahkan pilih barang terlebih dahulu');
        }

        // Menghitung total harga komik
        $totalHarga = 0;
        foreach ($keranjang as $c) {
            // Ambil harga komik dari database berdasarkan ID komik
            $hargaKomik = $this->modelBarang->find($c['barang_id'])['harga'];

            // Hitung total harga dengan mengakumulasikan harga setiap komik
            $totalHarga += $hargaKomik * $c['jumlah'];
        }
        $data = [
            'title' => 'Keranjang | Komikin',
            'keranjang' => $keranjang,
            'user' => $userId,
            'totalHarga' => $totalHarga
        ];
        return view('user/keranjang', $data);
    }

    public function add($id)
    {
        // Periksa apakah pengguna sudah login
        if ($this->session->has('userData')) {
            // Ambil ID barang dari parameter
            $barangID = $id;

            // Ambil ID user dari session
            $userID = $this->session->get('userData')['id'];

            // Hitung jumlah barang yang sudah ada dalam keranjang
            $keranjangAda = $this->modelKeranjang->getKeranjangById($userID);
            $jumlahBarang = count($keranjangAda);

            foreach ($keranjangAda as $keranjangItem) {
                if ($keranjangItem['barang_id'] == $barangID) {
                    return redirect()->to(base_url('/'))->with('error', 'Barang ini sudah ada dalam keranjang.');
                }
            }

            // Ambil informasi barang untuk mendapatkan stok saat ini
            $barang = $this->modelBarang->find($barangID);

            // Periksa apakah stok cukup untuk menambahkan ke keranjang
            if ($barang['stok'] > 0) {
                // Jika tidak ada barang dalam keranjang, tambahkan barang yang dipilih ke keranjang
                $checkoutData = [
                    'user_id' => $userID,
                    'barang_id' => $barangID,
                    'jumlah' => 1, // Default jumlah 1 jika tidak ditentukan
                ];

                // Kurangi stok barang di database
                $this->modelBarang->where('id', $barangID)->set('stok', $barang['stok'] - 1)->update();

                // Tambahkan ke keranjang
                $this->modelKeranjang->insertKeranjang($checkoutData);

                // Setelah menambahkan barang ke keranjang, tampilkan pesan bahwa produk berhasil ditambahkan
                return redirect()->to(base_url('/'))->with('success', 'Barang berhasil ditambahkan ke keranjang');
            } else {
                // Jika stok tidak mencukupi, tampilkan pesan error
                return redirect()->to(base_url('/'))->with('error', 'Stok barang tidak mencukupi');
            }
        } else {
            // Jika pengguna belum login, arahkan ke halaman login
            return redirect()->to(base_url('auth/halamanlogin'))->with('error', 'Silakan login terlebih dahulu');
        }
    }

    public function delete($checkoutId)
    {
        // Periksa apakah pengguna sudah login
        if ($this->session->has('userData')) {
            // Ambil ID checkout dari parameter
            $checkoutItem = $this->modelKeranjang->find($checkoutId);

            // Ambil ID barang dari item checkout
            $barangID = $checkoutItem['barang_id'];

            // Ambil ID user dari session
            $userID = $this->session->get('userData')['id'];

            // Hapus barang dari keranjang
            $deleted = $this->modelKeranjang->deleteKeranjang($checkoutId);

            if ($deleted) {
                // Kembalikan stok barang di database
                $barang = $this->modelBarang->find($barangID);
                $this->modelBarang->update($barangID, ['stok' => $barang['stok'] + $checkoutItem['jumlah']]);

                return redirect()->to(base_url('keranjang'))->with('success', 'Barang berhasil dihapus dari keranjang');
            } else {
                return redirect()->to(base_url('keranjang'))->with('error', 'Gagal menghapus barang dari keranjang');
            }
        } else {
            // Jika pengguna belum login, arahkan ke halaman login
            return redirect()->to(base_url('auth/halamanlogin'))->with('error', 'Silakan login terlebih dahulu');
        }
    }

    public function bayar()
    {
        if ($this->session->has('userData')) {
            $userID = $this->session->get('userData')['id'];
            $username = $this->session->get('userData')['username'];
            $checkout = $this->modelKeranjang->getKeranjangById($userID);
            $bukti_pembayaran = $this->request->getFile('bukti_pembayaran');

            $bayarKeberapasiClient = $this->modelStatusPembelian
                ->select('status_pembelian.*')
                ->where('user_id', $userID)
                ->orderBy('transaksi', 'DESC')
                ->first();

            $bayarKeberapa = 0;
            if ($bayarKeberapasiClient == null) {
                $bayarKeberapa = 1;
            } else {
                $bayarKeberapa = $bayarKeberapasiClient['transaksi'] + 1;
            }


            if ($bukti_pembayaran && $bukti_pembayaran->isValid() && !$bukti_pembayaran->hasMoved()) {
                $bukti = $bukti_pembayaran->getRandomName();
                $bukti_pembayaran->move(ROOTPATH . 'public/img', $bukti); // Adjust 'public/img' as per your directory structure
            }

            // Mengambil informasi waktu sekarang
            $dataPembelian = [];


            foreach ($checkout as $item) {
                $dataPembelian[] = [
                    'barang_id' => $item['barang_id'],
                    'user_id' => $userID,
                    'jumlah' => $item['jumlah'],
                    'status_id' => 3,
                    'transaksi' => $bayarKeberapa,
                    'bukti_pembayaran' => $bukti,
                ];
            }

            // Simpan setiap data pembelian ke dalam tabel
            foreach ($dataPembelian as $data) {
                $this->modelStatusPembelian->insert($data);
            }

            $this->modelKeranjang->where('user_id', $userID)->delete();
            // var_dump($checkout);
            return redirect()->to('/')->with('success', 'Pembayaran berhasil dilakukan. Silahkan Menunggu konfirmasi dari admin');
        }
    }
}
