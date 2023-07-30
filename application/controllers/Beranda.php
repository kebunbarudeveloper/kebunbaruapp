<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Beranda extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('baseModel');
		$this->load->model('berandaModel', 'bm');

		// CekLogin();
	}

	public function Index()
	{
		$periode  = $this->baseModel->GetPeriode();
		$tipe = $this->session->userdata('tipe_user');
		$user = $this->session->userdata('jabatan_user');
		$total = $this->bm->getTotalSantri();
		$baru = $this->bm->getTotalSantriBaru($periode);
		$data = [
			'title' => 'Sistem Pengelolaan Data',
			'aktifberanda' => 'active',
			'namaUser' => $this->session->userdata('nama_user'),
			'jabatanUser' => $this->session->userdata('namajabatan_user'),
			'totalsantri' => $total,
			'santribaru' => $baru,
			'perkab' => $this->bm->getPerKab(),
			'domisili' => $this->bm->getKamar($tipe),
			'tipe' => $tipe
		];

		$idUser = $this->session->userdata('id_user');
		$this->load->view('layout/header', $data);
		if (!$user) {
			$this->load->view('beranda/beranda');
			// } elseif ($idUser == '15c6fedcd87d6d0') {
			// 	$this->load->view('beranda/love');
			// } elseif ($idUser == '758e8eaa0c7896a') {
			// 	$this->load->view('beranda/love');
			// } 
		} else {
			$this->load->view('beranda/index');
		}
		$this->load->view('layout/footer');
		$this->load->view('beranda/javaberanda');
	}


	public function kategori()
	{
		$tipe = $this->session->userdata('tipe_user');
		$data = [
			'perkab' => $this->bm->getDataPerKab($tipe)
		];
		$this->load->view('beranda/kategori', $data);
	}

	public function detail()
	{
		$tipe = $this->session->userdata('tipe_user');
		$data = [
			'data' => $this->bm->getDataDetail($tipe)
		];
		$this->load->view('beranda/ajax-detail', $data);
	}

	public function detailkamar()
	{
		$tipe = $this->session->userdata('tipe_user');
		$data = [
			'data' => $this->bm->getDataDetailKamar($tipe)
		];
		$this->load->view('beranda/ajax-kamar', $data);
	}

	public function coba()
	{
		$id = '129091ae4d9f266';
		$password = password_hash('01478', PASSWORD_DEFAULT);
		$this->db->where('id_pengguna', $id)->update('data_pengguna', ['password' => $password]);
	}
}
