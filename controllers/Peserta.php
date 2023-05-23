<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Peserta extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('baseModel');
        $this->load->model('PesertaModel');

        CekLoginAkses();
    }

    public function Index()
    {
        $rows = [];
        $getdata = $this->PesertaModel->getdataall();
        if ($getdata) {
            foreach ($getdata as $row) {
                $id = $row->id;
                $url = $url = encrypt_url($id);
                $rows[] = [
                    'id' => $id,
                    'nama' => $row->nama,
                    'alamat' => $row->alamat,
                    'url' => $url
                ];
            }
        } else {
            $rows = 0;
        }

        $data = [
            'title' => 'Pengaturan Awal Tahun',
            'data' => $rows
        ];

        $this->load->view('layout/header', $data);
        $this->load->view('peserta/peserta');
        $this->load->view('layout/footer');
        $this->load->view('peserta/javapeserta');
    }


    public function print()
    {
        $dat = $this->PesertaModel->getData();
        // var_dump($dat);
        // die();
        $rows = [];
        foreach ($dat as $row) {
            $id = $row->id;
            $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
            $barcode =  $generator->getBarcode($id, $generator::TYPE_CODE_128, 2, 50);

            $rows[] = [
                'barcode' => $barcode,
                'nama' => $row->nama,
                'alamat' => $row->alamat
            ];
        }
        $data = [
            'title' => 'Print Out Undangan',
            'data' => $rows
        ];
        $this->load->view('print/bm', $data);
    }

    public function registrasi($url)
    {
        $id = decrypt_url($url);

        echo $id;
    }
}
