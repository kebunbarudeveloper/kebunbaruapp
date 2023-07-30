<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Pengurus extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('baseModel');
        $this->load->model('PengurusModel', 'pm');

        CekLoginAkses();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Pengurus',
            'data' => 'ada'
        ];
        $this->load->view('layout/header', $data);
        if ($this->session->userdata('id_user') == 'cd125680fbd29f7') {
            $this->load->view('pengurus/pengurus');
        } else {
            $this->load->view('login/block');
        }
        $this->load->view('layout/footer');
        $this->load->view('pengurus/java-pengurus');
    }
}
