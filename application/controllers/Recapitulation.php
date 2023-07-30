<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Recapitulation extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('baseModel');
        $this->load->model('RecapitulationModel', 'rm');

        CekLoginAkses();
    }

    public function index()
    {
        $data = [
            'title' => 'Rekapitulasi Keuangan'
        ];
        $this->load->view('layout/header', $data);
        $this->load->view('recapitulation/recapitulation');
        $this->load->view('layout/footer');
        $this->load->view('recapitulation/java-recapitulation');
    }

    public function loadall()
    {
        $data = [
            'umum' => $this->rm->loadall()[0],
            'pesantren' => $this->rm->loadall()[1],
            'pembangunan' => $this->rm->loadall()[2],
            'humas' => $this->rm->loadall()[3],
            'madrasah' => $this->rm->loadall()[4],
            'kesimpulanumum' => $this->rm->loadall()[5],
            'kesimpulanpesantren' => $this->rm->loadall()[6],
            'kesimpulanpembangunan' => $this->rm->loadall()[7],
            'kesimpulanhumas' => $this->rm->loadall()[8],
            'kesimpulanmadrasah' => $this->rm->loadall()[9]
        ];
        $this->load->view('recapitulation/ajax-all', $data);
    }

    public function loadfooter()
    {
        $data = [
            'umum' => $this->rm->loadfooter()[0],
            'pesantren' => $this->rm->loadfooter()[1],
            'pembangunan' => $this->rm->loadfooter()[2],
            'humas' => $this->rm->loadfooter()[3],
            'madrasah' => $this->rm->loadfooter()[4],
            'total' => $this->rm->loadfooter()[5]
        ];
        $this->load->view('recapitulation/ajax-footer', $data);
    }

    public function setdate()
    {
        $this->rm->setdate();
    }

    public function laporan()
    {
        $tipe = $this->session->userdata('tipe_user');
        $bulan = (int)$this->rm->getdate();
        $jenis = [1 => 'Putra', 'Putri'];

        $text = array(
            'Seluruh Bulan',
            'Muharram',
            'Shafar',
            'Rabiu\'ul Awal',
            'Rabiu\'ul Tsani',
            'Jumadal Ula',
            'Jumadal Tsaniyah',
            'Rajab',
            'Sya\'ban',
            'Ramadhan',
            'Syawal',
            'Dzul Qo\'dah',
            'Dzul Hijjah'
        );

        $data = [
            'bulan' => $text[$bulan],
            'idad' => $this->rm->laporan('I\'dadiyah'),
            'ibt' => $this->rm->laporan('Ibtidaiyah'),
            'ts' => $this->rm->laporan('Tsanawiyah'),
            'al' => $this->rm->laporan('Aliyah'),
            'umum' => $this->rm->laporan('Umum'),
            'satu' => $this->rm->laporan('Kabid I'),
            'empat' => $this->rm->laporan('Kabid IV'),
            'lima' => $this->rm->laporan('Kabid V'),
            'kes' => $this->rm->kesimpulan()[0],
            'tot' => $this->rm->kesimpulan()[1],
        ];

        $this->load->library('pdf');
        $this->pdf->setPaper('legal', 'potrait');
        $this->pdf->filename = 'Rekapitulasi-Keuangan-' . $jenis[$tipe] . '-Bulan-' . $text[$bulan] . '.pdf';
        $this->pdf->load_view('laporan_pdf', $data);
    }

    public function coba()
    {
        $text = array(
            'Seluruh Bulan',
            'Muharram',
            'Shafar',
            'Rabiu\'ul Awal',
            'Rabiu\'ul Tsani',
            'Jumadal Ula',
            'Jumadal Tsaniyah',
            'Rajab',
            'Sya\'ban',
            'Ramadhan',
            'Syawal',
            'Dzul Qo\'dah',
            'Dzul Hijjah'
        );

        $data = [
            'bulan' => $text[(int)$this->rm->getdate()],
            'idad' => $this->rm->laporan('I\'dadiyah'),
            'ibt' => $this->rm->laporan('Ibtidaiyah'),
            'ts' => $this->rm->laporan('Tsanawiyah'),
            'al' => $this->rm->laporan('Aliyah'),
            'umum' => $this->rm->laporan('Umum'),
            'satu' => $this->rm->laporan('Kabid I'),
            'empat' => $this->rm->laporan('Kabid IV'),
            'lima' => $this->rm->laporan('Kabid V'),
        ];
        $this->load->view('laporan_pdf', $data);
    }
}
