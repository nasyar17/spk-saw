<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ObatModel;
use App\Models\SupplierModel;
use App\Models\HistoryModel;

class Dashboard extends Controller
{

    public function __construct()
    {
        $this->obatModel = new ObatModel();
        $this->supplierModel = new SupplierModel();
        $this->historyModel = new HistoryModel();
        $this->session = session();
    }

    public function index()
    {
        $session = session();
        $data = [
            'title' => 'Dashboard',
            'name' => $session->get('user_name'),
            'rekap' => [
                'jmlObat' => $this->obatModel->countAllResults(),
                'jmlSupplier' => $this->supplierModel->countAllResults(),
                'jmlPerhitungan' => $this->historyModel->countAllResults()
            ],
            'history' => $this->historyModel->getHistoryInfo(1),
            'mostFrequent' => $this->historyModel->getMostFrequentResult(),
            'session' => $this->session->get()
        ];

        return view('dashboard', $data);
    }
}
