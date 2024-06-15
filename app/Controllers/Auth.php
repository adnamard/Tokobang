<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;


use App\Models\UserModel;


class Auth extends BaseController
{
    protected $userModel;
    protected $helpers = ['form'];

    protected $session;


    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->session = \Config\Services::session();
    }

    public function halamanlogin()
    {
        $data = [
            'title' => 'Login -=- Tb. Maju Jaya',

        ];
        return view('auth/login', $data);
    }

    public function halamanregister()
    {
        $data = [
            'title' => 'Login -=- Tb. Maju Jaya',

        ];
        return view('auth/register', $data);
    }

    public function register()
    { //Validasi data yang sudah ditangkap
        if (!$this->validate(
            [
                'username' => [
                    'rules' => 'required|is_unique[user.username]',
                    'errors' => [
                        'is_unique' => '{field} tidak tersedia.',
                        'required' => '{field} harus diisi.'
                    ]
                ],
                'email' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus diisi.'
                    ]
                ],
                'password' => [
                    'rules' => 'required|min_length[3]',
                    'errors' => [
                        'required' => '{field} harus diisi.',
                        'min_length' => '{field} minimal delapan karakter.'
                    ]
                ],
            ]
        )) {
            //Jika validasi gagal
            $validation = \Config\Services::validation();
            session()->setFlashdata('pesangagal', $validation->listErrors());
            return redirect()->to('auth/halamanregister')->withInput()->with('validation', $validation);
        }
        //Jika validasi berhasil
        //Memutuskan nanti data apa saja yang disimpan di tabel user
        $password = $this->request->getPost('password');
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $data = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'password' => $hashedPassword,
            'role' => 1,
        ];
        $this->userModel->insert($data);
        session()->setFlashdata('pesansukses', 'Selamat anda berhasil registrasi, silakan login.');
        return redirect()->to('auth/halamanlogin');
    }

    public function login()
    {
        // Lakukan validasi untuk login
        if (!$this->validate(
            [
                'username' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus diisi.'
                    ]

                ],
                'password' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus diisi.',
                    ]
                ],
            ]
        )) {
            //Jika validasi gagal
            $validation = \Config\Services::validation();
            session()->setFlashdata('pesangagal', $validation->listErrors());
            return redirect()->to('auth/halamanlogin')->withInput()->with('validation', $validation);
        }

        // Ambil data dari form
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Cari pengguna berdasarkan username
        $user = $this->userModel->where('username', $username)->first();

        // Periksa apakah pengguna ditemukan dan cocok dengan password
        if ($user) {
            // Jika pengguna ditemukan, verifikasi password
            if (password_verify($password, $user['password'])) {
                // Password cocok, autentikasi berhasil, set session atau tindakan lain yang sesuai

                // Contoh: Set session pengguna
                $userData = [
                    'id' => $user['id'],
                    'username' => $user['username'],
                    'email' => $user['email'],
                    'role' => $user['role'],
                    // Tambahkan data lain jika diperlukan
                ];
                session()->set('userData', $userData);
                if ($userData['role'] == 0) {
                    return redirect()->to('/admin');
                } elseif ($userData['role'] == 1) {
                    return redirect()->to('/');
                }
            } else {
                // Password tidak cocok
                session()->setFlashdata('pesangagal', 'Password tidak sesuai.');

                return redirect()->to('auth/halamanlogin')->withInput();
            }
        } else {
            // Pengguna tidak ditemukan
            session()->setFlashdata('pesangagal', 'Username tidak ditemukan.');
            return redirect()->to('auth/halamanlogin')->withInput();
        }
        // Redirect ke halaman dashboard atau halaman setelah login
        return redirect()->to('admin/'); // Ubah 'Dashboard' sesuai halaman setelah login
    }


    public function logout()
    {
        $session = session();
        $session->destroy();
        session()->setFlashdata('pesan', 'Success for logout, comeback later!');
        return redirect()->to('/');
    }
}
