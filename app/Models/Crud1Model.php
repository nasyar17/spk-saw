<?php namespace App\Models;

use CodeIgniter\Model;

class Crud1Model extends Model
{
   protected $table = 'crud1';
   protected $primaryKey = 'crud_id';
   // protected $useTimestamps = true;
   protected $allowedFields = ['crud_name', 'crud_desc'];

   public function getCrud1($crud_id = false)
   {
      if ($crud_id == false) {
         return $this->findAll();
      }
      return $this->where(['crud_id' => $crud_id])->first();
   }
}
