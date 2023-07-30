<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mahram extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('baseModel');
        $this->load->model('mahramModel');

        CekLoginAkses();

        // $tipe = $this->session->userdata('tipe_user');
        // if ($tipe != 2) {
        //     redirect('block');
        // }
    }

    public function Index()
    {
        $tipe = $this->session->userdata('tipe_user');
        $data = [
            'title' => 'Kartu Mahram',
            'tipe' => $tipe
        ];

        $this->load->view('layout/header', $data);
        $this->load->view('mahram/mahram');
        $this->load->view('layout/footer');
        $this->load->view('mahram/javamahram');
    }

    public function loadData()
    {
        $data = [
            'data' => $this->mahramModel->getData(),
            'total' => $this->mahramModel->getTotal(),
            'tipe' => $this->session->userdata('tipe_user')
        ];

        $this->load->view('mahram/ajax-mahram', $data);
    }

    public function cekIDSantri()
    {
        $tipe = $this->session->userdata('tipe_user');
        $id = $this->input->post('id', true);
        $opsi = $this->input->post('opsi', true);

        $cekSantri = $this->mahramModel->cekIDSantri($id);

        if ($cekSantri) {
            $tipeSantri = $cekSantri->tipe_santri;
            $statusSantri = $cekSantri->status_santri;
            $cekNik = $this->mahramModel->cekNIK($cekSantri->wali_santri, $opsi);

            if ($tipeSantri != $tipe) {
                $hasil = ['hasil' => 'Gagal...!! ID Santri ditemukan tetapi login Anda tidak punya hak akses'];
            } elseif ($statusSantri == 0) {
                $hasil = ['hasil' => 'Gagal...!! ID Santri tercatat sudah boyong'];
            } elseif ($statusSantri == 2 || $statusSantri == 10) {
                $hasil = ['hasil' => 'Gagal...!! Status Santri tidak aktif'];
            } elseif ($cekNik[0] > 0) {
                $hasil = ['hasil' => $cekNik[1]];
            } else {
                $hasil = ['hasil' => 0, 'data' => $cekSantri];
            }
        } else {
            $hasil = ['hasil' => 'Gagal...!! ID Santri tidak ditemukan'];
        }

        echo json_encode($hasil);
    }

    public function gethasilsukses()
    {
        $nik = $this->input->post('nik', true);
        $getWali = $this->mahramModel->getWali($nik);
        $getSantri = $this->mahramModel->getSantri($nik);

        $data = [
            'wali' => $getWali,
            'santri' => $getSantri
        ];
        $this->load->view('mahram/ajax-suksesdata', $data);
    }

    public function updatenomor()
    {
        $nomor = str_replace('-', '', $this->input->post('nomor', true));
        $nik = $this->input->post('nik', true);
        $data = $this->mahramModel->updatenomor($nomor, $nik);

        echo json_encode($data);
    }

    public function upload()
    {
        $nik = $this->input->post('idwali', true);
        $id = mt_rand(100000, 999999);
        $opsi = $this->input->post('hasilfiroq', true);

        $fotoawal = 'assets/fotowali/' . $id . '.jpg';
        // $fotoawal = 'assets/fotowali/dev/' . $id . '.jpg';
        if ($fotoawal) {
            @unlink($fotoawal);
        }

        $fileName = $id . '.jpg';
        $config['upload_path']          = FCPATH . '/assets/fotowali/';
        // $config['upload_path']          = FCPATH . '/assets/fotowali/dev/';
        $config['allowed_types']        = 'jpg|jpeg';
        $config['file_name']            = $fileName;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('filepond')) {
            $data = $this->mahramModel->add($nik, $id, $opsi);
        } else {
            $data = 0;
        }

        echo json_encode($data);
    }

    public function updateprint()
    {
        $id = $this->input->post('id', true);
        $data = $this->mahramModel->updateprint($id);

        echo json_encode($data);
    }


    public function print($id)
    {
        $id = decrypt_url($id);
        $getDataKartu = $this->mahramModel->getdatakartu($id);
        if ($getDataKartu) {
            $print = $getDataKartu->print;
            if ($print == 1) {
                echo  'Akses Anda dicegah';
            } else {
                $nik = $getDataKartu->nik;
                $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
                $jadi =  $generator->getBarcode($getDataKartu->id, $generator::TYPE_CODE_128, 9, 240);

                $data = [
                    'title' => 'Print Out Kartu Mahram',
                    'data' => $getDataKartu,
                    'santri' => $this->mahramModel->getSantri($nik),
                    'total' => $this->mahramModel->getTotalSantri($nik),
                    'barcode' => $jadi
                ];

                $this->load->view('print/mahram', $data);
            }
        }
    }

    // public function coba()
    // {
    //     $data = $this->db->get('mahram')->result_object();
    //     $rows = [];
    //     foreach ($data as $row) {
    //         $rows[] = [
    //             'id' => $row->id,
    //             'foto' => $row->nik
    //         ];
    //     }
    //     $this->db->update_batch('mahram', $rows, 'id');
    // }

    public function walistatis()
    {
        $data = $this->mahramModel->walistatis();
        echo json_encode($data);
    }

    public function getdatamahram()
    {
        $id = $this->input->post('id', true);
        $hasil = $this->mahramModel->getdatamahram($id);
        echo json_encode($hasil);
    }

    public function simpanedit()
    {
        $hasil = $this->mahramModel->simpanedit();

        echo json_encode($hasil);
    }

    public function simpanpengajuan()
    {
        $hasil = $this->mahramModel->simpanpengajuan();

        echo json_encode($hasil);
    }


    public function terimaaduan()
    {
        $hasil = $this->mahramModel->terimaaduan();
        echo json_encode($hasil);
    }

    public function getdetail()
    {
        $id = $this->input->post('id', true);

        $data = $this->mahramModel->getdatakartu($id);
        $nik = $data->nik;
        $santri = $this->mahramModel->getSantri($nik);

        $data = [
            'data' => $data,
            'santri' => $santri
        ];

        $this->load->view('mahram/ajax-detail', $data);
    }
}
