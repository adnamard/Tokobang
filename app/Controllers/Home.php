<?php

namespace App\Controllers;

use App\Models\BarangModel;

class Home extends BaseController
{
    protected $barangModel;
    protected $session;

    public function __construct()
    {
        $this->barangModel  = new BarangModel();
        $this->session = \Config\Services::session();
    }

    public function index(): string
    {

        $data = [
            'title' => 'Home -=- Tb. Maju Jaya',
            'barang' => $this->barangModel->getBarang(),

        ];
        return view('home', $data);
    }
}
