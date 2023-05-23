<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelolamenu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('baseModel');
        $this->load->model('dataModel');
        $this->load->model('menuModel', 'mm');
        $this->load->library('form_validation');

        CekLoginAkses();
    }


    public function index()
    {
        $data = [
            'title' => 'Kelola Menu',
            'datakategorijabatan' => $this->mm->getKategoriJabatan()
        ];

        $this->load->view('layout/header', $data);
        $this->load->view('kelolamenu/kelolamenu');
        $this->load->view('layout/footer');
        $this->load->view('kelolamenu/javakelolamenu');
    }


    public function LoadAwal()
    {
        $tampil = '<div class="col-12">
                        <div class="card">
                            <div class="card-body text-center text-red">
                                <h5> <i class="fa fa-fw fa-exclamation-circle"></i> Pilih kategori untuk menampilkan data
                                </h5>
                            </div>
                        </div>
                    </div>';

        echo $tampil;
    }


    public function LoadDataMenu()
    {
        $kategori = $this->input->post('id', true);
        $data = [
            'datamenu' => $this->mm->getMenuJabatan($kategori)
        ];

        $this->load->view('kelolamenu/ajax-kelolamenu', $data);
    }


    public function getJabatan()
    {
        $idkategori = $this->input->post('id', true);
        $data = $this->mm->getJabatan($idkategori);

        echo json_encode($data);
    }

    public function tambahMenu()
    {
        $id      = $this->input->post('idkategori', true);
        $jabatan = $this->input->post('namajabatan', true);
        $nama    = $this->input->post('namamenu', true);
        $icon    = $this->input->post('iconmenu', true);
        $urut    = $this->input->post('urutmenu', true);
        $url     = strtolower(str_replace(' ', '', $nama));

        $data = [
            'id_datamenu' => '',
            'urut_datamenu' => $urut,
            'nama_menu' => ucwords($nama),
            'icon_menu' => $icon,
            'kategori_datamenu' => $id,
            'jabatan_datamenu' => $jabatan,
            'url_menu' => $url,
            'status_menu' => 1
        ];
        //Cek Menu
        $datax = [
            'kategori_datamenu' => $id,
            'jabatan_datamenu' => $jabatan,
            'url_menu' => $url,
            'KEBUNBARU-KEY' => 'f7f3d294cb068555257017c1dfb0f2870fe93cae941bfa0983'
        ];
        $cekMenu = $this->menuModel->getMenuID($datax);
        if ($cekMenu > 0) {
            $hasil = ['id' => 'gagal'];
        } else {
            $this->mm->TambahMenu($data, $id);
            $hasil = ['id' => $id];
        }

        echo json_encode($hasil);
    }


    public function ubahStatus()
    {
        $id     = $this->input->post('id', true);
        $status = $this->input->post('status', true);
        $hasil = $this->mm->ubahStatus($id, $status);

        echo json_encode(['hasil' => $hasil]);
    }
}