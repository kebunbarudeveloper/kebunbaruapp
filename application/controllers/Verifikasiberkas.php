<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Verifikasiberkas extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('baseModel');
        $this->load->model('datasantriModel');
        $this->load->model('dataModel');
        $this->load->model('verifikasiBerkasModel', 'vbm');
        $this->load->library('form_validation');

        CekLoginAkses();
        // CekLogin();
    }

    public function index()
    {
        $tipe = $this->session->userdata('tipe_user');
        $data = [
            'title' => 'Verifikasi Berkas Pendaftaran',
            'datakamar' => $this->vbm->getKamar($tipe),
            'datad' => $this->vbm->getPendidikan(1, $tipe),
            'dataf' => $this->vbm->getPendidikan(2, $tipe),
            'tipeuser' => $tipe
        ];

        $this->load->view('layout/header', $data);
        $this->load->view('verifikasiberkas/verifikasiberkas');
        $this->load->view('layout/footer');
        $this->load->view('verifikasiberkas/javaverifikasiberkas');
    }

    public function loaddata()
    {
        $tipe = $this->session->userdata('tipe_user');
        $data = [
            'data' => $this->vbm->getdata($tipe)
        ];

        $this->load->view('verifikasiberkas/ajax-index', $data);
    }

    public function ceknik()
    {
        $nik = $this->input->post('nik', true);

        $cek = $this->vbm->ceknik($nik);

        echo json_encode($cek);
    }

    public function ceknikwali()
    {
        $nik = $this->input->post('nik', true);

        $hasil = $this->vbm->ceknikwali($nik);

        echo json_encode($hasil);
    }

    public function simpan()
    {
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('nik', 'NIK', 'required|numeric|exact_length[16]');
        $this->form_validation->set_rules('nama', 'Nama Santri', 'required');
        $this->form_validation->set_rules('domisili', 'Domisili', 'required');
        $this->form_validation->set_rules('kelasd', 'Kelas', 'required');
        $this->form_validation->set_rules('tingkatd', 'Tingkat', 'required');
        $this->form_validation->set_rules('kelasf', 'Kelas', 'required');
        $this->form_validation->set_rules('tingkatf', 'Tingkat', 'required');

        $this->form_validation->set_rules('nikw', 'NIK Wali', 'required|numeric|exact_length[16]');
        $this->form_validation->set_rules('namaw', 'Nama Wali', 'required');
        $this->form_validation->set_rules('hp', 'No. HP', 'required');
        $this->form_validation->set_rules('wa', 'No. WA', 'required');
        $this->form_validation->set_rules('pendidikan', 'Pendidikan', 'required');
        $this->form_validation->set_rules('hubungan', 'Hubungan', 'required');

        if ($this->form_validation->run() == FALSE) {
            $result = [
                'message' => 400,
                'errors' => [
                    'nik' => form_error('nik'),
                    'nama' => form_error('nama'),
                    'domisili' => form_error('domisili'),
                    'kelasd' => form_error('kelasd'),
                    'tingkatd' => form_error('tingkatd'),
                    'kelasf' => form_error('kelasf'),
                    'tingkatf' => form_error('tingkatf'),
                    'nikw' => form_error('nikw'),
                    'namaw' => form_error('namaw'),
                    'hp' => form_error('hp'),
                    'wa' => form_error('wa'),
                    'pendidikan' => form_error('pendidikan'),
                    'hubungan' => form_error('hubungan'),
                ]
            ];
        } else {
            $simpan = $this->vbm->simpan();
            $result = [
                'message' => $simpan,
                'errors' => []
            ];
        }

        echo json_encode($result);
    }

    public function getid()
    {
        $id = $this->input->post('id', true);

        $hasil = $this->vbm->getid($id);

        echo json_encode($hasil);
    }

    public function ceknoreg()
    {
        $noreg = $this->input->post('noreg', true);
        $cek = $this->vbm->ceknoreg($noreg);
        if ($cek > 0) {
            $hasil = ['status' => 200];
        } else {
            $hasil = ['status' => 400];
        }

        echo json_encode($hasil);
    }

    public function loaddatareg()
    {
        $noreg = $this->input->post('noreg', true);
        $data = [
            'data' => $this->vbm->loaddatareg($noreg)
        ];
        $this->load->view('verifikasiberkas/ajax-reg', $data);
    }

    public function setreg()
    {
        $noreg = $this->input->post('noreg', true);
        $cek = $this->vbm->setreg($noreg);
        if ($cek > 0) {
            $hasil = ['status' => 200];
        } else {
            $hasil = ['status' => 400];
        }

        echo json_encode($hasil);
    }
}
