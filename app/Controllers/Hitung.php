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

	public function kalkulasi()
	{
		$data = [
			'title' => 'Hasil Perhitungan',
			'nilai' => $this->nilaiModel->getNilaiVariabel(),
			'kriteria' => $this->kriteriaModel->getKriteria(),
			'session' => $this->session->get()
		];

		$dataLama = $data['nilai'];

		// foreach ($dataLama as $dl) {
		// 	foreach ($data['kriteria'] as $kr) {
		// 		$arr[$dl['obat_id']]['obat_id'] = $dl['obat_id'];
		// 		$arr[$dl['obat_id']]['obat_nama'] = $dl['obat_nama'];
		// 		if ($dl['kriteria_id'] == $kr['kriteria_id']) {
		// 			$arr[$dl['obat_id']][$kr['kriteria_id']] = $dl['variabel_nilai'];
		// 		}
		// 	}
		// }

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
						$dataLama[$i]['variabel_nilai'] = $min / $d['variabel_nilai'];
					} else {
						$dataLama[$i]['variabel_nilai'] = $d['variabel_nilai'] / $max;
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
				$rekap[$h['obat_id']]['K01'] = $h['hasil'];
			} elseif ($h['kriteria_id'] == 'K02') {
				$rekap[$h['obat_id']]['K02'] = $h['hasil'];
			} elseif ($h['kriteria_id'] == 'K03') {
				$rekap[$h['obat_id']]['K03'] = $h['hasil'];
			} elseif ($h['kriteria_id'] == 'K04') {
				$rekap[$h['obat_id']]['K04'] = $h['hasil'];
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

		// save hasil perhitungan
		$this->historyModel->save([
			'obat_id' => $data['obatTerpilih']['obat_id']
		]);
		session()->setFlashdata(['message' => 'Hasil perhitungan berhasil disimpan !', 'icon' => 'success']);

		return view('hitung/hasil', $data);
	}

	public function history()
	{
		$data = [
			'title' => 'History Perhitungan',
			'history' => $this->historyModel->getHistoryInfo(),
			'session' => $this->session->get()
		];

		// dd($data);
		return view('hitung/history', $data);
	}
}
