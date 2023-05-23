<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Aturliburan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('baseModel');
        $this->load->model('kamtibModel', 'km');

        CekLoginAkses();
    }

    public function index()
    {
        $user = $this->session->userdata('tipe_user');

        $data = [
            'title' => 'Pengaturan',
            'data' => $this->km->getliburan(),
            'jadwal' => $this->km->getjadwal(),
            'domisili' => $this->km->getdomisili($user),
            'zone' => $this->km->getzone(),
            'tanggal' => $this->km->gettanggal()
        ];

        $this->load->view('layout/header', $data);
        $this->load->view('aturliburan/aturliburan');
        $this->load->view('layout/footer');
        $this->load->view('aturliburan/javaaturliburan');
    }


    public function aturliburan()
    {
        $this->km->aturliburan();
    }

    public function aturjadwal()
    {
        $this->km->aturjadwal();
    }

    public function print()
    {
        $data = [
            'title' => 'Print Out Pengambilan Surat Ijin',
            'datanya' => $this->km->print()
        ];
        $this->load->view('print/suratijin', $data);
    }


    public function zone()
    {
        $this->km->zone();
    }

    public function tanggal()
    {
        $this->km->tanggal();

        redirect('aturliburan');
    }

    public function printlagi()
    {
        $data = [
            'title' => 'Print Out Santri Indisipliner',
            'datanya' => $this->km->printlagi()
        ];
        $this->load->view('print/kembalian', $data);
    }

	public function printBanat()
	{
		$data = [
			'title' => 'Print Out Santri Banat Indisipliner',
			'datanya' => $this->km->printBanat()
		];
		$this->load->view('print/kembalian', $data);
	}

    // public function mergeData()
    // {
    //     $data = $this->db->get('kembalian_temp')->result_object();


    //     foreach ($data as $d) {
    //         $check = $this->db->get_where('kembalian', ['santri_id' => $d->santri_id, 'liburan' => 1])->num_rows();
    //         if ($check <= 0) {
    //             $this->db->insert('kembalian', [
    //                 'santri_id' => $d->santri_id,
    //                 'periode' => $d->periode,
    //                 'zone' => $d->zone,
    //                 'tanggal' => $d->tanggal,
    //                 'kembali' => $d->kembali,
    //                 'liburan' => $d->liburan,
    //                 'tipe' => $d->tipe,
    //                 'status' => $d->status,
    //                 'alasan' => $d->alasan
    //             ]);
    //         }
    //     }
    // }
}
