<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jabatanumum extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('baseModel');
        $this->load->model('dataModel');
        $this->load->model('jabatanumumModel', 'jum');

        CekLoginAkses();
    }

    public function Index()
    {
        $data = [
            'title' => 'Jabatan Umum',
            'datakategori' => $this->jum->getKategoriJabatan()
        ];

        $this->load->view('layout/header', $data);
        $this->load->view('jabatanumum/jabatanumum');
        $this->load->view('layout/footer');
        $this->load->view('jabatanumum/javajabatanumum');
    }


    public function loadDataJabatan()
    {
        $data = [
            'datajabatan' => $this->jum->getDataJabatan()
        ];

        $this->load->view('jabatanumum/ajax-jabatanumum', $data, false);
    }


    public function getJabatan()
    {
        $id = $this->input->post('id', true);
        $data = $this->jum->getJabatan($id);

        echo json_encode($data);
    }


    public function GetPengurus()
    {
        if (isset($_GET['term'])) {
            $result = $this->jum->getPengurus($_GET['term']);
            if (count($result) > 0) {
                foreach ($result as $row)
                    $arr_result[] = array(
                        'label'         => $row->nama_pengurus,
                        'description'   => $row->induk_pengurus,
                    );
                echo json_encode($arr_result);
            }
        }
    }



    public function tambahJabatanUmum()
    {
        $hasil = $this->jum->tambahJabatanUmum();

        echo json_encode($hasil);
    }


    public function getDetailJabatan()
    {
        $id = $this->input->post('id', true);

        $hasil = $this->jum->getDetailJabatan($id);

        echo json_encode($hasil);
    }


    public function nonAktif()
    {
        $id = $this->input->post('id', true);

        $this->jum->nonAktif($id);
    }
}