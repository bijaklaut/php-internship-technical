<?php

namespace App\Models;

use CodeIgniter\Model;

class PenjualanHeaderModel extends Model
{
   protected $table = "penjualan_header";
   protected $primaryKey = 'id';
   protected $useTimestamps = true;
   protected $allowedFields = [
      "no_faktur", 'tanggal_faktur', "kode_outlet", "amount", "discount", "ppn", "total_amount", "created_user", "edit_user"
   ];
}
