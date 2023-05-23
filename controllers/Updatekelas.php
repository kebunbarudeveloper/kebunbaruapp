<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Updatekelas extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('baseModel');
        $this->load->model('UpdateKelasModel', 'ukm');

        CekLoginAkses();
    }

    public function index()
    {
        $tipe = $this->session->userdata('tipe_user');

        $data = [
            'title' => 'Update Kelas'
        ];

        $this->load->view('layout/header', $data);
        $this->load->view('updatekelas/updatekelas');
        $this->load->view('layout/footer');
        $this->load->view('updatekelas/javaupdatekelas');
    }

    public function loaddata()
    {
        $kelas = $this->input->post('kelas', true);
        $tingkat = $this->input->post('tingkat', true);

        $data = [
            'data' => $this->ukm->load($kelas, $tingkat)[0],
            'total' => $this->ukm->load($kelas, $tingkat)[1]
        ];

        $this->load->view('updatekelas/ajax-updatekelas', $data);
    }

    public function simpan()
    {
        $data = $this->ukm->simpan();

        echo json_encode($data);
    }

    public function print()
    {
        $kelas = $this->input->post('kelasp', true);
        $tingkat = $this->input->post('tingkatp', true);

        $data = [
            'title' => 'Data Santri Domisili ' . $kelas . '-' . $tingkat,
            'judul' => $kelas . '-' . $tingkat,
            'datanya' => $this->ukm->dataPerdomisili($kelas, $tingkat)
        ];

        $this->load->view('print/domisili', $data);
    }

    public function lagi()
    {
        $data = $this->db->get_where('data_santri', [
            'kelas_diniyah' => 1,
            'tingkat_diniyah' => 'Aliyah',
            'tipe_santri' => 1
        ])->result_object();
        foreach ($data as $d) {
            $id = $d->id_santri;
            $dd = $this->db->get_where('riwayat_kamar', [
                'santri_id' => $id,
                'periode' => '1443-1444'
            ])->row_object();
            $this->db->where('id_santri', $id)->update('data_santri', [
                'domisili_santri' => $dd->domisili,
                'nomor_kamar_santri' => $dd->kamar
            ]);
        }
    }
}
