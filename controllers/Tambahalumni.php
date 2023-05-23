<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tambahalumni extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('baseModel');
		$this->load->model('dataModel');
		$this->load->model('santribaruModel');
		$this->load->library('form_validation');

		CekLoginAkses();
	}

	public function Index()
	{
		$tipe = $this->session->userdata('tipe_user');
		$data = [
			'title' => 'Tambah Data Alumni',
			'datakamar' => $this->santribaruModel->getKamar($tipe),
			'datapendidikanDiniyah' => $this->santribaruModel->getPendidikan(1, $tipe),
			'datapendidikanFormal' => $this->santribaruModel->getPendidikan(2, $tipe),
			'tipeUser' => $tipe
		];

		$this->form_validation->set_rules('niksantri', 'NIK', 'required|numeric|exact_length[16]');
		$this->form_validation->set_rules('kksantri', 'KK', 'required|numeric|exact_length[16]');
		$this->form_validation->set_rules('tempatlahirsantri', 'Tempat Lahir', 'required|alpha');
		$this->form_validation->set_rules('namasantri', 'Nama Santri', 'required');
		$this->form_validation->set_rules('tanggallahirsantri', 'Tgl.', 'required');
		$this->form_validation->set_rules('bulanlahirsantri', 'Bln.', 'required');
		$this->form_validation->set_rules('tahunlahirsantri', 'Thn.', 'required');
		$this->form_validation->set_rules('provinsisantri', 'Provinsi', 'required');
		$this->form_validation->set_rules('kecamatansantri', 'Kecamatan', 'required');
		$this->form_validation->set_rules('dusunsantri', 'Dusun', 'required');
		$this->form_validation->set_rules('kabupatensantri', 'Kabupaten/Kota', 'required');
		$this->form_validation->set_rules('desasantri', 'Desa', 'required');
		$this->form_validation->set_rules('rtsantri', 'RT', 'required');
		$this->form_validation->set_rules('rwsantri', 'RW', 'required');
		$this->form_validation->set_rules('kodepossantri', 'Kode POS', 'required|numeric');
		$this->form_validation->set_rules('tanggalmasukalumni', 'Tgl.', 'required');
		$this->form_validation->set_rules('bulanmasukalumni', 'Bln.', 'required');
		$this->form_validation->set_rules('tahunmasukalumni', 'Thn.', 'required');
		$this->form_validation->set_rules('tanggalboyongalumni', 'Tgl.', 'required');
		$this->form_validation->set_rules('bulanboyongalumni', 'Bln.', 'required');
		$this->form_validation->set_rules('tahunboyongalumni', 'Thn.', 'required');

		if ($this->form_validation->run() == FALSE) {

			$this->load->view('layout/header', $data);
			$this->load->view('tambahalumni/tambahalumni');
			$this->load->view('layout/footer');
			$this->load->view('tambahalumni/javatambahalumni');
		} else {
			//Proses Tambah Santri Baru
			//$hasil = $this->santribaruModel->TambahSantriBaru();

			//$this->session->set_flashdata('sukses', 'Satu data berhasil ditambhkan');

			//$url = encrypt_url($hasil);

			//redirect('santribaru/hasilentri/' . $url);
			echo 'Berhasil';
		}
	}


	public function GetProvinsi()
	{
		if (isset($_GET['term'])) {
			$result = $this->dataModel->GetProvinsi($_GET['term']);
			if (count($result) > 0) {
				foreach ($result as $row)
					$arr_result[] = array(
						'label'         => $row->nama,
						'description'   => $row->id,
					);
				echo json_encode($arr_result);
			}
		}
	}

	public function GetKab($id)
	{
		if (isset($_GET['term'])) {
			$result = $this->dataModel->GetKab($id, $_GET['term']);
			if (count($result) > 0) {
				foreach ($result as $row)
					$arr_result[] = array(
						'label'         => $row->nama,
						'description'   => $row->id,
					);
				echo json_encode($arr_result);
			}
		}
	}


	public function GetKec($id)
	{
		if (isset($_GET['term'])) {
			$result = $this->dataModel->GetKec($id, $_GET['term']);
			if (count($result) > 0) {
				foreach ($result as $row)
					$arr_result[] = array(
						'label'         => $row->nama,
						'description'   => $row->id,
					);
				echo json_encode($arr_result);
			}
		}
	}


	public function GetDesa($id)
	{
		if (isset($_GET['term'])) {
			$result = $this->dataModel->GetDesa($id, $_GET['term']);
			if (count($result) > 0) {
				foreach ($result as $row)
					$arr_result[] = array(
						'label'         => $row->nama,
						'description'   => $row->kode_pos
					);
				echo json_encode($arr_result);
			}
		}
	}
}