<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\VariabelModel;
use App\Models\KriteriaModel;

class Variabel extends Controller
{

   public function __construct()
   {
      $this->variabelModel = new VariabelModel();
      $this->kriteriaModel = new KriteriaModel();
      $this->session = session();
   }

   public function index()
   {
      $data = [
         'title' => 'Variabel',
         'kriteria' => $this->kriteriaModel->getKriteria(),
         'variabel' => $this->variabelModel->getVariabel(),
         'session' => $this->session->get()
      ];
      return view('variabel/index', $data);
   }

   public function generateIDVariabel()
   {
      $jumlahData = count($this->variabelModel->getVariabel());
      if ($jumlahData == 0) {
         $jumlahData = 1;
      }
      $ID = 'V' . sprintf("%02d", $jumlahData);
      while ($this->variabelModel->getVariabel($ID) >= 1) {
         $jumlahData += 1;
         $ID = 'V' . sprintf("%02d", $jumlahData);
      }
      return $ID;
   }

   public function tambah($kriteria_id)
   {
      $data = [
         'title' => 'Form Tambah Variabel',
         'kriteria_id' => $kriteria_id,
         'variabel_id' => $this->generateIDVariabel(),
         'validation' => \Config\Services::validation()
      ];
      return view('variabel/tambah', $data);
   }

   public function save($kriteria_id)
   {
      $kriteria = $this->variabelModel->getVariabelByKriteriaID($kriteria_id);
      if (!$this->validate([
         'variabel_id' => [
            'rules' => 'required|is_unique[variabel.variabel_id]',
            'errors' => [
               'required' => 'Field harus diisi',
               'unique' => 'ID sudah ada',
            ]
         ],
         'variabel_nama' => [
            'rules' => 'required',
            'errors' => [
               'required' => 'Field harus diisi'
            ]
         ],
         'variabel_nilai' => [
            'rules' => 'required|numeric',
            'errors' => [
               'required' => 'Field harus diisi',
               'numeric' => 'Isi dengan angka'
            ]
         ]
      ])) {
         $validation = \Config\Services::validation();
         return redirect()->to('/variabel/tambah/' . $kriteria_id)->withInput();
      }

      $data = [
         'variabel_id' => $this->request->getVar('variabel_id'),
         'kriteria_id' => $kriteria_id,
         'variabel_nama' => $this->request->getVar('variabel_nama'),
         'variabel_nilai' => $this->request->getVar('variabel_nilai'),
      ];

      $this->variabelModel->insert($data);
      session()->setFlashdata(['message' => 'Data berhasil ditambah !', 'icon' => 'success']);
      return redirect()->to('/variabel');
   }

   public function edit($variabel_id)
   {
      $data = [
         'title' => 'Ubah Variabel',
         'variabel' => $this->variabelModel->getVariabel($variabel_id),
         'validation' => \Config\Services::validation(),
      ];

      return view('variabel/edit', $data);
   }

   public function update($variabel_id)
   {
      // validasi data
      if (!$this->validate([
         'variabel_nama' => [
            'rules' => 'required',
            'errors' => [
               'required' => 'Field harus diisi',
            ]
         ]
      ])) {
         $validation = \Config\Services::validation();
         return redirect()->to('/variabel/edit/' . $this->request->getVar('variabel_id'))->withInput();
      }

      $this->variabelModel->save([
         'variabel_id' => $variabel_id,
         'variabel_nama' => $this->request->getVar('variabel_nama'),
         'costbenefit' => $this->request->getVar('costbenefit'),
      ]);

      session()->setFlashdata(['message' => 'Data updated successfully !', 'icon' => 'success']);

      return redirect()->to('/variabel');
   }

   public function delete($variabel_id)
   {
      $this->variabelModel->delete($variabel_id);
      session()->setFlashdata(['message' => 'Data deleted successfully !', 'icon' => 'success']);
      return redirect()->to('/variabel');
   }
}
