<?php

namespace App\Controllers;

use App\Models\OutletModel;

class Outlet extends BaseController
{
    protected $outletModel;

    public function __construct()
    {
        $this->outletModel = new OutletModel();
    }

    public function index(): string
    {
        $data = [
            "judul" => "Outlet Dashboard",
            'outlets' => $this->outletModel->findAll(),
            'validation' => \Config\Services::validation()
        ];

        return view('outlet/index', $data);
    }

    public function addOutletView(): string
    {
        $data = [
            "judul" => "Add Outlet",
            'validation' => \Config\Services::validation()
        ];

        return view('outlet/postoutlet', $data);
    }

    public function updateOutletView($id): string
    {
        $data = [
            "judul" => "Update Outlet",
            'outlet' => $this->outletModel->find($id),
            'validation' => \Config\Services::validation()
        ];

        if (empty($data["outlet"])) {
            return redirect()->back();
        }

        return view('outlet/postoutlet', $data);
    }

    public function addOutlet()
    {
        if (!$this->validateData($this->request->getPost(), 'outlet')) {
            session()->setFlashdata('message', 'Terdapat Error');
            return redirect()->to('outlet/add')->withInput();
            // return view('outlet/postoutlet', [
            //     'judul' => 'Add Outlet',
            //     'errors' => $this->validator->getErrors(),
            //     'inputs' => $this->request->getRawInput()
            // ]);
        } else {
            $valid_data = $this->validator->getValidated();
            $this->outletModel->save([
                'kode_outlet' => $valid_data["kode_outlet"],
                'nama_outlet' => $valid_data["nama_outlet"],
                'alamat' => $valid_data["alamat"],
                'pic' => $valid_data["pic"],
            ]);
            session()->setFlashdata('message', 'Outlet berhasil ditambahkan');
            return redirect()->to('/outlet');
        }
    }

    public function updateOutlet()
    {
        if (!$this->validateData($this->request->getPost(), 'outlet')) {
            session()->setFlashdata('message', 'Terdapat Error');
            return redirect()->to('outlet/' . $this->request->getPost('id'))->withInput();
            // return view('outlet/postoutlet', [
            //     'judul' => 'Add Outlet',
            //     'errors' => $this->validator->getErrors(),
            //     'inputs' => $this->request->getRawInput()
            // ]);
        } else {
            $valid_data = $this->validator->getValidated();

            $this->outletModel->save($valid_data);

            session()->setFlashdata('message', 'Outlet berhasil diperbaharui');
            return redirect()->to('/outlet');
        }
    }

    public function deleteOutlet($id)
    {
        $this->outletModel->delete($id);
        session()->setFlashdata('message', 'Outlet berhasil dihapus');
        return redirect()->to('/outlet');
    }
}