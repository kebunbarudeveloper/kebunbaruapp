<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Logout extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        //Helper Cek Login
        CekLogin();
    }


    public function Index()
    {
        $data = [
            'id_user',
            'tipe_user',
            'nama_user',
            'jabatan_user',
            'level_user'
        ];
        $this->session->unset_userdata($data);

        redirect('beranda');
    }
}
