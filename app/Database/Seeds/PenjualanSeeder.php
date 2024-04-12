<?php

namespace App\Database\Seeds;

use App\Models\BarangModel;
use App\Models\OutletModel;
use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;
use Faker\Factory;

class PenjualanSeeder extends Seeder
{
    public function run()
    {
        $barangModel = new BarangModel();
        $outletModel = new OutletModel();
        $barangs = $barangModel->findAll();
        $outlets = $outletModel->findAll();

        $faker = Factory::create("id_ID");
        $no_faktur_history = [];

        for ($i = 0; $i < 20; $i++) {
            $barang_count = $faker->numberBetween(1, 5);
            $outlet = $faker->randomElement($outlets);
            $cart = $faker->randomElements($barangs, $barang_count);
            $tanggal_penjualan = $faker->dateTimeBetween('-5 years', 'now')->format("Y-m-d");

            // Generate no_faktur
            $splitted = explode("-", $tanggal_penjualan);
            $no_faktur_temp = 'FAK-' . $splitted[0] . $splitted[1];
            $filtered = array_filter($no_faktur_history, function ($item) use ($no_faktur_temp) {
                return $item == $no_faktur_temp;
            });

            $no_faktur = $no_faktur_temp . "-001";

            if (count($filtered) > 0) {
                for ($j = 0; $j < count($filtered); $j++) {
                    $no_faktur++;
                }
            }

            array_push($no_faktur_history, $no_faktur_temp);

            $amount = 0;

            foreach ($cart as $c) {
                $qty = $faker->numberBetween(1, 10);
                $item_price = $qty * $c["harga"];
                $amount += $item_price;

                $detail = [
                    "no_faktur" => $no_faktur,
                    "kode_barang" => $c["kode_barang"],
                    "qty" => $qty,
                    "harga" => $c["harga"],
                    "sub_total" => $item_price,
                    "created_user" => "admin",
                    "edit_user" => "admin",
                ];

                array_push($batch_detail, $detail);
                $this->db->table("penjualan_detail")->insert($detail);
            }

            $ppn = $amount * 10 / 100;
            $discount = round($faker->numberBetween(100, $amount / 2) / 100) * 100;
            $total_amount = $amount + $ppn - $discount;

            $data = [
                "no_faktur" => $no_faktur,
                "tanggal_faktur" => $tanggal_penjualan,
                "kode_outlet" => $outlet["kode_outlet"],
                "amount" => $amount,
                "discount" => $discount,
                "ppn" => $ppn,
                "total_amount" => $total_amount,
                "created_user" => "admin",
                "edit_user" => "admin",
            ];

            $this->db->table("penjualan_header")->insert($data);

        }

    }
}
