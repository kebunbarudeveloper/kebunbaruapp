<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Perizinan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('baseModel');
        $this->load->model('PerizinanModel', 'sbm');

        CekLoginAkses();
    }

    public function Index()
    {
        $data = [
            'title' => 'Perizinan',
            'bulan' => $this->baseModel->GetBulanHijri()
        ];

        $this->load->view('layout/header', $data);
        $this->load->view('perizinan/perizinan');
        // if ($this->session->userdata('id_user') == 'cd125680fbd29f7') {
        //     $this->load->view('perizinan/perizinan');
        //     // $this->load->view('pengurus/pengurus');
        // } else {
        //     $this->load->view('login/maintenance');
        // }
        $this->load->view('layout/footer');
        $this->load->view('perizinan/javaperizinan');
    }


    public function loadData()
    {
        $tipe = $this->session->userdata('tipe_user');
        $data = [
            'data' => $this->sbm->getDataPerizinan($tipe)[0],
            'total' => $this->sbm->getDataPerizinan($tipe)[1]
        ];

        $this->load->view('perizinan/ajax-data', $data);
    }

    public function getAlasan()
    {
        $data = ['alasan' => $this->sbm->alasan()];

        $this->load->view('perizinan/ajax-alasan', $data);
    }

    public function cekIDSantri()
    {
        $hasil = $this->sbm->cekIDSantri();

        echo json_encode($hasil);
    }


    public function getLinkAngket()
    {
        $id = $this->input->post('iddatasantriboyong', true);
        $url = encrypt_url($id);

        redirect('perizinan/printangket/' . $url);
    }

    public function getLinkPrint($id)
    {
        $url = encrypt_url($id);

        redirect('perizinan/printangket/' . $url);
    }


    public function printAngket($idx)
    {
        $id = decrypt_url($idx);
        $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
        $barcode =  $generator->getBarcode($id, $generator::TYPE_CODE_128, 2, 40);

        $data = [
            'title' => 'Surat Permohonan Izin',
            'data' => $this->sbm->getIzin($id),
            'barcode' => $barcode
        ];

        $this->load->view('print/perizinan', $data);
    }


    public function getDataSantri()
    {
        $id = $this->input->post('id', true);
        $data = ['data' => $this->sbm->getDataSantri($id)];

        $this->load->view('perizinan/ajax-suksesdata', $data);
    }


    public function batalkanProses()
    {
        $id = $this->input->post('id', true);
        $this->sbm->batalkanProses($id);
    }


    public function save()
    {
        $hasil = $this->sbm->save();

        echo json_encode($hasil);
    }

    public function cekPerizinan()
    {
        $id = $this->input->post('id', true);
        $hasil = $this->sbm->cekDataPerizinan($id);

        echo json_encode($hasil);
    }

    public function cekPerizinanKembali()
    {
        $id = $this->input->post('id', true);
        $hasil = $this->sbm->cekDataPerizinanKembali($id);

        echo json_encode($hasil);
    }

    public function getDataPerizinan()
    {
        $id = $this->input->post('id', true);
        $data = ['data' => $this->sbm->getIzin($id)];

        $this->load->view('perizinan/ajax-perizinan', $data);
    }

    public function saveIzin()
    {
        $hasil = $this->sbm->saveIzin();

        echo json_encode($hasil);
    }

    public function saveIzinKembali()
    {
        $hasil = $this->sbm->saveIzinKembali();

        echo json_encode($hasil);
    }

    public function getLinkSurat($id)
    {
        $url = encrypt_url($id);

        redirect('perizinan/printsurat/' . $url);
    }


    public function printSurat($idx)
    {
        $id = decrypt_url($idx);

        $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
        $barcode =  $generator->getBarcode($id, $generator::TYPE_CODE_128, 2, 40);

        $data = [
            'title' => 'Salinan Surat Izin',
            'data' => $this->sbm->getIzin($id),
            'barcode' => $barcode
        ];

        $this->load->view('print/surat-izin', $data);
    }

    public function coba()
    {
        echo diffDayCounter('2023-05-28 17:07:10', '2023-05-30 17:00:00');
    }
}
