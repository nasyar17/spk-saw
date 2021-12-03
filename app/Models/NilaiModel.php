<?php namespace App\Models;

use CodeIgniter\Model;

class NilaiModel extends Model
{
   protected $table = 'nilai';
   protected $primaryKey = 'nilai_id';
   // protected $useTimestamps = true;
   protected $allowedFields = ['obat_id', 'kriteria_id', 'variabel_id'];

   public function getNilai($nilai_id = false)
   {
      if ($nilai_id == false) {
         return $this->findAll();
      }
      return $this->where(['nilai_id' => $nilai_id])->first();
   }

   public function deleteObat($obat_id)
   {
      return $this->db->table('nilai')
         ->where(['obat_id' => $obat_id])
         ->delete();
   }

   public function getNilaiByObatID($obat_id)
   {
      return $this->where(['obat_id' => $obat_id])
         ->join('kriteria', 'nilai.kriteria_id = kriteria.kriteria_id')
         ->get()->getResultArray();
   }

   public function getNilaiFull()
   {
      return $this->db->table('nilai')
         ->join('kriteria', 'nilai.kriteria_id = kriteria.kriteria_id')
         ->join('variabel', 'nilai.variabel_id = variabel.variabel_id')
         ->join('obat', 'nilai.obat_id = obat.obat_id')
         ->orderBy('nilai.nilai_id', 'asc')
         ->get()->getResultArray();
   }

   public function getNilaiVariabel()
   {
      return $this->db->table('nilai')
         // ->join('kriteria', 'nilai.kriteria_id = kriteria.kriteria_id')
         ->join('variabel', 'nilai.variabel_id = variabel.variabel_id')
         ->join('obat', 'nilai.obat_id = obat.obat_id')
         ->orderBy('nilai.nilai_id', 'asc')
         ->get()->getResultArray();
   }

   public function getJumlahData()
   {
      return $this->groupBy('obat_id')->findAll();
   }

   public function getNilaiByKriteriaID($kriteria_id)
   {
      return $this->db->table('nilai')
         ->join('kriteria', 'nilai.kriteria_id = kriteria.kriteria_id')
         ->join('variabel', 'nilai.variabel_id = variabel.variabel_id')
         ->join('obat', 'nilai.obat_id = obat.obat_id')
         ->orderBy('nilai.nilai_id', 'asc')
         ->where(['nilai.kriteria_id' => $kriteria_id])
         ->get()->getResultArray();
   }
}
