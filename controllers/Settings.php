<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Settings extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('baseModel');
        $this->load->model('settingsModel', 'sm');

        CekLoginAkses();
    }

    public function index()
    {
        $data = [
            'title' => 'Pengaturan Sistem Kantin'
        ];
        $this->load->view('layout/header', $data);
        $this->load->view('settings/settings');
        $this->load->view('layout/footer');
        $this->load->view('settings/javasettings');
    }

    public function loadsetoran()
    {
        $data = [
            'setoran' => $this->sm->setoran()
        ];
        $this->load->view('settings/ajax-set-setoran', $data);
    }

    public function setoran()
    {
        $hasil = $this->sm->setsetoran();
        echo json_encode($hasil);
    }

    public function resetsetoran()
    {
        echo $this->sm->resetsetoran();
    }
}
