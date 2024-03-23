<?php

namespace App\Controllers;

use App\Models\BarangModel;

class Barang extends BaseController
{
    protected $barangModel;

    public function __construct()
    {
        $this->barangModel = new BarangModel();
    }

    public function index(): string
    {
        $data = [
            "judul" => "Barang Dashboard",
            'barangs' => $this->barangModel->findAll(),
        ];

        return view('barang/index', $data);
    }

    public function addBarangView(): string
    {
        $data = [
            "judul" => "Tambah Barang",
        ];

        return view('barang/postbarang', $data);
    }

    public function updateBarangView($id): string
    {
        $data = [
            "judul" => "Update Barang",
            'barang' => $this->barangModel->find($id),
        ];

        if (empty($data["barang"])) {
            return redirect()->back();
        }

        return view('barang/postbarang', $data);
    }

    public function addBarang()
    {
        try {
            if (!$this->validateData($this->request->getPost(), 'barang')) {
                return redirect()->to('barang/add')->withInput();
            } else {
                $valid_data = $this->validator->getValidated();
                $this->barangModel->save($valid_data);
                session()->setFlashdata('message', ['success', 'Barang berhasil ditambahkan']);
                return redirect()->to('/barang');
            }
        } catch (\Throwable $th) {
            session()->setFlashdata('message', ['error', 'Barang gagal ditambahkan']);
            return redirect()->to('/barang');
        }
    }

    public function updateBarang()
    {
        try {
            if (!$this->validateData($this->request->getPost(), 'barang')) {
                return redirect()->to('barang/' . $this->request->getPost('id'))->withInput();
            } else {
                $valid_data = $this->validator->getValidated();
                $this->barangModel->save($valid_data);

                session()->setFlashdata('message', ['success', 'Barang berhasil diperbaharui']);
                return redirect()->to('/barang');
            }
        } catch (\Throwable $th) {
            session()->setFlashdata('message', ['error', 'Barang gagal diperbaharui']);
            return redirect()->to('/barang');
        }
    }

    public function deleteBarang($id)
    {
        try {
            $this->barangModel->delete($id);
            session()->setFlashdata('message', ["success", "Barang berhasil dihapus"]);
        } catch (\Throwable $th) {
            session()->setFlashdata('message', ["error", "Barang gagal dihapus"]);
        } finally {
            return redirect()->to('/barang');
        }
    }
}
