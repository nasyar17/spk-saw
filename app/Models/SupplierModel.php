<?php namespace App\Models;

use CodeIgniter\Model;

class SupplierModel extends Model
{
   protected $table = 'supplier';
   protected $primaryKey = 'supplier_id';
   // protected $useTimestamps = true;
   protected $allowedFields = ['supplier_id', 'supplier_nama', 'supplier_alamat', 'supplier_waktupengiriman'];

   public function getSupplier($supplier_id = false)
   {
      if ($supplier_id == false) {
         return $this->findAll();
      }
      return $this->where(['supplier_id' => $supplier_id])->first();
   }
}
