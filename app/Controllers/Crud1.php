<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Crud1Model;

class Crud1 extends Controller
{

   public function __construct()
   {
      $this->crud1Model = new Crud1Model();
   }
   public function test()
   { }

   public function index()
   {
      $data = [
         'title' => 'Crud 1',
         'crud1' => $this->crud1Model->getCrud1()
      ];
      return view('crud1/index', $data);
   }

   public function tambah()
   {
      $data = [
         'title' => 'Form Tambah Data',
         'validation' => \Config\Services::validation()
      ];
      return view('crud1/tambah', $data);
   }

   public function save()
   {
      if (!$this->validate([
         'crud_name' => [
            // 'rules' => 'required|is_unique[crud1.crud_name]',
            'rules' => 'required',
            'errors' => [
               'required' => 'Field harus diisi',
               // 'is_unique' => 'crud_name sudah ada'
            ]
         ],
         'crud_desc' => [
            'rules' => 'required',
            'errors' => [
               'required' => 'Field harus diisi'
            ]
         ]
      ])) {
         $validation = \Config\Services::validation();
         return redirect()->to('/crud1/tambah')->withInput();
      }

      $data = [
         'crud_name' => $this->request->getVar('crud_name'),
         'crud_desc' => $this->request->getVar('crud_desc'),
      ];

      $this->crud1Model->save($data);
      session()->setFlashdata(['message' => 'Data berhasil ditambah !', 'icon' => 'success']);
      return redirect()->to('/crud1');
   }

   public function delete($crud_id)
   {
      // dd($crud_id);
      $this->crud1Model->delete($crud_id);
      session()->setFlashdata(['message' => 'Data deleted successfully !', 'icon' => 'success']);
      return redirect()->to('/crud1');
   }

   public function edit($crud_id)
   {
      $data = [
         'title' => 'Ubah Crud1',
         'validation' => \Config\Services::validation(),
         'crud1' => $this->crud1Model->getCrud1($crud_id)
      ];

      return view('crud1/edit', $data);
   }

   public function update($crud_id)
   {
      // validasi data
      if (!$this->validate([
         'crud_name' => [
            'rules' => 'required',
            'errors' => [
               'required' => 'Field harus diisi',
               // 'is_unique' => 'crud_name sudah ada'
            ]
         ],
         'crud_desc' => [
            'rules' => 'required',
            'errors' => [
               'required' => 'Field harus diisi'
            ]
         ]
      ])) {
         $validation = \Config\Services::validation();
         return redirect()->to('/crud1/edit/' . $this->request->getVar('crud_id'))->withInput();
      }


      $this->crud1Model->save([
         'crud_id' => $crud_id,
         'crud_name' => $this->request->getVar('crud_name'),
         'crud_desc' => $this->request->getVar('crud_desc'),
      ]);

      session()->setFlashdata(['message' => 'Data updated successfully !', 'icon' => 'success']);

      return redirect()->to('/crud1');
   }

   public function simpanExcel()
   {
      $file_excel = $this->request->getFile('fileexcel');
      $ext = $file_excel->getClientExtension();
      if ($ext == 'xls') {
         $render = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
      } else {
         $render = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
      }
      $spreadsheet = $render->load($file_excel);

      $data = $spreadsheet->getActiveSheet()->toArray();
      foreach ($data as $x => $row) {
         if ($x == 0) {
            continue;
         }

         $crud_name = $row[0];
         $crud_desc = $row[1];

         $db = \Config\Database::connect();

         $simpandata = [
            'crud_name' => $crud_name, 'crud_desc' => $crud_desc
         ];

         $db->table('crud1')->insert($simpandata);
         session()->setFlashdata(['message' => 'Berhasil import file excel', 'icon' => 'success']);
      }

      return redirect()->to('/crud1');
   }

   public function downloadTemplate()
   {
      return $this->response->download(ROOTPATH . 'public\assets\excel\templateExcel.xlsx', null);
   }
}
