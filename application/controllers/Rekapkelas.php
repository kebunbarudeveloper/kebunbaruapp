<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RekapKelas extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('baseModel');
        $this->load->model('RekapKelasModel', 'rkm');

        CekLoginAkses();
    }

    public function index()
    {
        $this->rkm->setData();

        $data = [
            'title' => 'Rekapitulasi Per Kelas'
        ];
        $this->load->view('layout/header', $data);
        $this->load->view('rekapkelas/rekapkelas');
        $this->load->view('layout/footer');
        $this->load->view('rekapkelas/java-rekapkelas');
    }

    public function loaddata()
    {
        $data = [
            'datas' => $this->rkm->loaddata()
        ];
        $this->load->view('rekapkelas/ajax-data', $data);
    }

    public function laporan()
    {
        $data = [
            'data' => $this->rkm->loaddata()
        ];

        $this->load->library('pdf');
        $this->pdf->setPaper('A4', 'landscape');
        $this->pdf->filename = 'Rekapitulasi-Keuangan.pdf';
        $this->pdf->load_view('lap_kelas', $data);
    }
}
