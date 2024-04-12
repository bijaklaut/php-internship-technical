<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class BarangSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create("id_ID");
        $batch_data = [];
        $kode = "B001";

        for ($i = 0; $i < 20; $i++) {
            $data = [
                "kode_barang" => $kode++,
                "nama_barang" => $faker->unique()->words(2, true),
                "harga" => ceil($faker->numberBetween(5000, 20000) / 100) * 100,
            ];

            array_push($batch_data, $data);
        }

        $this->db->table("barang")->insertBatch($batch_data);
    }
}
