<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Checkinpeserta extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('baseModel');
        $this->load->model('berandaModel', 'bm');
        $this->load->model('bmModel', 'bmm');

        CekLoginAkses();
    }

    public function index()
    {
        $data = [
            'title' => 'Checkin Peserta BM'
        ];
        $this->load->view('layout/header', $data);
        $this->load->view('bm/bm');
        $this->load->view('layout/footer');
        $this->load->view('bm/javabm');
    }

    public function load()
    {
        $data = [
            'data' => $this->bmm->load()
        ];
        $this->load->view('bm/ajax', $data);
    }

    public function search()
    {
        $id = $this->input->post('id', true);
        $data = [
            'data' => $this->bmm->data($id)
        ];
        $this->load->view('bm/filter', $data);
    }


    public function save()
    {
        $id = $this->input->post('id', true);
        $wa = str_replace(['_', '-'], '', $this->input->post('wa', true));
        $hasil = $this->bmm->save($id, $wa);
    }
}
