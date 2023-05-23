<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Aturbawahan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('baseModel');
        $this->load->model('dataModel');
        $this->load->model('bawahanModel', 'jm');
        $this->load->library('form_validation');

        CekLoginAkses();
    }


    public function index()
    {
        $data = [
            'title' => 'Atur Jabatan',
            'kategori' => $this->session->userdata('kategori_user'),
            'tipe' => $this->session->userdata('tipe_user')
        ];

        $this->load->view('layout/header', $data);
        $this->load->view('aturbawahan/aturbawahan');
        $this->load->view('layout/footer');
        $this->load->view('aturbawahan/javaaturbawahan');
    }


    public function loadDataJabatan()
    {
        $data = [
            'datajabatan' => $this->jm->getJabatan()
        ];

        $this->load->view('aturbawahan/ajax-aturbawahan', $data, false);
    }


    public function getJabatanPerkategori()
    {
        $kategori = $this->input->post('kategori');
        $data = $this->jm->getJabatanPerkategori($kategori);

        echo json_encode($data);
    }


    public function getIDJabatan()
    {
        $data = $this->jm->getIDJabatan();

        echo json_encode($data);
    }


    public function GetPengurus()
    {
        if (isset($_GET['term'])) {
            $result = $this->jm->getPengurus($_GET['term']);
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


    public function tambahAturJabatan()
    {
        $hasil = $this->jm->tambahaturjabatan();

        echo json_encode($hasil);
    }


    public function getPendidikan()
    {
        $id = $this->input->post('id', true);
        $pecah = explode('-', $id);

        $data = $this->jm->getPendidikan($pecah[0], $pecah[1]);

        echo json_encode($data);
    }


    public function getDetail()
    {
        $induk = $this->input->post('induk', true);
        $hasil = $this->jm->getDetail($induk);

        echo json_encode($hasil);
    }


    public function ubahStatus()
    {
        $hasil = $this->jm->ubahStatus();
        if ($hasil > 0) {
            $feed = ['hasil' => 1];
        } else {
            $feed = ['hasil' => 0];
        }

        echo json_encode($feed);
    }
}
