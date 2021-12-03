<?php namespace App\Models;

use CodeIgniter\Model;

class HistoryModel extends Model
{
   protected $table = 'history';
   protected $primaryKey = 'history_id';
   protected $useTimestamps = true;
   protected $allowedFields = ['obat_id', 'crud_desc'];

   public function getHistory($history_id = false)
   {
      if ($history_id == false) {
         return $this->findAll();
      }
      return $this->where(['history_id' => $history_id])->first();
   }

   public function getHistoryInfo($desc = false)
   {
      if ($desc == false) {
         return $this->db->table('history')
            ->join('obat', 'history.obat_id = obat.obat_id')
            ->join('supplier', 'obat.supplier_id = supplier.supplier_id')
            ->get()->getResultArray();
      } else {
         return $this->db->table('history')
            ->join('obat', 'history.obat_id = obat.obat_id')
            ->join('supplier', 'obat.supplier_id = supplier.supplier_id')
            ->limit(5)
            ->orderBy('history_id', 'desc')
            ->get()->getResultArray();
      }
   }

   public function getMostFrequentResult()
   {
      return $this->db->table('history')
         ->select('*')
         ->join('obat', 'history.obat_id = obat.obat_id')
         ->selectCount('history.history_id', 'jml')
         ->groupBy('history.obat_id')
         ->orderBy('jml', 'desc')
         ->get()->getResult('array');
   }
}
