<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PenjualanHeaderModel;

class Penjualan extends BaseController
{
    protected $penjualanHeaderModel;

    public function __construct()
    {
        $this->penjualanHeaderModel = new PenjualanHeaderModel();
    }

    public function index()
    {
        $data = [
            "judul" => "Penjualan Dashboard",
            'penjualans' => $this->penjualanHeaderModel->findAll(),
        ];

        return view('penjualan/index', $data);
    }
}
