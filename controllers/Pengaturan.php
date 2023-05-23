<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Pengaturan extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('baseModel');
		$this->load->model('pengaturanModel');

		CekLoginAkses();
	}

	public function Index()
	{
		$data = [
			'title' => 'Pengaturan Awal Tahun'
		];

		$this->load->view('layout/header', $data);
		$this->load->view('pengaturan/pengaturan');
		$this->load->view('layout/footer');
		$this->load->view('pengaturan/javapengaturan');
	}


	public function AturPeriode()
	{
		$hasil = $this->pengaturanModel->AturPeriode();

		$this->session->set_flashdata('hasilaturperiode', $hasil);

		redirect('pengaturan');
	}


	// file upload functionality
	public function AturKalender()
	{

		$file_mimes = array(
			'text/x-comma-separated-values',
			'text/comma-separated-values',
			'application/octet-stream',
			'application/vnd.ms-excel',
			'application/x-csv',
			'text/x-csv',
			'text/csv',
			'application/csv',
			'application/excel',
			'application/vnd.msexcel',
			'text/plain',
			'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
		);
		$arr_file = explode('.', $_FILES['fileURL']['name']);
		$extension = end($arr_file);

		if (($extension == 'xlsx' || $extension == 'xls' || $extension == 'csv') && in_array($_FILES['fileURL']['type'], $file_mimes)) {

			$extension = pathinfo($_FILES['fileURL']['name'], PATHINFO_EXTENSION);

			if ($extension == 'csv') {
				$reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
			} elseif ($extension == 'xlsx') {
				$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
			} else {
				$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
			}
			// file path
			$spreadsheet = $reader->load($_FILES['fileURL']['tmp_name']);
			$allDataInSheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

			// array Count
			$arrayCount = count($allDataInSheet);
			$flag = 0;
			$createArray = array('hijri', 'masehi');
			$makeArray = array('hijri' => 'hijri', 'masehi' => 'masehi');
			$SheetDataKey = array();
			foreach ($allDataInSheet as $dataInSheet) {
				foreach ($dataInSheet as $key => $value) {
					if (in_array(trim($value), $createArray)) {
						$value = preg_replace('/\s+/', '', $value);
						$SheetDataKey[trim($value)] = $key;
					}
				}
			}
			$dataDiff = array_diff_key($makeArray, $SheetDataKey);
			if (empty($dataDiff)) {
				$flag = 1;
			}
			// match excel sheet column
			if ($flag == 1) {
				for ($i = 2; $i <= $arrayCount; $i++) {
					$hijri = $SheetDataKey['hijri'];
					$masehi = $SheetDataKey['masehi'];

					$hijri = filter_var(trim($allDataInSheet[$i][$hijri]), FILTER_SANITIZE_STRING);
					$masehi = filter_var(trim($allDataInSheet[$i][$masehi]), FILTER_SANITIZE_STRING);
					$fetchData[] = array('hijri' => $hijri, 'masehi' => $masehi);
				}
				//$data['dataInfo'] = $fetchData;
				$this->pengaturanModel->setBatchImport($fetchData);
				$this->pengaturanModel->importData();

				$this->session->set_flashdata('pesanaturkalender', 0);
			} else {
				$this->session->set_flashdata('pesanaturkalender', 1);
			}
		} else {
			$this->session->set_flashdata('pesanaturkalender', 2);
		}

		redirect('pengaturan');
	}


	public function Coba()
	{
		echo $this->baseModel->GetHijriSekarang();
	}
}
