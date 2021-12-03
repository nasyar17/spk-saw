<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ObatModel;
use App\Models\SupplierModel;
use App\Models\KriteriaModel;
use App\Models\VariabelModel;
use App\Models\NilaiModel;

class Obat extends Controller
{

   public function __construct()
   {
      $this->obatModel = new ObatModel();
      $this->supplierModel = new SupplierModel();
      $this->kriteriaModel = new KriteriaModel();
      $this->variabelModel = new VariabelModel();
      $this->nilaiModel = new NilaiModel();
      $this->session = session();
   }

   public function index()
   {
      $data = [
         'title' => 'Obat',
         'kriteria' => $this->kriteriaModel->getKriteria(),
         'obat' => $this->obatModel->getObat(),
         'nilai' => $this->nilaiModel->getNilaiFull(),
         'session' => $this->session->get()
      ];

      return view('obat/index', $data);
   }

   public function generateIDObat()
   {
      $jumlahData = count($this->obatModel->getObat());
      if ($jumlahData == 0) {
         $jumlahData = 1;
      }
      $ID = 'A' . sprintf("%04d", $jumlahData);
      while ($this->obatModel->getObat($ID) >= 1) {
         $jumlahData += 1;
         $ID = 'A' . sprintf("%04d", $jumlahData);
      }
      return $ID;
   }

   public function tambah()
   {
      $data = [
         'title' => 'Form Tambah Obat',
         'obat_id' => $this->generateIDObat(),
         'supplier' => $this->supplierModel->getSupplier(),
         'kriteria' => $this->kriteriaModel->getKriteria(),
         'variabel' => $this->variabelModel->getVariabel(),
         'validation' => \Config\Services::validation()
      ];

      return view('obat/tambah', $data);
   }

   public function save()
   {
      // dd($_POST);
      if (!$this->validate([
         'obat_nama' => [
            // 'rules' => 'required|is_unique[obat.obat_id]',
            'rules' => 'required',
            'errors' => [
               'required' => 'Field harus diisi',
               // 'is_unique' => 'obat_id sudah ada'
            ]
         ],
         'supplier_id' => [
            'rules' => 'required',
            'errors' => [
               'required' => 'Field harus diisi'
            ]
         ]
      ])) {
         $validation = \Config\Services::validation();
         return redirect()->to('/obat/tambah')->withInput();
      }

      $data = [
         'obat_id' => $this->request->getVar('obat_id'),
         'obat_nama' => $this->request->getVar('obat_nama'),
         'supplier_id' => $this->request->getVar('supplier_id'),
      ];

      $obat_id = $this->request->getVar('obat_id');

      $nilai = [
         [
            'obat_id' => $obat_id,
            'kriteria_id' => 'K01',
            'variabel_id' => $this->request->getVar('K01')
         ],
         [
            'obat_id' => $obat_id,
            'kriteria_id' => 'K02',
            'variabel_id' => $this->request->getVar('K02')
         ], [
            'obat_id' => $obat_id,
            'kriteria_id' => 'K03',
            'variabel_id' => $this->request->getVar('K03')
         ], [
            'obat_id' => $obat_id,
            'kriteria_id' => 'K04',
            'variabel_id' => $this->request->getVar('K04')
         ],
      ];
      $this->nilaiModel->insertBatch($nilai);

      $this->obatModel->insert($data);
      session()->setFlashdata(['message' => 'Data berhasil ditambah !', 'icon' => 'success']);
      return redirect()->to('/obat');
   }

   public function delete($obat_id)
   {
      $this->obatModel->delete($obat_id);
      $this->nilaiModel->deleteObat($obat_id);
      session()->setFlashdata(['message' => 'Data deleted successfully !', 'icon' => 'success']);
      return redirect()->to('/obat');
   }

   public function edit($obat_id)
   {
      $data = [
         'title' => 'Ubah Obat',
         'supplier' => $this->supplierModel->getSupplier(),
         'kriteria' => $this->kriteriaModel->getKriteria(),
         'variabel' => $this->variabelModel->getVariabel(),
         'nilai' => $this->nilaiModel->getNilaiByObatID($obat_id),
         'validation' => \Config\Services::validation(),
         'obat' => $this->obatModel->getObat($obat_id)
      ];

      return view('obat/edit', $data);
   }

   public function update($obat_id)
   {
      // validasi data
      if (!$this->validate([
         'obat_nama' => [
            'rules' => 'required',
            'errors' => [
               'required' => 'Field harus diisi',
               // 'is_unique' => 'obat_nama sudah ada'
            ]
         ],
         'supplier_id' => [
            'rules' => 'required',
            'errors' => [
               'required' => 'Field harus diisi'
            ]
         ]
      ])) {
         $validation = \Config\Services::validation();
         return redirect()->to('/obat/edit/' . $this->request->getVar('obat_id'))->withInput();
      }


      $this->obatModel->save([
         'obat_id' => $obat_id,
         'obat_nama' => $this->request->getVar('obat_nama'),
         'supplier_id' => $this->request->getVar('supplier_id'),
      ]);

      $obat_id = $this->request->getVar('obat_id');
      $nilai_id = $this->request->getVar('nilai_id_awal');
      $nilai = [
         [
            'nilai_id' => $nilai_id++,
            'kriteria_id' => 'K01',
            'variabel_id' => $this->request->getVar('K01')
         ],
         [
            'nilai_id' => $nilai_id++,
            'kriteria_id' => 'K02',
            'variabel_id' => $this->request->getVar('K02')
         ], [
            'nilai_id' => $nilai_id++,
            'kriteria_id' => 'K03',
            'variabel_id' => $this->request->getVar('K03')
         ], [
            'nilai_id' => $nilai_id,
            'kriteria_id' => 'K04',
            'variabel_id' => $this->request->getVar('K04')
         ],
      ];

      $this->nilaiModel->updateBatch($nilai, 'nilai_id');

      session()->setFlashdata(['message' => 'Data updated successfully !', 'icon' => 'success']);

      return redirect()->to('/obat');
   }

   public function simpanExcel()
   {
      $file_excel = $this->request->getFile('obatexcel');
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

         $obat_id = $this->generateIDObat();
         $obat_nama = $row[0];
         $supplier_id = $row[1];
         $K01 = $row[2];
         $K02 = $row[3];
         $K03 = $row[4];
         $K04 = $row[5];

         $simpandata = [
            'obat_id' => $obat_id,
            'supplier_id' => $supplier_id,
            'obat_nama' => $obat_nama
         ];

         $nilai = [
            [
               'obat_id' => $obat_id,
               'kriteria_id' => 'K01',
               'variabel_id' => $K01
            ],
            [
               'obat_id' => $obat_id,
               'kriteria_id' => 'K02',
               'variabel_id' => $K02
            ], [
               'obat_id' => $obat_id,
               'kriteria_id' => 'K03',
               'variabel_id' => $K03
            ], [
               'obat_id' => $obat_id,
               'kriteria_id' => 'K04',
               'variabel_id' => $K04
            ],
         ];

         $this->obatModel->insert($simpandata);
         $this->nilaiModel->insertBatch($nilai);

         session()->setFlashdata(['message' => 'Berhasil import file excel', 'icon' => 'success']);
      }

      return redirect()->to('/obat');
   }

   public function downloadTemplate()
   {
      return $this->response->download(ROOTPATH . 'public\assets\excel\obat-templateExcel.xlsx', null);
   }
}
