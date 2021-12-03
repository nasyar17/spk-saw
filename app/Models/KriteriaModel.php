<?php namespace App\Models;

use CodeIgniter\Model;

class KriteriaModel extends Model
{
   protected $table = 'kriteria';
   protected $primaryKey = 'kriteria_id';
   // protected $useTimestamps = true;
   protected $allowedFields = ['kriteria_nama', 'costbenefit', 'kriteria_bobot'];

   public function getKriteria($kriteria_id = false)
   {
      if ($kriteria_id == false) {
         return $this->findAll();
      }
      return $this->where(['kriteria_id' => $kriteria_id])->first();
   }
}
