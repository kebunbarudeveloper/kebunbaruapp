<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Block extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('baseModel');

        //Helper Cek Login
        CekLogin();
    }


    public function Index()
    {
        $data = [
            'title' => 'Akses Dihentikan',
            // 'aktifberanda' => 'active'
        ];

        $this->load->view('layout/header', $data);
        $this->load->view('login/block');
        $this->load->view('layout/footer');
        $this->load->view('login/javablock');
    }

    public function dev()
    {
        $data = [
            'title' => 'Akses Dihentikan',
            // 'aktifberanda' => 'active'
        ];

        $this->load->view('layout/header', $data);
        $this->load->view('login/maintenance');
        $this->load->view('layout/footer');
        $this->load->view('login/javablock');
    }
}
