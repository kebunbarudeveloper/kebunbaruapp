<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Development extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('baseModel');

        CekLogin();
    }

    public function index()
    {
        $data = [
            'title' => 'Informasi Pembaruan',
            'aktifdev' => 'active'
        ];
        $this->load->view('layout/header', $data);
        $this->load->view('development/index');
        $this->load->view('layout/footer');
        $this->load->view('development/java');
    }
}
