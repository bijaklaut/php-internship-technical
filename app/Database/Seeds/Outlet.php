<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class Outlet extends Seeder
{
    public function run()
    {
        $faker = Factory::create("id_ID");
        $batch_data = [];
        $kode = "TKO-000";

        for ($i = 0; $i < 20; $i++) {
            $data = [
                "kode_outlet" => $kode++,
                "nama_outlet" => $faker->company,
                "alamat" => $faker->address,
                "pic" => $faker->name,
            ];

            array_push($batch_data, $data);
        }

        $this->db->table("outlet")->insertBatch($batch_data);
    }
}
