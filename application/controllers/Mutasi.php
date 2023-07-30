<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mutasi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('baseModel');
        $this->load->model('MutasiModel', 'mm');

        CekLoginAkses();
    }

    public function index()
    {
        $tipe = $this->session->userdata('tipe_user');
        $domisili = $this->mm->getDaerah($tipe);
        $daerah = $this->mm->getDaerahKe($tipe);

        $data = [
            'title' => 'Mutasi Kamar',
            'domisili' => $domisili,
            'daerah' => $daerah
        ];

        $this->load->view('layout/header', $data);
        $this->load->view('mutasi/mutasi');
        $this->load->view('layout/footer');
        $this->load->view('mutasi/javamutasi');
    }

    public function loaddata()
    {
        $daerah = $this->input->post('daerah', true);
        $kamar = $this->input->post('kamar', true);

        $data = [
            'data' => $this->mm->load($daerah, $kamar)[0],
            'total' => $this->mm->load($daerah, $kamar)[1]
        ];

        $this->load->view('mutasi/ajax-mutasi', $data);
    }

    public function simpan()
    {
        $data = $this->mm->simpan();

        echo json_encode($data);
    }

    public function print()
    {
        $daerah = $this->input->post('daerahp', true);
        $kamar = $this->input->post('kamarp', true);

        $data = [
            'title' => 'Data Santri Domisili ' . $daerah . '-' . $kamar,
            'judul' => $daerah . '-' . $kamar,
            'datanya' => $this->mm->dataPerdomisili($daerah, $kamar)
        ];

        $this->load->view('print/domisili', $data);
    }
}
