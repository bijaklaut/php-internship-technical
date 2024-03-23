<?php

namespace App\Models;

use CodeIgniter\Model;

class PenjualanDetailModel extends Model
{
   protected $table = "penjualan_detail";
   protected $primaryKey = 'id';
   protected $useTimestamps = true;
   protected $allowedFields = [
      "no_faktur", 'kode_barang', "qty", "harga", "sub_total", "created_user", "edit_user"
   ];
}
