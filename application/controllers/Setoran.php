<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Setoran extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('baseModel');
        $this->load->model('setoranModel', 'sm');

        CekLoginAkses();
    }

    public function index()
    {
        $data = [
            'title' => 'Setoran Indekos Nasi',
            'data' => $this->sm->getsetoran()
        ];
        $this->load->view('layout/header', $data);
        $this->load->view('setoran/setoran');
        $this->load->view('layout/footer');
        $this->load->view('setoran/javasetoran');
    }


    public function load()
    {
        $data = [
            'data' => 'Data sementara'
        ];
        $this->load->view('setoran/ajax-setoran', $data);
    }

    public function getid()
    {
        $data = [
            'data' => $this->sm->getid()
        ];
        $this->load->view('setoran/ajax-cek', $data);
    }

    public function cekid()
    {
        $id = $this->input->post('id', true);
        $result = $this->sm->cekid($id);

        echo json_encode($result);
    }
}
