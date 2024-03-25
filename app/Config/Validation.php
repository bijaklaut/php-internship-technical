<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\StrictRules\CreditCardRules;
use CodeIgniter\Validation\StrictRules\FileRules;
use CodeIgniter\Validation\StrictRules\FormatRules;
use CodeIgniter\Validation\StrictRules\Rules;

class Validation extends BaseConfig
{
    // --------------------------------------------------------------------
    // Setup
    // --------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var string[]
     */
    public array $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public array $templates = [
        'list' => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    // --------------------------------------------------------------------
    // Rules
    // --------------------------------------------------------------------

    public array $outlet = [
        'id' => 'permit_empty',
        'kode_outlet' => 'required|max_length[10]|is_unique[outlet.kode_outlet,id,{id}]',
        'nama_outlet' => 'required|max_length[100]',
        'alamat' => 'required',
        'pic' => 'required|max_length[50]',
    ];

    public array $barang = [
        'id' => 'permit_empty',
        'kode_barang' => 'required|max_length[10]|is_unique[barang.kode_barang,id,{id}]',
        'nama_barang' => 'required|max_length[100]|is_unique[barang.nama_barang,id,{id}]',
        'harga' => 'required|numeric',
    ];

    public array $raw_penjualan = [
        'id' => 'permit_empty',
        'no_faktur' => 'permit_empty',
        'tanggal_faktur' => 'required|valid_date',
        'kode_outlet' => 'required|max_length[15]',
        'barang.*' => 'required',
        'qty.*' => 'required',
        'amount' => 'required',
        'ppn' => 'required',
        'total_amount' => 'required',
    ];

    public array $penjualan_header = [
        'id' => 'permit_empty',
        'no_faktur' => 'required|max_length[15]|is_unique[penjualan_header.no_faktur,id,{id}]',
        'tanggal_faktur' => 'required|valid_date',
        'kode_outlet' => 'required|max_length[15]',
        'amount' => 'required',
        'discount' => 'required',
        'ppn' => 'required',
        'total_amount' => 'required',
        'created_user' => 'required',
        'edit_user' => 'required',
    ];

    public array $penjualan_detail = [
        'id' => 'permit_empty',
        'no_faktur' => 'required|max_length[15]',
        'kode_barang' => 'required|max_length[10]',
        'qty' => 'required',
        'harga' => 'required',
        'sub_total' => 'required',
        'created_user' => 'required',
        'edit_user' => 'required',
    ];
}
