<?php namespace App\Models;

use CodeIgniter\Model;

class VariabelModel extends Model
{
   protected $table = 'variabel';
   protected $primaryKey = 'variabel_id';
   // protected $useTimestamps = true;
   protected $allowedFields = ['variabel_id', 'kriteria_id', 'variabel_nama', 'variabel_nilai'];

   public function getVariabel($variabel_id = false)
   {
      if ($variabel_id == false) {
         return $this->findAll();
      }
      return $this->where(['variabel_id' => $variabel_id])->first();
   }

   public function getVariabelByKriteriaID($kriteria_id)
   {
      return $this->where(['kriteria_id' => $kriteria_id])->findAll();
   }
}
