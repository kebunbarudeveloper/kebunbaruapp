<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Petunjuk extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('baseModel');
		$this->load->model('berandaModel', 'bm');

		CekLogin();
	}


	public function index()
	{
		$data = [
			'title' => 'Petunjuk Registrasi Online'
		];

		$this->load->view('layout/header', $data);
		$this->load->view('petunjuk/petunjuk');
		$this->load->view('layout/footer');
		$this->load->view('petunjuk/javapetunjuk');
	}


	public function pembayaran()
	{
		$data = [
			'title' => 'Petunjuk Pembayaran Santri Baru'
		];

		$this->load->view('layout/header', $data);
		$this->load->view('petunjuk/pembayaran');
		$this->load->view('layout/footer');
		$this->load->view('petunjuk/javapetunjuk');
	}
}