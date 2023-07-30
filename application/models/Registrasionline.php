<?php

use PhpOffice\PhpSpreadsheet\Reader\Xls\MD5;

defined('BASEPATH') or exit('No direct script access allowed');

class Registrasionline extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('baseModel');
		$this->load->model('dataModel');
		$this->load->model('onlineModel', 'om');
		$this->load->library('form_validation');

		CekLoginAkses();
	}


	public function index()
	{

		$data = [
			'title' => 'Data Pendaftar Online',
			'data' => $this->om->getData()
		];

		$this->load->view('layout/header', $data);
		$this->load->view('registrasionline/registrasionline');
		$this->load->view('layout/footer');
		$this->load->view('registrasionline/javaregistrasionline');
	}


	public function proses($id)
	{
		$data =  $this->om->getDetail($id);

		//echo $data->id_santri;

		$this->om->ubahStatus($id);

		$this->om->proses($data);

		$this->session->set_flashdata('sukses', 'Satu data berhasil diproses');

		redirect('registrasionline');
	}
}