<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Aturtarif extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('baseModel');
        $this->load->model('dataModel');
        $this->load->model('AturTarifModel', 'atm');

        CekLoginAkses();
    }

    public function index()
    {
        $data = [
            'title' => 'Atur Tarif',
            'tipe' => $this->session->userdata('tipe_user'),
            'pengaturan' => $this->atm->getpengaturan()
        ];

        $this->load->view('layout/header', $data);
        $this->load->view('aturtarif/aturtarif');
        $this->load->view('layout/footer');
        $this->load->view('aturtarif/java-aturtarif');
    }

    public function load()
    {
        $data = [
            'data' => $this->atm->load()
        ];
        $this->load->view('aturtarif/ajax-index', $data);
    }

    public function tutuppengaturan()
    {
        $this->atm->tutuppengaturan();

        redirect('aturtarif');
    }

    public function setPendaftaran()
    {
        $hasil = $this->atm->setPendaftaran();
        if ($hasil == 400) {
            $result = ['status' => 400];
        } elseif ($hasil == 0) {
            $result = ['status' => 500];
        } else {
            $result = ['status' => 200];
        }

        echo json_encode($result);
    }

    public function setInfaq()
    {
        $hasil = $this->atm->setInfaq();
        if ($hasil == 400) {
            $result = ['status' => 400];
        } elseif ($hasil == 0) {
            $result = ['status' => 500];
        } else {
            $result = ['status' => 200];
        }

        echo json_encode($result);
    }

    public function setPesantren()
    {
        $hasil = $this->atm->setPesantren();
        if ($hasil == 400) {
            $result = ['status' => 400];
        } elseif ($hasil == 0) {
            $result = ['status' => 500];
        } else {
            $result = ['status' => 200];
        }

        echo json_encode($result);
    }


    public function setmadrasah()
    {
        $hasil = $this->atm->setmadrasah();
        if ($hasil == 400) {
            $result = ['status' => 400];
        } elseif ($hasil == 0) {
            $result = ['status' => 500];
        } else {
            $result = ['status' => 200];
        }

        echo json_encode($result);
    }

    public function resetdata()
    {
        $hasil = $this->atm->resetdata();
        if ($hasil > 0) {
            $result = ['status' => 200];
        } else {
            $result = ['status' => 500];
        }

        echo json_encode($result);
    }

    public function setfilterumum()
    {
        $filter = $this->input->post('filter', true);
        $tipe = $this->session->userdata('tipe_user');
        if ($filter == 1 || $filter == 2) {
            if ($filter == 1) {
                $table = 'tarif_pendaftaran';
            } else {
                $table = 'tarif_infaq';
            }
            $data = [
                'data' => $this->atm->getfilterumum($table),
                'pengaturan' => $this->atm->getpengaturan(),
                'table' => $table,
                'tipe' => $tipe
            ];
            $this->load->view('aturtarif/ajax-umum', $data);
        } else {
            $data = [
                'data' => $this->atm->getfilterpesantren(),
                'pengaturan' => $this->atm->getpengaturan(),
                'table' => 'tarif_pesantren',
                'tipe' => $tipe
            ];
            $this->load->view('aturtarif/ajax-pesantren', $data);
        }
    }

    public function setfiltermadrasah()
    {
        $data = [
            'data' => $this->atm->setfiltermadrasah(),
            'pengaturan' => $this->atm->getpengaturan(),
            'table' => 'tarif_madrasah'
        ];
        $this->load->view('aturtarif/ajax-madrasah', $data);
    }

    public function editumum()
    {
        $hasil = $this->atm->editumum();
        if ($hasil > 0) {
            $result = ['status' => 200];
        } else {
            $result = ['status' => 500];
        }

        echo json_encode($result);
    }
}
