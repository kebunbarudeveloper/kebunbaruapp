<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kembalian extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('baseModel');
        $this->load->model('kamtibModel', 'km');
        $this->load->model('kembalianModel', 'kem');

        CekLoginAkses();
    }

    public function index()
    {
        $data = [
            'title' => 'Arus Balik Santri',
            'liburan' => $this->km->getliburan(),
            'zone' => $this->km->getzone(),
            'kembali' => $this->km->gettanggal()
        ];

        $this->load->view('layout/header', $data);
        $this->load->view('kembalian/kembalian');
        $this->load->view('layout/footer');
        $this->load->view('kembalian/javakembalian');
    }

    public function save()
    {
        $simpan = $this->kem->save();
        $hasil = ['hasil' => $simpan];

        echo json_encode($hasil);
    }

    public function getid()
    {
        $data = [
            'hasil' => $this->kem->getID()
        ];
        $this->load->view('kembalian/ajax-hasil', $data);
    }

    public function batal()
    {
        $this->kem->batal();
    }

    public function coba()
    {
        // $data = $this->km->gettanggal();

        $data = date('Y-m-d H:i:s');
        $now = date('Y-m-d H:i:s');

        $selisih = strtotime($data) - strtotime($now);

        echo strtotime($data) . ' | ' . strtotime($now) . ' | ' . $selisih . '<br>';

        echo setselisih();
    }

    public function getmodal()
    {
        $data = [
            'hasil' => $this->kem->getmodal()
        ];

        $this->load->view('kembalian/ajax-modal', $data);
    }

    public function cekmodal()
    {
        $hasil = $this->kem->cekmodal();

        echo json_encode($hasil);
    }

    public function saveijin()
    {
        $this->kem->saveijin();
    }

    public function getdata()
    {
        $data = [
            'hasil' => $this->kem->getdata(),
            'zone' => $this->km->getzone()
        ];

        $this->load->view('kembalian/ajax-data', $data);
    }

    public function showfilter()
    {
        $data = [
            'hasil' => $this->kem->showfilter()
        ];

        $this->load->view('kembalian/ajax-filter', $data);
    }

    public function SetData()
    {
        $this->kem->setdata();
    }
}
