<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Fotosantri extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('baseModel');
        $this->load->model('UploadModel', 'um');

        CekLoginAkses();
    }

    public function index()
    {
        $data = [
            'title' => 'Upload Foto Santri'
        ];
        $this->load->view('layout/header', $data);
        $this->load->view('fotosantri/fotosantri');
        $this->load->view('layout/footer');
        $this->load->view('fotosantri/java-fotosantri');
    }

    public function load()
    {
        $data = [
            'data' => $this->um->getdata()
        ];
        $this->load->view('fotosantri/ajax-load', $data);
    }

    public function cekdata()
    {
        $id = $this->input->post('id', true);
        $hasil = $this->um->cekdata($id);

        echo json_encode($hasil);
    }

    public function simpan()
    {
        $id = $this->input->post('id', true);
        $fotoawal = 'assets/foto-temp/' . $id . '.jpg';
        if ($fotoawal) {
            @unlink($fotoawal);
        }

        $fileName = $id . '.jpg';
        $config['upload_path']          = FCPATH . '/assets/foto-temp/';
        $config['allowed_types']        = 'jpg|jpeg';
        $config['file_name']            = $fileName;

        $this->load->library('upload', $config);
        if ($this->upload->do_upload('filepond')) {
            $data = $this->um->simpan($id);
        } else {
            $data = ['status' => 500];
        }

        echo json_encode($data);
    }

    public function simpanttd()
    {
        $id = $this->input->post('idttd', true);
        $ttd = 'assets/ttd-temp/' . $id . '.jpg';
        if ($ttd) {
            @unlink($ttd);
        }

        $fileName = $id . '.jpg';
        $config['upload_path']          = FCPATH . '/assets/ttd-temp/';
        $config['allowed_types']        = 'jpg|jpeg';
        $config['file_name']            = $fileName;

        $this->load->library('upload', $config);
        if ($this->upload->do_upload('fotottd')) {
            $hasil = ['status' => 200];
        } else {
            $hasil = ['status' => 500];
        }

        echo json_encode($hasil);
    }

    public function hapus()
    {
        $id = $this->input->post('id', true);

        $fotoawal = 'assets/foto-temp/' . $id . '.jpg';
        if ($fotoawal) {
            @unlink($fotoawal);
        }

        $ttd = 'assets/ttd-temp/' . $id . '.jpg';
        if ($ttd) {
            @unlink($ttd);
        }
        $hasil = $this->um->hapus($id);

        echo json_encode($hasil);
    }
}
