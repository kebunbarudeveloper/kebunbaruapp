<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('loginModel');

        $loginid = $this->session->userdata('id_user');
        if ($loginid == TRUE) {
            redirect('beranda');
        }
    }

    public function Index()
    {
        $data = [
            'title' => 'Login | Kebun baru'
        ];

        // $this->load->view('login/login', $data);
        $this->load->view('login/index', $data);
    }


    public function ProsesLogin()
    {
        $user = htmlspecialchars($this->input->post('username', true));
        $sandi = $this->input->post('katasandi', true);

        if ($user != '' || $sandi != '') {

            $cekUSer = $this->loginModel->CekUser($user, $sandi);

            //Status pengguna
            // 0 => Aktif, 1 => Ditangguhkan, 2 => Belum diaktivasi


            if ($cekUSer) {
                //Cek Aktif
                $status = $cekUSer->status_pengguna;
                if ($status == 0) {
                    //Cek Password
                    $sandix = $cekUSer->password;

                    if (password_verify($sandi, $sandix)) {
                        //Sukses Login
                        $kategori = $cekUSer->kategori_pengguna;
                        $jabatan  = $cekUSer->jabatan_pengguna;
                        //Ambil data kategori dan jabatan
                        $datalengkap = $this->loginModel->getDataLengkap($kategori, $jabatan, $user);

                        $data = [
                            'id_user' => $cekUSer->id_pengguna,
                            'username_user' => $cekUSer->username,
                            'tipe_user' => $cekUSer->tipe_pengguna,
                            'nama_user' => $cekUSer->nama_pengguna,
                            'key_user' => $cekUSer->key_pengguna,
                            'jabatan_user' => $jabatan,
                            'kategori_user' => $kategori,
                            'namajabatan_user' => $datalengkap->nama_jabatan,
                            'namakategori_user' => $datalengkap->nama_kategoripengguna,
                            'gambar_user' => $cekUSer->gambar_pengguna
                        ];
                        $this->session->set_userdata($data);

                        redirect(base_url());
                    } else {
                        //Password salah
                        $this->session->set_flashdata('errorlogin', 'Kata sandi salah');
                        redirect('login');
                    }
                } else {
                    //Username dibanned atau belum diaktivasi
                    $kataError = [1 => 'Username ini Ditangguhkan sementara waktu', 'Username ini belum diaktivasi'];
                    $this->session->set_flashdata('errorlogin', $kataError[$status]);
                    redirect('login');
                }
            } else {
                //Username tak ada
                $this->session->set_flashdata('errorlogin', 'Username tidak ditemukan');
                redirect('login');
            }
        } else {
            $this->session->set_flashdata('errorlogin', 'Pastikan semua sudah terisi');
            redirect('login');
        }
    }
}
