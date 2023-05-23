<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Hapusdata extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('baseModel');
        $this->load->model('hapusdataModel', 'hdm');

        CekLoginAkses();
    }

    public function index()
    {
        $data = [
            'title' => 'Hapus Data Santri'
        ];
        $this->load->view('layout/header', $data);
        $this->load->view('hapusdata/hapusdata');
        $this->load->view('layout/footer');
        $this->load->view('hapusdata/javahapusdata');
    }

    public function cekdata()
    {
        $hasil = $this->hdm->cekdata();

        echo json_encode($hasil);
    }

    public function simpan()
    {
        $hasil = $this->hdm->simpan();

        echo json_encode($hasil);
    }
}
