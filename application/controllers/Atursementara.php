<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Atursementara extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('baseModel');
        $this->load->model('atursementaraModel');


        $loginid = $this->session->userdata('id_user');
        if ($loginid == FALSE) {
            redirect('login');
        }
    }

    public function coba()
    {
        $ada = $this->baseModel->SetHariIni();

        echo $ada;
    }

    public function Index()
    {
        $data = [
            'title' => 'Pengaturan',
            'data' => $this->atursementaraModel->getData()
        ];

        $this->load->view('layout/header', $data);
        $this->load->view('atursementara/atursementara');
        $this->load->view('layout/footer');
        $this->load->view('atursementara/javaatursementara');
    }


    public function Simpan()
    {
        $this->atursementaraModel->simpan();

        redirect('atursementara');
    }
}
