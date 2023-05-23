<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Danapendidikan extends CI_Controller
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
            'title' => 'Dana Pendidikan'
        ];

        $this->load->view('layout/header', $data);
        $this->load->view('danapendidikan/danapendidikan');
        $this->load->view('layout/footer');
        $this->load->view('danapendidikan/javadanapendidikan');
    }


    public function loadData()
    {
        $this->load->view('danapendidikan/ajax-danapendidikan');
    }
}