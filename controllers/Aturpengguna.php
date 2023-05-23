<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Aturpengguna extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('baseModel');
        $this->load->model('dataModel');
        $this->load->model('penggunaModel', 'jm');
        $this->load->library('form_validation');


        CekLoginAkses();
    }


    public function index()
    {
        $data = [
            'title' => 'Atur Pengguna',
            'datakategorijabatan' => $this->jm->getKategoriJabatan()
        ];

        $this->load->view('layout/header', $data);
        $this->load->view('aturpengguna/aturpengguna');
        $this->load->view('layout/footer');
        $this->load->view('aturpengguna/javaaturpengguna');
    }


    public function loadDataAwal()
    {
        $tampil = '<div class="col-12">
                        <div class="card">
                            <div class="card-body text-center text-red">
                                <h5> <i class="fa fa-fw fa-exclamation-circle"></i> Pilih kategori untuk menampilkan data
                                </h5>
                            </div>
                        </div>
                    </div>';
        echo $tampil;
    }


    public function loadDataPengguna()
    {
        $data = [
            'semua' => $this->jm->getDataPengguna()
        ];

        $this->load->view('aturpengguna/ajax-aturpengguna', $data, false);
    }


    public function getJabatan()
    {
        $data = $this->jm->getJabatan();

        echo json_encode($data);
    }

    public function TambahPengguna()
    {
        $this->jm->TambahPengguna();
    }


    public function AksiPengguna()
    {
        $hasil = $this->jm->AksiPengguna();

        echo json_encode($hasil);
    }


    public function resetdata()
    {
        $this->jm->reset();

        redirect('beranda');
    }
}
