<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cekdata extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('baseModel');
        $this->load->model('kamtibModel', 'km');

        CekLoginAkses();
    }

    public function index()
    {
        $data = [
            'title' => 'Cek Data Santri'
        ];

        $this->load->view('layout/header', $data);
        $this->load->view('cekdata/cekdata');
        $this->load->view('layout/footer');
        $this->load->view('cekdata/javacekdata');
    }

    public function loadData()
    {
        $loadData = $this->km->loadDataSantri();

        $data = [
            'datasantri' => $loadData
        ];

        $this->load->view('cekdata/ajax-cekdata', $data);
    }
}
