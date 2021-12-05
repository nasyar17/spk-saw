<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\SupplierModel;

class Supplier extends Controller
{

   public function __construct()
   {
      $this->supplierModel = new SupplierModel();
      $this->session = session();
   }

   public function index()
   {
      $data = [
         'title' => 'Supplier',
         'supplier' => $this->supplierModel->getSupplier(),
         'session' => $this->session->get()
      ];
      return view('supplier/index', $data);
   }

   public function generateIDSupplier()
   {
      $jumlahData = count($this->supplierModel->getSupplier());
      if ($jumlahData == 0) {
         $jumlahData = 1;
      }
      $ID = 'SP' . sprintf("%03d", $jumlahData);
      while ($this->supplierModel->getSupplier($ID) >= 1) {
         $jumlahData += 1;
         $ID = 'SP' . sprintf("%03d", $jumlahData);
      }
      return $ID;
   }

   public function tambah()
   {
      $data = [
         'title' => 'Form Tambah Supplier',
         'supplier_id' => $this->generateIDSupplier(),
         'validation' => \Config\Services::validation(),
         'session' => $this->session->get()
      ];
      return view('supplier/tambah', $data);
   }

   public function save()
   {
      if (!$this->validate([
         'supplier_nama' => [
            'rules' => 'required',
            'errors' => [
               'required' => 'Field harus diisi',
            ]
         ],
         'supplier_id' => [
            'rules' => 'required',
            'errors' => [
               'required' => 'Field harus diisi'
            ]
         ],
         'supplier_alamat' => [
            'rules' => 'required|max_length[150]',
            'errors' => [
               'required' => 'Field harus diisi',
               'max_length' => 'Maksimal 150 karakter'
            ]
         ],
         'supplier_waktupengiriman' => [
            'rules' => 'required|numeric',
            'errors' => [
               'required' => 'Field harus diisi'
            ]
         ]
      ])) {
         $validation = \Config\Services::validation();
         return redirect()->to('/supplier/tambah')->withInput();
      }

      $data = [
         'supplier_id' => $this->request->getVar('supplier_id'),
         'supplier_nama' => $this->request->getVar('supplier_nama'),
         'supplier_alamat' => $this->request->getVar('supplier_alamat'),
         'supplier_waktupengiriman' => $this->request->getVar('supplier_waktupengiriman'),
      ];

      $this->supplierModel->insert($data);
      session()->setFlashdata(['message' => 'Data berhasil ditambah !', 'icon' => 'success']);
      return redirect()->to('/supplier');
   }

   public function delete($supplier_id)
   {
      $this->supplierModel->delete($supplier_id);
      session()->setFlashdata(['message' => 'Data deleted successfully !', 'icon' => 'success']);
      return redirect()->to('/supplier');
   }

   public function edit($supplier_id)
   {
      $data = [
         'title' => 'Form Ubah Supplier',
         'validation' => \Config\Services::validation(),
         'supplier' => $this->supplierModel->getSupplier($supplier_id),
         'session' => $this->session->get()
      ];

      return view('supplier/edit', $data);
   }

   public function update($supplier_id)
   {
      // validasi data
      if (!$this->validate([
         'supplier_nama' => [
            'rules' => 'required',
            'errors' => [
               'required' => 'Field harus diisi',
               // 'is_unique' => 'supplier_nama sudah ada'
            ]
         ],
         'supplier_alamat' => [
            'rules' => 'required|max_length[150]',
            'errors' => [
               'required' => 'Field harus diisi',
               'max_length' => 'Maksimal 150 karakter'
            ]
         ],
         'supplier_waktupengiriman' => [
            'rules' => 'required|numeric',
            'errors' => [
               'required' => 'Field harus diisi'
            ]
         ]
      ])) {
         $validation = \Config\Services::validation();
         return redirect()->to('/supplier/edit/' . $this->request->getVar('supplier_id'))->withInput();
      }


      $this->supplierModel->save([
         'supplier_id' => $supplier_id,
         'supplier_nama' => $this->request->getVar('supplier_nama'),
         'supplier_alamat' => $this->request->getVar('supplier_alamat'),
         'supplier_waktupengiriman' => $this->request->getVar('supplier_waktupengiriman'),
      ]);

      session()->setFlashdata(['message' => 'Data updated successfully !', 'icon' => 'success']);

      return redirect()->to('/supplier');
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

         $supplier_id = $this->generateIDSupplier();
         $supplier_nama = $row[0];
         $supplier_alamat = $row[1];
         $supplier_waktupengiriman = $row[2];

         $db = \Config\Database::connect();

         $simpandata = [
            'supplier_id' => $supplier_id,
            'supplier_nama' => $supplier_nama,
            'supplier_alamat' => $supplier_alamat,
            'supplier_waktupengiriman' => $supplier_waktupengiriman
         ];

         $db->table('supplier')->insert($simpandata);
         session()->setFlashdata(['message' => 'Berhasil import file excel', 'icon' => 'success']);
      }

      return redirect()->to('/supplier');
   }

   public function downloadTemplate()
   {
      return $this->response->download(ROOTPATH . 'public\assets\excel\supplier-templateExcel.xlsx', null);
   }

   public function print()
   {
      $data = [
         'title' => 'Laporan Master Supplier',
         'supplier' => $this->supplierModel->getSupplier(),
         'date' => date('d-F-Y H:i:s'),
         'session' => $this->session->get()
      ];
      // return view('supplier/print', $data);

      $html = view('/supplier/print', $data);
      $dompdf = new \Dompdf\Dompdf();
      $dompdf->loadHtml($html);
      $dompdf->setPaper('A4', 'portrait');
      $dompdf->render();
      $dompdf->stream('supplier-laporan-' . date('Y-m-d'));
   }
}
