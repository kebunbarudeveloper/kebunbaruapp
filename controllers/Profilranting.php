<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profilranting extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('baseModel');
        $this->load->model('dataModel');
        $this->load->model('rantingModel');


        $loginid = $this->session->userdata('login_kode');
        if ($loginid == FALSE) {
            redirect('login');
        }
    }
    
	public function Index()
	{
        $data = [
            'title' => $this->session->userdata('login_logo').' ('.$this->session->userdata('login_kode').')'
        ];

		$this->load->view('layout/header', $data);
        $this->load->view('profilranting/profilranting');
		$this->load->view('layout/footer');
		$this->load->view('profilranting/javaprofilranting');
    }
    

    public function LoadDataRanting()
    {
        $datax = [
            'dataranting' => $this->rantingModel->DataRanting()
        ];

        $this->load->view('profilranting/ajax-profilranting', $datax, false);
    }



    public function GetDataRanting()
    {
        $data = $this->rantingModel->DataRanting();

        echo json_encode($data);
    }


    public function GetProvinsi(){
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


    public function GetKab($id){
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


    public function GetKec($id){
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


    public function GetDesa($id){
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



    public function SimpanEditRanting()
    {
        $this->rantingModel->SimpanEditRanting();
    }


}
