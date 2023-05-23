<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Akunkeuangan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('baseModel');
        $this->load->model('akunkeuanganModel');

        CekLoginAkses();
    }


    public function Index()
    {
        $data = [
            'title' => 'Atur Akun Keuangan'
        ];

        $this->load->view('layout/header', $data);
        $this->load->view('akunkeuangan/akunkeuangan');
        $this->load->view('layout/footer');
        $this->load->view('akunkeuangan/javaakunkeuangan');
    }


    public function GetData()
    {
        $ambil = $this->akunkeuanganModel->GetData();
        $data = [
            'datapendapatan' => $ambil[0],
            'databelanja' => $ambil[1]
        ];

        $this->load->view('akunkeuangan/ajax-akun', $data, false);
    }


    public function TambahAkun()
    {
        $hasil = $this->akunkeuanganModel->TambahAkun();

        echo json_encode($hasil);
    }


    public function Coba($id)
    {
        $coba = $this->akunkeuanganModel->GetKode($id);

        echo $coba;
    }
}
