<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rekapitulasi extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('baseModel');
		$this->load->model('rekapitulasiModel', 'rm');

		CekLoginAkses();
	}

	public function Index()
	{
		$tipe = $this->session->userdata('tipe_user');
		$data = [
			'title' => 'Rekapitulasi Pembayaran',
			'rekap' => $this->rm->rekap($tipe),
			'pondok' => $this->rm->pondok($tipe),
			'idad' => $this->rm->idad($tipe),
			'ts' => $this->rm->ts($tipe)
		];

		$this->load->view('layout/header', $data);
		$this->load->view('rekapitulasi/rekapitulasi');
		$this->load->view('layout/footer');
		$this->load->view('rekapitulasi/javarekapitulasi');
	}
}