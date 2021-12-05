<?php namespace App\Models;

use CodeIgniter\Model;

class ObatModel extends Model
{
   protected $table = 'obat';
   protected $primaryKey = 'obat_id';
   // protected $useTimestamps = true;
   protected $allowedFields = ['obat_id', 'supplier_id', 'obat_nama'];

   public function getObat($obat_id = false)
   {
      if ($obat_id == false) {
         return $this->findAll();
      }
      return $this->where(['obat_id' => $obat_id])->first();
   }

   // public function getCountObat()
   // {
   //    return $this->countAllResults();
   // }

   public function getObatSupplier($obat_id = false)
   {
      if ($obat_id == false) {
         return $this->join('supplier', 'supplier.supplier_id = obat.supplier_id')
            ->findAll();
      } else {
         return $this->join('supplier', 'supplier.supplier_id = obat.supplier_id')
            ->where(['obat_id' => $obat_id])
            ->first();
      }
   }
}
