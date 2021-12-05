<?php namespace App\Controllers;

use App\Models\NilaiModel;
use App\Models\ObatModel;
use App\Models\KriteriaModel;
use App\Models\HistoryModel;

class Hitung extends BaseController
{
	public function __construct()
	{
		$this->nilaiModel = new NilaiModel();
		$this->obatModel = new ObatModel();
		$this->kriteriaModel = new KriteriaModel();
		$this->historyModel = new HistoryModel();
		$this->session = session();
	}

	public function index()
	{
		$data = [
			'title' => 'Perhitungan SPK',
			'session' => $this->session->get()
		];

		return view('hitung/index', $data);
	}

	public function generateIDPerhitungan()
	{
		$jumlahData = count($this->historyModel->getHistory());
		if ($jumlahData == 0) {
			$jumlahData = 1;
		}
		$ID = 'P' . sprintf("%04d", $jumlahData);
		while ($this->historyModel->getHistory($ID) >= 1) {
			$jumlahData += 1;
			$ID = 'P' . sprintf("%04d", $jumlahData);
		}
		return $ID;
	}

	public function kalkulasi($print = false)
	{
		$data = [
			'title' => 'Hasil Perhitungan',
			'nilai' => $this->nilaiModel->getNilaiVariabel(),
			'kriteria' => $this->kriteriaModel->getKriteria(),
			'session' => $this->session->get()
		];

		$dataLama = $data['nilai'];

		$i = 0;
		foreach ($dataLama as $d) {
			foreach ($data['kriteria'] as $k) {
				// Mencari nilai maksimum dan minimum
				$min = min(array_column($this->nilaiModel->getNilaiByKriteriaID($k['kriteria_id']), 'variabel_nilai'));
				$max = max(array_column($this->nilaiModel->getNilaiByKriteriaID($k['kriteria_id']), 'variabel_nilai'));
				$minMax[$k['kriteria_id']]['kriteria_id'] = $k['kriteria_id'];
				$minMax[$k['kriteria_id']]['kriteria_nama'] = $k['kriteria_nama'];
				$minMax[$k['kriteria_id']]['max'] = $max;
				$minMax[$k['kriteria_id']]['min'] = $min;
				// pembagian
				if ($d['kriteria_id'] == $k['kriteria_id']) {
					$hasilKali[$d['nilai_id']]['obat_id'] = $d['obat_id'];
					$hasilKali[$d['nilai_id']]['obat_nama'] = $d['obat_nama'];
					$hasilKali[$d['nilai_id']]['kriteria_id'] = $d['kriteria_id'];
					if ($k['costbenefit'] == 'cost') {
						$dataLama[$i]['variabel_nilai'] = number_format($min / $d['variabel_nilai'], 3);
					} else {
						$dataLama[$i]['variabel_nilai'] = number_format($d['variabel_nilai'] / $max, 3);
					}
					// Dikalikan bobot
					$hasilKali[$d['nilai_id']]['hasil'] = $dataLama[$i]['variabel_nilai'] * ($k['kriteria_bobot'] / 100);
					$i++;
				}
			}
		}

		foreach ($hasilKali as $h) {
			$rekap[$h['obat_id']]['obat_id'] = $h['obat_id'];
			if ($h['kriteria_id'] == 'K01') {
				$rekap[$h['obat_id']]['obat_nama'] = $h['obat_nama'];
				$rekap[$h['obat_id']]['K01'] = number_format($h['hasil'], 3);
			} elseif ($h['kriteria_id'] == 'K02') {
				$rekap[$h['obat_id']]['K02'] = number_format($h['hasil'], 3);
			} elseif ($h['kriteria_id'] == 'K03') {
				$rekap[$h['obat_id']]['K03'] = number_format($h['hasil'], 3);
			} elseif ($h['kriteria_id'] == 'K04') {
				$rekap[$h['obat_id']]['K04'] = number_format($h['hasil'], 3);
			}
		}

		// Tambah tiap nilai kriteria
		foreach ($rekap as $r) {
			$rekap[$r['obat_id']]['hasilAkhir'] = $r['K01'] + $r['K02'] + $r['K03'] + $r['K04'];
		}

		// Mengurutkan dari nilai terbesar
		usort($rekap, function ($a, $b) {
			return $b['hasilAkhir'] <=> $a['hasilAkhir'];
		});

		$data += [
			'rekap' => $rekap,
			'obatTerpilih' => $this->obatModel->getObatSupplier($rekap[0]['obat_id']),
			'normalisasi' => $dataLama,
			'minMax' => $minMax
		];

		$history_id = $this->generateIDPerhitungan();
		if ($print == false) {
			// save hasil perhitungan
			if (session()->getFlashdata('calculation') == 'true') {
				$this->historyModel->insert([
					'history_id' => $history_id,
					'obat_id' => $data['obatTerpilih']['obat_id']
				]);
				session()->setFlashdata(['message' => 'Hasil perhitungan berhasil disimpan !', 'icon' => 'success']);
			}
			return view('hitung/hasil', $data);
		} else {
			$data = [
				'history_id' => $history_id,
				'date' => date('d-F-Y H:i:s'),
				'kriteria' => $this->kriteriaModel->getKriteria(),
				'rekap' => $rekap,
				'obatTerpilih' => $this->obatModel->getObatSupplier($rekap[0]['obat_id']),
			];

			$html = view('hitung/print_hasil', $data);
			$dompdf = new \Dompdf\Dompdf();
			$dompdf->loadHtml($html);
			$dompdf->setPaper('A4', 'portrait');
			$dompdf->render();
			$dompdf->stream('perhitungan-hasil-' . $history_id);
		}
	}

	public function history()
	{
		$data = [
			'title' => 'History Perhitungan',
			'history' => $this->historyModel->getHistoryInfo(),
			'session' => $this->session->get()
		];

		return view('hitung/history', $data);
	}

	public function print_history()
	{
		$data = [
			'title' => 'Cetak History Perhitungan',
			'history' => $this->historyModel->getHistoryInfo(),
			'date' => date('d-F-Y H:i:s'),
			'session' => $this->session->get()
		];

		$html = view('/hitung/print', $data);
		$dompdf = new \Dompdf\Dompdf();
		$dompdf->loadHtml($html);
		$dompdf->setPaper('A4', 'landscape');
		$dompdf->render();
		$dompdf->stream('perhitungan-laporan-' . date('Y-m-d'));
	}

	public function print_hasil()
	{
		$data = [
			'title' => 'Cetak History Perhitungan',
		];
	}
}
