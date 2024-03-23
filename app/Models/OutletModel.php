<?php

namespace App\Models;

use CodeIgniter\Model;

class OutletModel extends Model
{
   protected $table = "outlet";
   protected $primaryKey = 'id';
   protected $useTimestamps = true;
   protected $allowedFields = ["kode_outlet", 'nama_outlet', "alamat", "pic"];

   public function getOutletList()
   {
      return $this->findAll();
   }
}
