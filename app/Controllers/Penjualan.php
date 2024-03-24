<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PenjualanHeaderModel;
use App\Models\OutletModel;
use App\Models\BarangModel;

class Penjualan extends BaseController
{
    protected $penjualanHeaderModel, $outletModel, $barangModel;
    protected $builder, $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('barang');
        $this->penjualanHeaderModel = new PenjualanHeaderModel();
        $this->outletModel = new OutletModel();
        $this->barangModel = new BarangModel();
    }

    public function index()
    {
        $data = [
            "judul" => "Penjualan Dashboard",
            'penjualans' => $this->penjualanHeaderModel->findAll(),
        ];

        return view('penjualan/index', $data);
    }

    public function addPenjualanView(): string
    {
        $data = [
            "judul" => "Buat Penjualan",
            'barangs' => $this->barangModel->findAll(),
            'outlets' => $this->outletModel->findAll(),
        ];

        return view('penjualan/postpenjualan', $data);
    }

    public function getFilteredBarangs($match = "")
    {
        try {
            $this->builder->like('kode_barang', $match);
            $this->builder->orLike('nama_barang', $match);
            $this->builder->orLike('harga', $match);
            $barangs = $this->builder->get()->getResultArray();

            if (count($barangs) == 0) echo "Barang tidak ditemukan";

            echo view('penjualan/getfilteredbarangs', ['barangs' => $barangs]);
        } catch (\Throwable $th) {
            return json_encode('Terjadi error');
        }
    }
}
