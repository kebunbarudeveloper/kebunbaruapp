<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Santriboyong extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('baseModel');
        $this->load->model('santriboyongModel', 'sbm');

        CekLoginAkses();
    }

    public function Index()
    {
        $data = [
            'title' => 'Santri Boyong',
            'bulan' => $this->baseModel->GetBulanHijri()
        ];

        $this->load->view('layout/header', $data);
        $this->load->view('santriboyong/santriboyong');
        // if ($this->session->userdata('id_user') == 'cd125680fbd29f7') {
        //     $this->load->view('santriboyong/santriboyong');
        //     // $this->load->view('pengurus/pengurus');
        // } else {
        //     $this->load->view('login/maintenance');
        // }
        $this->load->view('layout/footer');
        $this->load->view('santriboyong/javasantriboyong');
    }


    public function loadData()
    {
        $tipe = $this->session->userdata('tipe_user');
        $data = [
            'data' => $this->sbm->getDataSantriBoyong($tipe)[0],
            'total' => $this->sbm->getDataSantriBoyong($tipe)[1]
        ];

        $this->load->view('santriboyong/ajax-data', $data);
    }


    public function cekIDSantri()
    {
        $tipe = $this->session->userdata('tipe_user');
        $id = $this->input->post('id', true);

        $cekSantri = $this->sbm->cekIDSantri($id);

        if ($cekSantri) {
            $cekBoyong = $this->sbm->cekIDBoyong($id);
            $tipeSantri = $cekSantri->tipe_santri;
            $statusSantri = $cekSantri->status_santri;

            if ($cekBoyong) {
                $hasil = ['hasil' => 'Gagal...!! ID Santri sedang dalam proses angket boyong'];
            } else {
                if ($tipeSantri != $tipe) {
                    $hasil = ['hasil' => 'Gagal...!! ID Santri ditemukan tetapi login Anda tidak punya hak akses'];
                } elseif ($statusSantri == 0) {
                    $hasil = ['hasil' => 'Gagal...!! ID Santri tercatat sudah boyong'];
                } elseif ($statusSantri == 2) {
                    $hasil = ['hasil' => 'Gagal...!! Santri yang Anda maksud sedang melaksanakan tugas mengajar'];
                } else {
                    $tambah = $this->sbm->tambahBoyong($id);
                    if ($tambah == 'gagal') {
                        $hasil = ['hasil' => 'Gagal...!! Terjadi kesalahan saat proses'];
                    } else {
                        $hasil = ['hasil' => 0, 'data' => $tambah];
                    }
                }
            }
        } else {
            $hasil = ['hasil' => 'Gagal...!! ID Santri tidak ditemukan'];
        }

        echo json_encode($hasil);
    }


    public function getLink($id)
    {
        $url = encrypt_url($id);

        redirect('santriboyong/alternatifWali/' . $url);
    }


    public function getLinkAngket()
    {
        $id = $this->input->post('iddatasantriboyong', true);
        $url = encrypt_url($id);

        redirect('santriboyong/printangket/' . $url);
    }

    public function getLinkPrint($id)
    {
        $url = encrypt_url($id);

        redirect('santriboyong/printangket/' . $url);
    }


    public function printAngket($idx)
    {
        $id = decrypt_url($idx);

        $data = [
            'title' => 'Surat Angket Berhenti',
            'data' => $this->sbm->getDataBoyong($id)
        ];

        $this->load->view('print/angketBoyong', $data);
    }


    public function alternatifWali($id)
    {
        $idx = decrypt_url($id);
        $data = [
            'title' => 'Tambah Data Wakil Wali',
            'id' => $idx
        ];
        $this->load->view('santriboyong/alternatifwali', $data);
    }


    public function getHasilSukses()
    {
        $id = $this->input->post('id', true);
        $data = ['data' => $this->sbm->getDataBoyong($id)];

        $this->load->view('santriboyong/ajax-suksesdata', $data);
    }


    public function batalkanProses()
    {
        $id = $this->input->post('id', true);
        $this->sbm->batalkanProses($id);
    }


    public function ubahDataWali()
    {
        $hasil = $this->sbm->ubahDataWali();
        if ($hasil > 0) {
            $feedback = ['hasil' => 1];
        } else {
            $feedback = ['hasil' => 0];
        }

        echo json_encode($feedback);
    }


    public function simpanBoyong()
    {
        $id = $this->input->post('id', true);
        $alasan = $this->input->post('alasan', true);

        $hasil = $this->sbm->simpanBoyong($id, $alasan);

        if ($hasil > 0) {
            $feedback = ['hasil' => 1];
        } else {
            $feedback = ['hasil' => 0];
        }

        echo json_encode($feedback);
    }


    public function getDetail()
    {
        $id = $this->input->post('id', true);
        $hasil = $this->sbm->getDataBoyong($id);
        $data = [
            'data' => $hasil
        ];
        $this->load->view('santriboyong/ajax-detail', $data);
    }


    public function selesaikanProses()
    {
        $id = $this->input->post('id', true);
        $hasil = $this->sbm->selesaikanProses($id);
        if ($hasil > 0) {
            $data = ['status' => 200];
        } else {
            $data = ['status' => 500];
        }

        echo json_encode($data);
    }

    public function getLinkResmi()
    {
        $id = $this->input->post('iddatasantriboyong', true);
        $url = encrypt_url($id);

        redirect('santriboyong/keterangan/' . $url);
    }


    public function keterangan($idx)
    {
        $id = decrypt_url($idx);

        $data = [
            'title' => 'Surat Keterangan Berhenti',
            'data' => $this->sbm->getDataBoyong($id)
        ];

        $this->load->view('print/ketboyong', $data);
    }
}
