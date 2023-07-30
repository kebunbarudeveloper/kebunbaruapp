<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profilakun extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('baseModel');
        $this->load->model('profilakunModel', 'pam');

        CekLogin();
    }

    public function Index()
    {
        $nama = strtolower($this->session->userdata('nama_user'));
        $data = [
            'title' => 'Profil ' . ucwords($nama),
            'aktifprofil' => 'active'
        ];

        $this->load->view('layout/header', $data);
        $this->load->view('profilakun/profilakun');
        $this->load->view('layout/footer');
        $this->load->view('profilakun/javaprofilakun');
    }


    public function cekPassword()
    {
        $user     = $this->input->post('user', true);
        $userbaru     = $this->input->post('userbaru', true);
        $password = $this->input->post('password', true);

        $cekUser = $this->pam->cekUser($userbaru);
        $ambil = $this->pam->cekPassword($user);

        if ($ambil) {
            $pass = $ambil->password;
            if (!password_verify($password, $pass)) {
                //Password salah
                $hasil = ['hasil' => 1];
            } elseif ($cekUser > 0) {
                //User sudah ada yang make
                $hasil = ['hasil' => 2];
            } else {
                //Sukses
                $hasil = ['hasil' => 3];
            }
        }

        echo json_encode($hasil);
    }


    public function ubahUsername()
    {
        $userbaru = strtolower($this->input->post('userbaru', true));
        $userlama = $this->input->post('userakun', true);

        $hasil = $this->pam->ubahUser($userlama, $userbaru);

        if ($hasil > 0) {
            $this->session->unset_userdata('username_user');
            $this->session->set_userdata(['username_user' => $userbaru]);
        }


        $this->session->set_flashdata('sukses', 'Username Anda berhasil diubah');

        redirect('profilakun');
    }


    public function cekPasswordLagi()
    {
        $user     = $this->input->post('user', true);
        $password = $this->input->post('password', true);
        $ambil = $this->pam->cekPasswordLagi($user);

        if ($ambil) {
            $pass = $ambil->password;
            if (!password_verify($password, $pass)) {
                //Password salah
                $hasil = ['hasil' => 1];
            } else {
                //Sukses
                $hasil = ['hasil' => 2];
            }
        }

        echo json_encode($hasil);
    }


    public function ubahPassword()
    {
        $id = $this->input->post('userpassword', true);
        $password = password_hash($this->input->post('passwordbaru1'), PASSWORD_DEFAULT);

        $hasil = $this->pam->ubahPassword($id, $password);
        if ($hasil > 0) {
            $this->session->set_flashdata('sukses', 'Password Anda berhasil diubah');
        }
        redirect('profilakun');
    }


    public function uploadFoto()
    {
        $id = $this->session->userdata('id_user');
        $gambar = $this->session->userdata('gambar_user');

        if ($gambar != 'user.png') {
            $fotoawal = 'assets/fotopengguna/' . $gambar;

            if ($fotoawal) {
                unlink($fotoawal);
            }
        }

        $data = $this->input->post('image');
        if ($data) {
            $image_array_1 = explode(";", $data);
            $image_array_2 = explode(",", $image_array_1[1]);
            $data = base64_decode($image_array_2[1]);

            $nama = time() . '.png';
            $image_name = 'assets/fotopengguna/' . $nama;
            write_file($image_name, $data);

            //Ubah nama gambar di tabel data_pengguna
            $hasil = $this->pam->ubahGambar($id, $nama);
            if ($hasil > 0) {
                $this->session->unset_userdata('gambar_user');
                $this->session->set_userdata(['gambar_user' => $nama]);
            }

            echo $image_name;
        }
    }
}