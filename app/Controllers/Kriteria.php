<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\KriteriaModel;

class Kriteria extends Controller
{

   public function __construct()
   {
      $this->kriteriaModel = new KriteriaModel();
      $this->session = session();
   }

   public function index()
   {
      $data = [
         'title' => 'Kriteria',
         'kriteria' => $this->kriteriaModel->getKriteria(),
         'session' => $this->session->get()
      ];
      return view('kriteria/index', $data);
   }

   public function edit($kriteria_id)
   {
      $data = [
         'title' => 'Ubah Kriteria',
         'validation' => \Config\Services::validation(),
         'kriteria' => $this->kriteriaModel->getKriteria($kriteria_id),
         'session' => $this->session->get()
      ];

      return view('kriteria/edit', $data);
   }

   public function update($kriteria_id)
   {
      // validasi data
      if (!$this->validate([
         'kriteria_nama' => [
            'rules' => 'required',
            'errors' => [
               'required' => 'Field harus diisi',
            ]
         ]
      ])) {
         $validation = \Config\Services::validation();
         return redirect()->to('/kriteria/edit/' . $this->request->getVar('kriteria_id'))->withInput();
      }

      $this->kriteriaModel->save([
         'kriteria_id' => $kriteria_id,
         'kriteria_nama' => $this->request->getVar('kriteria_nama'),
         'costbenefit' => $this->request->getVar('costbenefit'),
      ]);

      session()->setFlashdata(['message' => 'Data updated successfully !', 'icon' => 'success']);

      return redirect()->to('/kriteria');
   }

   public function ubahBobot()
   {
      $data = [
         'title' => 'Ubah Bobot',
         'kriteria' => $this->kriteriaModel->getKriteria(),
         'validation' => \Config\Services::validation(),
         'session' => $this->session->get()
      ];

      return view('kriteria/ubahBobot', $data);
   }

   public function saveBobot()
   {
      if (array_sum($_POST) != 100) {
         session()->setFlashdata(['message' => 'Jumlah nilai kriteria tidak 100', 'icon' => 'info']);
         return redirect()->to('/kriteria/ubahBobot');
      }

      foreach ($_POST as $key => $value) {
         $this->kriteriaModel->save([
            'kriteria_id' => $key,
            'kriteria_bobot' => $value
         ]);
      }
      session()->setFlashdata(['message' => 'Bobot berhasil diubah', 'icon' => 'success']);
      return redirect()->to('/kriteria/ubahBobot');
   }
}
