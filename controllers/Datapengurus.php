<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Datapengurus extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('baseModel');
        $this->load->model('dataModel');
        $this->load->model('pengurusModel');

        CekLogin();
    }

    public function Index()
    {
        $data = [
            'title' => 'Data Pengurus'
        ];

        $this->load->view('layout/header', $data);
        $this->load->view('datapengurus/datapengurus');
        $this->load->view('layout/footer');
        $this->load->view('datapengurus/javadatapengurus');
    }


    public function Alternatif()
    {
        $data = [
            'title' => 'Data Pengurus'
        ];

        $this->load->view('datapengurus/alternatif', $data);
    }


    public function loadData()
    {
        $data = [
            'datapengurus' => $this->pengurusModel->getDataPengurus()[0],
            'totalpengurus' => $this->pengurusModel->getDataPengurus()[1]
        ];
        $this->load->view('datapengurus/ajax-datapengurus', $data);
    }



    public function getIDSantri()
    {
        $nik = $this->input->post('nik', true);
        $ambil = $this->pengurusModel->getIDSantri($nik);

        if ($ambil) {
            $hasil = ['hasil' => 1, 'data' => $ambil];
        } else {
            $hasil = ['hasil' => 0];
        }

        echo json_encode($hasil);
    }


    public function GetProvinsi()
    {
        if (isset($_GET['term'])) {
            $result = $this->dataModel->GetProvinsi($_GET['term']);
            if (count($result) > 0) {
                foreach ($result as $row)
                    $arr_result[] = array(
                        'label'         => $row->nama,
                        'description'   => $row->id,
                    );
                echo json_encode($arr_result);
            }
        }
    }


    public function GetKab($id)
    {
        if (isset($_GET['term'])) {
            $result = $this->dataModel->GetKab($id, $_GET['term']);
            if (count($result) > 0) {
                foreach ($result as $row)
                    $arr_result[] = array(
                        'label'         => $row->nama,
                        'description'   => $row->id,
                    );
                echo json_encode($arr_result);
            }
        }
    }



    public function GetKec($id)
    {
        if (isset($_GET['term'])) {
            $result = $this->dataModel->GetKec($id, $_GET['term']);
            if (count($result) > 0) {
                foreach ($result as $row)
                    $arr_result[] = array(
                        'label'         => $row->nama,
                        'description'   => $row->id,
                    );
                echo json_encode($arr_result);
            }
        }
    }


    public function GetDesa($id)
    {
        if (isset($_GET['term'])) {
            $result = $this->dataModel->GetDesa($id, $_GET['term']);
            if (count($result) > 0) {
                foreach ($result as $row)
                    $arr_result[] = array(
                        'label'         => $row->nama,
                        'description'   => $row->kode_pos
                    );
                echo json_encode($arr_result);
            }
        }
    }


    public function tambahPengurus()
    {
        $hasil = $this->pengurusModel->tambahPengurus();

        echo json_encode($hasil);
    }


    public function getDetail()
    {
        $induk = $this->input->post('induk', true);
        $hasil = $this->pengurusModel->getDetail($induk);

        echo json_encode($hasil);
    }
}