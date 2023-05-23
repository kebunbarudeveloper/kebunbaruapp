<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Suratijin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('baseModel');
        $this->load->model('suratijinModel', 'sim');
        $this->load->model('kamtibModel', 'km');

        CekLoginAkses();
    }

    public function index()
    {
        $data = [
            'title' => 'Surat Ijin Liburan',
            'hasil' => $this->sim->data(),
            'data' => $this->km->getliburan(),
            'jadwal' => $this->km->getjadwal()
        ];

        $this->load->view('layout/header', $data);
        $this->load->view('suratijin/suratijin');
        $this->load->view('layout/footer');
        $this->load->view('suratijin/javasuratijin');
    }

    public function save()
    {
        $simpan = $this->sim->save();
        $hasil = ['hasil' => $simpan];

        echo json_encode($hasil);
    }


    public function getid()
    {
        $data = [
            'hasil' => $this->sim->getID()
        ];
        $this->load->view('suratijin/ajax-suratijin', $data);
    }


    public function getdata()
    {
        $data = [
            'hasil' => $this->sim->data()
        ];
        $this->load->view('suratijin/ajax-data', $data);
    }


    public function getsantrijadwal()
    {
        $data = [
            'hasil' => $this->sim->datajadwal()[0],
            'liburan' => $this->sim->datajadwal()[1]
        ];
        $this->load->view('suratijin/ajax-semua', $data);
    }

    public function getsantrijadwalstatus()
    {
        $data = [
            'hasil' => $this->sim->datajadwalstatus()
        ];
        $this->load->view('suratijin/ajax-filter', $data);
    }

    public function batal()
    {
        $this->sim->batal();
    }
}
