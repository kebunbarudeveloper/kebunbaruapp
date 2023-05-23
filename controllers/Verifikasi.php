<?php

use PhpOffice\PhpSpreadsheet\Reader\Xls\MD5;

defined('BASEPATH') or exit('No direct script access allowed');

class Verifikasi extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('baseModel');
		$this->load->model('dataModel');
		$this->load->model('santribaruModel');
		$this->load->model('verifikasiModel', 'vm');
		$this->load->library('form_validation');

		CekLoginAkses();
	}

	public function index()
	{
		$tipe = $this->session->userdata('tipe_user');
		$data = [
			'title' => 'Registrasi Online'
		];

		$this->load->view('layout/header', $data);
		$this->load->view('verifikasi/verifikasi');
		$this->load->view('layout/footer');
		$this->load->view('verifikasi/javaverifikasi');
	}


	public function proses()
	{
		$tipe = $this->session->userdata('tipe_user');
		$id = $this->input->post('id', true);

		$cek = $this->vm->cekNomorRegistrasi($id);
		if ($cek != 0) {
			$jenis = $cek->jenis;
			if ($jenis != $tipe) {
				$this->session->set_flashdata('error', 'Login Anda tidak punya hak akses');
			} elseif ($cek->status > 0) {
				$this->session->set_flashdata('sukses', $id);
			} else {
				$hasil = $this->vm->prosesData($cek);
				$this->vm->ubahStatus($id, $hasil);
				$this->session->set_flashdata('sukses', $id);
			}
			// $this->session->set_flashdata('sukses', $id);
		} else {
			$this->session->set_flashdata('error', 'Nomor Registrasi tidak ditemukan');
		}

		redirect('verifikasi');
	}
}