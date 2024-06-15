<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\BarangModel;


class Admin extends BaseController
{
    protected $session;
    protected $validation;
    protected $userModel;
    protected $barangModel;

    public function __construct()
    {

        helper(['form']);

        $this->session = \Config\Services::session();
        $this->userModel  = new UserModel();
        $this->barangModel  = new BarangModel();
    }

    public function index()
    {
        $userID = $this->session->get('userData');
        $data = [
            'title' => 'Dashboard Admin',
            'user' => $userID,
        ];
        // dd($data);
        return view('admin/dashboard', $data);
    }

    public function listuser()
    {
        $data = [
            'title' => 'Daftar User',
            'user' => $this->userModel->getUser()
        ];
        return view('admin/user', $data);
    }

    public function listbarang()
    {
        $data = [
            'title' => 'Daftar Barang',
            'barang' => $this->barangModel->getBarang()
        ];
        return view('barang/index', $data);
    }

    public function tambahbarang()
    {
        $data = [
            'title' => 'Daftar Komik',
        ];
        return view('barang/tambah', $data);
    }

    public function profile()
    {

        $userID = $this->session->get('userData');
        $data = [
            'title' => 'Profile',
            'user' => $userID
        ];

        return view('admin/profile', $data);
    }


    public function detail($nama_barang)
    {
        $barang = $this->barangModel->getBarang($nama_barang);

        //Jika barang tidak ada di tabel
        if (empty($barang)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Judul barang ' . $nama_barang . ' Tidak ditemukan');
        }

        $data = [
            'title' => 'Detail barang',
            'barang' => $barang
        ];

        return view('barang/detail', $data);
    }

    public function edit($nama_barang)
    {
        $data = [
            'title' => 'Form Ubah Data Barang',
            'validation' => \Config\Services::validation(),
            'barang' => $this->barangModel->getBarang($nama_barang)
        ];
        return view('barang/edit', $data);
    }

    public function delete($id)
    {
        $this->barangModel->delete($id);

        session()->setFlashdata('pesan', 'Data berhasill dihapus');
        return redirect()->to(base_url('admin/listbarang'));
    }


    public function update($id)
    {


        //Cek judul, kalau judul dirubah maka cek is_unique, kalau judul tidak diubah maka tak perlu cek is_unique
        // $komik = $this->komikModel->find($id); // Ambil data komik berdasarkan ID

        // // Rules
        // $rule_judul = 'required';
        // if ($komik['judul'] != $this->request->getVar('judul')) {
        //     $rule_judul .= '|is_unique[komik.judul]';
        // }
        //Validasi Input
        if (!$this->validate([
            'nama_barang' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} komik harus diisi.',
                    // 'is_unique' => '{field} komik sudah tersedia.'
                ]
            ],
            'harga' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} komik harus diisi.',
                ]
            ],
            'stok' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} komik harus diisi.',
                ]
            ],
            'deskripsi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} komik harus diisi.',
                ]
            ],
            'gambar' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} komik harus diisi.',
                ]
            ],

        ])) {
            $validation = \Config\Services::validation()->listErrors();
            return redirect()->to('admin/edit/' . $this->request->getVar('nama_barang'))->withInput()->with('validation', $validation);
        }


        $this->barangModel->save([
            'id' => $id,
            'nama_barang' => $this->request->getVar('nama_barang'),
            'harga' => $this->request->getVar('harga'),
            'stok' => $this->request->getVar('stok'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'gambar' => $this->request->getVar('gambar'),
        ]);


        session()->setFlashdata('pesan', 'Data berhasill diubah');
        //setelah berhasil kita kembaliin ke halaman index lagi
        return redirect()->to('admin/listbarang')->with('success', 'Data barang berhasil diubah');;
    }

    public function save()
    {

        $sampulFile = $this->request->getFile('gambar');        //Validasi Input
        if (!$this->validate([
            'nama_barang' => [
                'rules' => 'required|is_unique[barang.nama_barang]',
                'errors' => [
                    'required' => '{field} barang harus diisi',
                    'is_unique' => '{field} barang sudah tersedia.'
                ]
            ],
            'harga' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} barang harus diisi',
                ]
            ],
            'stok' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} barang harus diisi',
                ]
            ],
            'deskripsi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} barang harus diisi',
                ]
            ],
            'gambar' => [
                'rules' => 'uploaded[gambar]',
                'errors' => [
                    'uploaded' => '{field} barang harus diunggah.',
                ]
            ],

        ])) {
            $validation = \Config\Services::validation()->listErrors();
            return redirect()->to('Admin/tambahbarang')->withInput()->with('validation', $validation);
            //Save ngirim semua input, terus kirim validationnya, teru sdiambil di fucntion create Kita bakal redirect ke create page
        }
        //dd($this->request->getVar());//Ambil semuanya, kalo mau satu, masukin parameternya di dalem tand kurunS

        if ($sampulFile->isValid() && !$sampulFile->hasMoved()) {
            $newSampul = $sampulFile->getRandomName();
            $sampulFile->move('img', $newSampul); // Move to the 'public/img' directory

            $this->barangModel->save([
                'nama_barang' => $this->request->getVar('nama_barang'),
                'harga' => $this->request->getVar('harga'),
                'stok' => $this->request->getVar('stok'),
                'deskripsi' => $this->request->getVar('deskripsi'),
                'gambar' => $newSampul,
            ]);
        }

        session()->setFlashdata('pesan', 'Data berhasill ditambahkan');
        //setelah berhasil kita kembaliin ke halaman index lagi
        return redirect()->to('Admin/listbarang');
    }
}
