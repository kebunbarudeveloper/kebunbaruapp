<?php
defined('BASEPATH') or exit('No direct script access allowed');

class KembaliBanat extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('baseModel');
        $this->load->model('kamtibModel', 'km');
        $this->load->model('kembaliBanatModel', 'kem');

        CekLoginAkses();
    }

    public function index()
    {
        $data = [
            'title' => 'Arus Balik Banat',
            'kembali' => $this->kem->gettanggal(),
            'domicile' => $this->kem->getDomicile()
        ];

        $this->load->view('layout/header', $data);
        $this->load->view('kembalibanat/kembalibanat');
        $this->load->view('layout/footer');
        $this->load->view('kembalibanat/javakembalibanat');
    }

    public function tanggal()
    {
        $this->kem->tanggal();

        redirect('kembalibanat');
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
        $this->load->view('kembalibanat/ajax-hasil', $data);
    }

    public function batal()
    {
        $this->kem->batal();
    }

    public function coba()
    {
        echo $this->kem->setDiff();
    }

    public function getmodal()
    {
        $data = [
            'hasil' => $this->kem->getmodal()
        ];

        $this->load->view('kembalibanat/ajax-modal', $data);
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
            'hasil' => $this->kem->getdata()
        ];

        $this->load->view('kembalibanat/ajax-data', $data);
    }

    public function showfilter()
    {
        $data = [
            'hasil' => $this->kem->showfilter()
        ];

        $this->load->view('kembalibanat/ajax-filter', $data);
    }

    public function SetData()
    {
        $this->kem->setdata();
    }
}
