<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PenjualanHeaderModel;
use App\Models\PenjualanDetailModel;
use App\Models\OutletModel;
use App\Models\BarangModel;
use CodeIgniter\I18n\Time;

use function PHPUnit\Framework\isEmpty;

class Penjualan extends BaseController
{
    protected $penjualanHeaderModel, $penjualanDetailModel, $outletModel, $barangModel;
    protected $builder, $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('penjualan_header');
        $this->penjualanHeaderModel = new PenjualanHeaderModel();
        $this->penjualanDetailModel = new PenjualanDetailModel();
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

    public function details()
    {
        $data = [
            "judul" => "Detail Penjualan",
            'details' => $this->penjualanDetailModel->findAll(),
        ];

        return view('penjualan/details', $data);
    }

    public function detail($no_faktur)
    {
        $data = [
            "judul" => "Penjualan - " . $no_faktur,
            'details' => $this->penjualanDetailModel->where('no_faktur', $no_faktur)->findAll(),
        ];

        if (!$data['details']) {
            return redirect('penjualan');
        }

        return view('penjualan/detail', $data);
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

    public function updatePenjualanView($no_faktur): string
    {
        $header = $this->penjualanHeaderModel->where('no_faktur', $no_faktur)->first();
        $details = $this->penjualanDetailModel->where('no_faktur', $no_faktur)->findAll();
        $barang_array = [];
        $qty_array = [];

        foreach ($details as $key) {
            // $barang = [
            //     $key['kode_barang'] => $key['harga']
            // ];
            // $qty = [
            //     $key['kode_barang'] => $key['qty']
            // ];
            $barang_array = [
                ...$barang_array,
                $key['kode_barang'] => $key['harga']
            ];
            $qty_array = [
                ...$qty_array,
                $key['kode_barang'] => $key['qty']
            ];
        }

        $penjualan = [
            'id' => $header['id'],
            'no_faktur' => $header['no_faktur'],
            'tanggal_faktur' => $header['tanggal_faktur'],
            'kode_outlet' => $header['kode_outlet'],
            'barang' => $barang_array,
            'qty' => $qty_array,
            'discount' => $header['discount'],
            'amount' => $header['amount'],
            'ppn' => $header['ppn'],
            'total_amount' => $header['total_amount'],
        ];

        $data = [
            "judul" => "Buat Penjualan",
            'barangs' => $this->barangModel->findAll(),
            'outlets' => $this->outletModel->findAll(),
            'penjualan' => $penjualan
        ];

        return view('penjualan/postpenjualan', $data);
    }

    public function addPenjualan()
    {
        $post_data = $this->request->getPost();
        $post_data["qty"] = array_filter($post_data['qty'], function ($var) {
            if ($var) {
                return $var;
            }
        });

        if (!$this->validateData($post_data, 'raw_penjualan')) {
            return redirect()->to('penjualan/add')->withInput();
        }

        $valid_data = $this->validator->getValidated();

        // Generate no_faktur
        $date = date('Y-m-d', strtotime($valid_data['tanggal_faktur']));
        $time = Time::parse($date);
        $month = (int)$time->getMonth() < 10 ? '0' . $time->getMonth() : $time->getMonth();
        $no_faktur_temp = 'FAK-' . $time->getYear() . $month;

        $this->builder->like('no_faktur', $no_faktur_temp);
        $result = $this->builder->get()->getLastRow();
        $no_faktur = '';

        // dd($result);

        if (!$result) {
            $no_faktur = $no_faktur_temp . '-' . '001';
        } else {
            $no_faktur = $result->no_faktur;
            $no_faktur++;
        }

        $header_data = [
            'no_faktur' => $no_faktur,
            'tanggal_faktur' => $valid_data['tanggal_faktur'],
            'kode_outlet' => $valid_data['kode_outlet'],
            'amount' => $valid_data['amount'],
            'discount' => isset($valid_data['discount']) ? $valid_data['discount'] : 0,
            'ppn' => $valid_data['ppn'],
            'total_amount' => $valid_data['total_amount'],
            'created_user' => 'admin',
            'edit_user' => 'admin',
        ];

        $barangs = $valid_data['barang'];
        $qty = $valid_data['qty'];
        $detail_data_array = [];

        foreach ($barangs as $key => $value) {
            if ($qty[$key] > 0) {
                $detail_data = [
                    'no_faktur' => $no_faktur,
                    'kode_barang' => $key,
                    'qty' => $qty[$key],
                    'harga' => $value,
                    'sub_total' => $qty[$key] * $value,
                    'created_user' => 'admin',
                    'edit_user' => 'admin',
                ];

                if ($this->validateData($detail_data, 'penjualan_detail')) {
                    array_push($detail_data_array, $this->validator->getValidated());
                }
            }
        }

        if ($this->validateData($header_data, 'penjualan_header')) {
            $valid_header = $this->validator->getValidated();
            $this->penjualanHeaderModel->save($valid_header);
        }

        $this->builder->resetQuery();
        $this->builder = $this->db->table('penjualan_detail');
        $this->builder->insertBatch($detail_data_array);

        session()->setFlashdata('message', ['success', 'Penjualan berhasil ditambahkan']);
        return redirect()->to('/penjualan');
        // try {
        // } catch (\Throwable $th) {
        //     session()->setFlashdata('message', ['error', 'Penjualan gagal ditambahkan']);
        //     return redirect()->to('/penjualan/add')->withInput();
        // }
    }

    public function updatePenjualan()
    {
        $post_data = $this->request->getPost();
        $post_data["qty"] = array_filter($post_data['qty'], function ($var) {
            if ($var) {
                return $var;
            }
        });

        if (!$this->validateData($post_data, 'raw_penjualan')) {
            return redirect()->to('penjualan/add')->withInput();
        }

        $valid_data = $this->validator->getValidated();


        $header_data = [
            'no_faktur' => $valid_data["no_faktur"],
            'tanggal_faktur' => $valid_data['tanggal_faktur'],
            'kode_outlet' => $valid_data['kode_outlet'],
            'amount' => $valid_data['amount'],
            'discount' => isset($valid_data['discount']) ? $valid_data['discount'] : 0,
            'ppn' => $valid_data['ppn'],
            'total_amount' => $valid_data['total_amount'],
            'created_user' => 'admin',
            'edit_user' => 'admin',
        ];

        $barangs = $valid_data['barang'];
        $qty = $valid_data['qty'];
        $detail_data_array = [];

        foreach ($barangs as $key => $value) {
            if (isset($qty[$key]) && $qty[$key] > 0) {
                $detail_data = [
                    'no_faktur' => $valid_data["no_faktur"],
                    'kode_barang' => $key,
                    'qty' => $qty[$key],
                    'harga' => $value,
                    'sub_total' => $qty[$key] * $value,
                    'created_user' => 'admin',
                    'edit_user' => 'admin',
                ];

                if ($this->validateData($detail_data, 'penjualan_detail')) {
                    array_push($detail_data_array, $this->validator->getValidated());
                }
            }
        }

        if ($this->validateData($header_data, 'penjualan_header')) {
            $valid_header = $this->validator->getValidated();
            $this->penjualanHeaderModel->save($valid_header);
        }

        $this->penjualanDetailModel->where('no_faktur', $valid_data["no_faktur"])->delete();
        $this->builder->resetQuery();
        $this->builder = $this->db->table('penjualan_detail');
        $this->builder->insertBatch($detail_data_array);

        session()->setFlashdata('message', ['success', 'Penjualan berhasil diperbaharui']);
        return redirect()->to('/penjualan');
        // try {
        // } catch (\Throwable $th) {
        //     session()->setFlashdata('message', ['error', 'Penjualan gagal ditambahkan']);
        //     return redirect()->to('/penjualan/add')->withInput();
        // }
    }

    public function deletePenjualan($no_faktur)
    {
        try {
            $this->penjualanDetailModel->where('no_faktur', $no_faktur)->delete();
            $this->penjualanHeaderModel->where('no_faktur', $no_faktur)->delete();
            session()->setFlashdata('message', ['success', 'Penjualan berhasil dihapus']);
            return redirect()->to('/penjualan');
        } catch (\Throwable $th) {
            session()->setFlashdata('message', ['error', 'Penjualan gagal dihapus']);
            return redirect()->to('/penjualan');
        }
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
