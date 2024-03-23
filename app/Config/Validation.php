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
}
