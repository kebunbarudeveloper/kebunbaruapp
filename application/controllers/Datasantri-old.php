<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Datasantri extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('baseModel');
		$this->load->model('datasantriModel');
		$this->load->model('dataModel');
		$this->load->model('santribaruModel');

		CekLoginAkses();
	}

	public function Index()
	{
		$tipe = $this->session->userdata('tipe_user');
		$jabatan = $this->session->userdata('jabatan_user');
		$data = [
			'title' => 'Data Santri',
			'tipe' => $tipe,
			'pendidikan' => $this->dataModel->dataPendidikan($tipe),
			'domisili' => $this->dataModel->dataDomisili($tipe),
			'kabupaten' => $this->dataModel->dataKabupaten($tipe),
			'datakamar' => $this->santribaruModel->getKamar($tipe),
			'datapendidikanDiniyah' => $this->santribaruModel->getPendidikan(1, $tipe),
			'datapendidikanFormal' => $this->santribaruModel->getPendidikan(2, $tipe)
		];

		$this->load->view('layout/header', $data);
		// if ($jabatan == 1) {
		// 	$this->load->view('datasantri/datasantri');
		// } else {
		// 	$this->load->view('login/maintenance');
		// }
		$this->load->view('datasantri/datasantri');
		$this->load->view('layout/footer');
		$this->load->view('datasantri/javadatasantri');
	}


	public function loadData()
	{
		$tipe = $this->session->userdata('tipe_user');
		$data = [
			'datasantri' => $this->datasantriModel->getDataSantri($tipe)[0],
			'totalsantri' => $this->datasantriModel->getDataSantri($tipe)[1]
		];

		$this->load->view('datasantri/ajax-datasantri', $data);
	}


	public function getDetail()
	{
		$id = $this->input->post('id');
		$hasil = $this->datasantriModel->getDetail($id);
		if ($hasil) {
			$data = ['hasil' => 1, 'data' => $hasil];
		} else {
			$data = ['hasil' => 0];
		}

		echo json_encode($data);
	}


	public function getDataSantriFilter()
	{
		$tipe = $this->session->userdata('tipe_user');
		$nama = $this->input->post('nama');
		$tipex = $this->input->post('tipe');
		$pendidikan = $this->input->post('pendidikan');
		$domisili = $this->input->post('domisili');
		$kamar = $this->input->post('kamar');
		$kabupaten = $this->input->post('kabupaten');
		$status = $this->input->post('status');
		$umur = $this->input->post('umur');
		$periode = $this->input->post('periode');

		if ($tipe != 3) {
			$kondisi['where']['tipe_santri'] = $tipe;
		}
		if (!empty($nama)) {
			$kondisi['carinama']['nama'] = $nama;
		}
		if (!empty($umur)) {
			if ($umur == 16) {
				// $jadi = 'TIMESTAMPDIFF(YEAR, tanggal_lahir_santri, CURDATE()) >';
				$kondisi['where']['TIMESTAMPDIFF(YEAR, tanggal_lahir_santri, CURDATE()) >'] = $umur;
			} else {
				// $jadi = 'TIMESTAMPDIFF(YEAR, tanggal_lahir_santri, CURDATE()) <';
				$kondisi['where']['TIMESTAMPDIFF(YEAR, tanggal_lahir_santri, CURDATE()) <'] = $umur;
			}
			// $kondisi['where'][$jadi] = $umur;
		}
		if (!empty($tipex)) {
			$kondisi['where']['tipe_santri'] = $tipex;
		}
		if (!empty($pendidikan)) {
			$kondisi['where']['tingkat_diniyah'] = $pendidikan;
		}
		if ($domisili != 131) {
			$kondisi['where']['domisili_santri'] = $domisili;
		}
		if ($kamar != 121) {
			$kondisi['where']['nomor_kamar_santri'] = $kamar;
		}
		if (!empty($kabupaten)) {
			$kondisi['where']['kabupaten_santri'] = $kabupaten;
		}
		if (!empty($status)) {
			$kondisi['where']['status_santri'] = $status;
		}
		if (!empty($periode)) {
			$kondisi['where']['periode_masuk'] = $periode;
		}

		$kondisi['returnType'] = 'count';
		$data['total'] = $this->datasantriModel->getDataSantriFilter(@$kondisi);

		unset($kondisi['returnType']);
		$data['datasantri'] = $this->datasantriModel->getDataSantriFilter(@$kondisi);

		$this->load->view('datasantri/ajax-datasantrifilter', $data);
	}



	public function Coba($id)
	{
		if (is_numeric($id) == TRUE) {
			echo 'Nomor';
		} else {
			echo 'String';
		}
	}


	public function getDataSantriID()
	{
		$id = $this->input->post('id', true);
		$data = $this->datasantriModel->getDataSantriID($id);

		echo json_encode($data);
	}


	public function getDataWaliID()
	{
		// $id = $this->input->post('id', true);
		// $data = $this->datasantriModel->getDataWaliSantri($id);

		// echo json_encode($data);

		$id = $this->input->post('id', true);
		$data = $this->datasantriModel->getDataWaliSantri($id);

		$nik = $data->nik_walisantri;
		$total = $this->datasantriModel->getTotalNik($nik);

		$hasil = [$data, $total];

		echo json_encode($hasil);
	}


	public function EditDataSantri()
	{
		$id = $this->input->post('id_santri', true);
		$this->santribaruModel->EditDataSantri();

		echo $id;
	}

	public function EditDataWali()
	{
		$hasil = $this->santribaruModel->EditDataWali();

		$lagi = ['satu' => $hasil[0], 'dua' => $hasil[1]];

		echo json_encode($lagi);
	}


	public function getLink($id)
	{
		// $id = $this->input->post('id');

		// echo $id;
		$url = encrypt_url($id);

		redirect('datasantri/print/' . $url);
	}

	public function Print($idx)
	{
		$id = decrypt_url($idx);
		$ambil = $this->santribaruModel->GetEntriTerbaru($id);

		if ($ambil) {
			# code...
			$noreg = $ambil->id_santri;

			$generator = new Picqer\Barcode\BarcodeGeneratorHTML();
			$jadi =  $generator->getBarcode($noreg, $generator::TYPE_CODE_128, 2, 40);
		}

		$data = [
			'title' => 'Salinan Formulir Pendaftaran',
			'barcode' => @$jadi,
			'datanya' => $ambil
		];

		$this->load->view('print/salinanformulir', $data);
	}


	public function getLinkKTS($id)
	{
		// $id = $this->input->post('id');

		// echo $id;
		$url = encrypt_url($id);

		redirect('datasantri/kts/' . $url);
	}


	public function kts($idx)
	{
		$id = decrypt_url($idx);
		$ambil = $this->santribaruModel->GetEntriTerbaru($id);
		// $ambil = $this->santribaruModel->GetEntriTerbaru($idx);

		if ($ambil) {
			# code...
			$noreg = $ambil->id_santri;

			$generator = new Picqer\Barcode\BarcodeGeneratorHTML();
			$jadi =  $generator->getBarcode($noreg, $generator::TYPE_CODE_128, 10, 250);
		}

		$data = [
			'title' => 'Cetak KTS',
			'barcode' => @$jadi,
			'datanya' => $ambil,
			'date' => $this->baseModel->GetHijriSekarang()
		];


		$this->load->view('print/kts', $data);
	}


	public function getDataSantri()
	{
		$data = $this->db->order_by('kelas_diniyah', 'ASC')->get_where('data_santri', [
			'kelas_diniyah' => 3,
			'tingkat_diniyah' => 'Tsanawiyah',
			'tipe_santri' => 1
		])->result_object();

		$santri = [];
		$no = 400;
		foreach ($data as $datas) {
			$santri[] = [
				'id_penabung' => $no++,
				'nama_penabung' => $datas->nama_santri,
				'desa_penabung' => $datas->desa_santri,
				'kec_penabung' => $datas->kecamatan_santri,
				'kab_penabung' => $datas->kabupaten_santri,
				'kelas_penabung' => $datas->kelas_diniyah
			];
		}

		$this->db->insert_batch('data_penabung', $santri);
	}


	public function addHubungan()
	{
		$this->db->select('*')
			->from('data_santri')
			->join('data_walisantri', 'nik_walisantri = wali_santri');
		$data = $this->db->get()->result_object();

		$x = [];
		foreach ($data as $a) {
			$x[] = [
				'id_santri' => $a->id_santri,
				'hubungan_wali' => $a->hubungan_walisantri
			];
		}
		$this->db->update_batch('data_santri', $x, 'id_santri');
	}

	public function getdetailnikwali()
	{
		$nik = $this->input->post('nik', true);
		$data = [
			'data' => $this->datasantriModel->getdetailnikwali($nik)
		];
		$this->load->view('datasantri/ajax-detailwali', $data);
	}

	public function detaildatasantri()
	{
		$id = $this->input->post('id', true);
		$data = [
			'data' => $this->datasantriModel->getDetail($id)
		];
		$this->load->view('santri/ajax-detaildata', $data);
	}
}
