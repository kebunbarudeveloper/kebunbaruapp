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
		// CekLogin();
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
			'datapendidikanFormal' => $this->santribaruModel->getPendidikan(2, $tipe),
			'jabatan' => $jabatan
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
		$jabatan = $this->session->userdata('jabatan_user');
		$data = [
			'datasantri' => $this->datasantriModel->getDataSantri($tipe, $jabatan)[0],
			'totalsantri' => $this->datasantriModel->getDataSantri($tipe, $jabatan)[1]
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
		$jabatan = $this->session->userdata('jabatan_user');
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

		if ($jabatan == 46 || $jabatan == 47) {
			$kondisi['where']['periode_masuk'] = $this->baseModel->GetPeriode();
		} else {
			if (!empty($periode)) {
				$kondisi['where']['periode_masuk'] = $periode;
			}
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

	public function print($idx)
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


	public function printout()
	{
		$id = $this->input->post('idSantri');
		$tipe = $this->input->post('tipe');

		// echo $id;
		$url = encrypt_url($id);

		if ($tipe == 1) {
			redirect('datasantri/print/' . $url);
		} elseif ($tipe == 2) {
			redirect('datasantri/kts/' . $url);
		} else {
			redirect('datasantri/keterangan/' . $url);
		}
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
		$data = $this->db->get('data_santri')->result_object();

		$santri = [];
		foreach ($data as $datas) {
			$santri[] = [
				'santri_id' => $datas->id_santri,
				'kb' => $datas->nomor_kamar_santri,
				'db' => $datas->domisili_santri
			];
		}

		$this->db->update_batch('riwayat_kamar', $santri, 'santri_id');
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
		$this->load->view('datasantri/ajax-detaildata', $data);
	}


	public function keterangan($idx)
	{
		$id = decrypt_url($idx);
		$ambil = $this->santribaruModel->GetEntriTerbaru($id);

		$data = [
			'title' => 'Surat Keterangan',
			'data' => $ambil
		];


		$this->load->view('print/keterangan', $data);
	}

	public function ddddd()
	{
		$this->db->select('*')->from('data_santri')->join('data_walisantri', 'nik_walisantri = wali_santri');
		// $this->db->where('id_santri', 28102517);
		$data = $this->db->get()->result_object();

		$rows = [];
		foreach ($data as $d) {
			$rows[] = [
				'id' => $d->id_santri,
				'induk' => $d->induk_santri,
				'jenis' => $d->tipe_santri,
				'registrasi' => $d->no_reg_santri,
				'tanggal_masuk' => $d->tanggal_masuk,
				'periode' => $d->periode_masuk,
				'nik' => $d->nik_santri,
				'kk' => $d->kk_santri,
				'nama' => $d->nama_santri,
				'tempat' => $d->tempat_lahir_santri,
				'tanggal' => $d->tanggal_lahir_santri,
				'dusun' => $d->dusun_santri,
				'rt' => $d->rt_santri,
				'rw' => $d->rw_santri,
				'desa' => $d->desa_santri,
				'kecamatan' => $d->kecamatan_santri,
				'kabupaten' => $d->kabupaten_santri,
				'provinsi' => $d->provinsi_santri,
				'pos' => $d->kode_pos_santri,
				'pendidikan' => $d->pendidikan_akhir_santri,
				'status_domisili' => $d->status_domisili_santri,
				'domisili' => $d->domisili_santri,
				'kamar' => $d->nomor_kamar_santri,
				'kelas' => $d->kelas_diniyah,
				'tingkat' => $d->kelas_diniyah,
				'kelas_formal' => $d->kelas_formal,
				'tingkat_formal' => $d->tingkat_formal,
				'ayah' => $d->ayah_santri,
				'ibu' => $d->ibu_santri,
				'wali_id' => $d->id_walisantri,
				'hubungan' => $d->hubungan_wali,
				'status' => $d->status_santri,
				'panitia' => $d->panitia_santri
			];
		}

		// var_dump($rows);
		$this->db->insert_batch('students', $rows);
	}

	public function www()
	{
		$walis = $this->db->get('data_walisantri')->result_object();

		$rows = [];
		foreach ($walis as $wali) {
			$rows[] = [
				'id' => $wali->id_walisantri,
				'nik' => $wali->nik_walisantri,
				'nama' => $wali->nama_walisantri,
				'phone' => $wali->nomor_hp_walisantri,
				'dusun' => $wali->dusun_walisantri,
				'rt' => $wali->rt_walisantri,
				'rw' => $wali->rw_walisantri,
				'desa' => $wali->desa_walisantri,
				'kecamatan' => $wali->kecamatan_walisantri,
				'kabupaten' => $wali->kabupaten_walisantri,
				'provinsi' => $wali->provinsi_walisantri,
				'pos' => $wali->kode_pos_walisantri,
				'pendidikan' => $wali->pendidikan_akhir_walisantri,
				'pekerjaan' => $wali->pekerjaan_walisantri,
			];
		}

		$this->db->insert_batch('walis', $rows);
	}

	// public function setRiwayat()
	// {
	// 	$get = $this->db->get_where('data_santri', [
	// 		'status_santri' => 1,
	// 		'periode_masuk !=' => '1444-1445'
	// 	])->result_object();

	// 	foreach ($get as $d) {
	// 		$this->db->insert('riwayat_kelas', [
	// 			'santri_id' => $d->id_santri,
	// 			'kelas' => $d->kelas_diniyah,
	// 			'tingkat' => $d->tingkat_diniyah,
	// 			'kelasf' => $d->kelas_formal,
	// 			'tingkatf' => $d->tingkat_formal,
	// 			'periode' => '1443-1444',
	// 			'ket' => 'Tutup periode',
	// 		]);
	// 	}
	// }

	// public function setInduk()
	// {
	// 	$d = $this->db->get_where('data_santri', [
	// 		'tahun_masuk' => '1444', 'tipe_santri' => 1
	// 	])->result_object();
	// 	foreach ($d as $dd) {
	// 		$this->db->where('id_santri', $dd->id_santri)->update('data_santri', [
	// 			'induk_santri' => $dd->tahun_masuk . '' . $dd->urut_santri
	// 		]);
	// 	}
	// }
}
