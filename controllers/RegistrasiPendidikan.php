<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class RegistrasiPendidikan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('baseModel');
        $this->load->model('datasantriModel');
        $this->load->model('dataModel');
        $this->load->model('registrasiPendidikanModel', 'vbm');
        $this->load->library('form_validation');

        CekLoginAkses();
        // CekLogin();
    }

    public function index()
    {
        $tipe = $this->session->userdata('tipe_user');
        $data = [
            'title' => 'Registrasi Pendidikan',
            'datad' => $this->vbm->getPendidikan(1, $tipe),
            'dataf' => $this->vbm->getPendidikan(2, $tipe),
            'tipeuser' => $tipe
        ];

        $this->load->view('layout/header', $data);
        $this->load->view('registrasipendidikan/registrasipendidikan');
        $this->load->view('layout/footer');
        $this->load->view('registrasipendidikan/javaregistrasipendidikan');
    }

    public function loaddata()
    {
        $tipe = $this->session->userdata('tipe_user');
        $platform = $this->input->post('platform', true);

        $data = [
            'data' => $this->vbm->getdata($tipe)
        ];

        if ($platform != 0) {
            $this->load->view('registrasipendidikan/ajax-all', $data);
        } else {
            $this->load->view('registrasipendidikan/ajax-index', $data);
        }
    }

    public function simpan()
    {
        $result = $this->vbm->simpan();

        echo json_encode($result);
    }

    public function simpanf()
    {
        $result = $this->vbm->simpanf();

        echo json_encode($result);
    }

    public function export($level)
    {
        $tipe = $this->session->userdata('tipe_user');
        $arr = [1 => 'diniyah', 'formal'];

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'NO');
        $sheet->setCellValue('B1', 'INDUK');
        $sheet->setCellValue('C1', 'NIK');
        $sheet->setCellValue('D1', 'KK');
        $sheet->setCellValue('E1', 'NAMA');
        $sheet->setCellValue('F1', 'TEMPAT LAHIR');
        $sheet->setCellValue('G1', 'TANGGAL LAHIR');
        $sheet->setCellValue('H1', 'DUSUN');
        $sheet->setCellValue('I1', 'DESA');
        $sheet->setCellValue('J1', 'KECAMATAN');
        $sheet->setCellValue('K1', 'KABUPATEN');
        $sheet->setCellValue('L1', 'PROVINSI');
        $sheet->setCellValue('M1', 'KODE POS');
        $sheet->setCellValue('N1', 'NO KAMAR');
        $sheet->setCellValue('O1', 'DOMISILI');
        $sheet->setCellValue('P1', 'KELAS');
        $sheet->setCellValue('Q1', 'TINGKAT');
        $sheet->setCellValue('R1', 'AYAH');
        $sheet->setCellValue('S1', 'IBU');
        $sheet->setCellValue('T1', 'NIK WALI');
        $sheet->setCellValue('U1', 'NAMA WALI');
        $sheet->setCellValue('V1', 'NO HP');
        $sheet->setCellValue('W1', 'PEKERJAAN');
        $sheet->setCellValue('X1', 'HUBUNGAN');

        $siswa = $this->vbm->DataExport($level);
        $no = 1;
        $x = 2;
        foreach ($siswa as $row) {
            $sheet->setCellValue("A" . $x, $no++);
            $sheet->setCellValue("B" . $x, $row->id_santri);
            $sheet->setCellValue("C" . $x, "'" . $row->nik_santri);
            $sheet->setCellValue("D" . $x, "'" . $row->kk_santri);
            $sheet->setCellValue("E" . $x, $row->nama_santri);
            $sheet->setCellValue("F" . $x, $row->tempat_lahir_santri);
            $sheet->setCellValue("G" . $x, $row->tanggal_lahir_santri);
            $sheet->setCellValue("H" . $x, $row->dusun_santri . ", " . $row->rt_santri . "/" . $row->rw_santri);
            $sheet->setCellValue("I" . $x, $row->desa_santri);
            $sheet->setCellValue("J" . $x, $row->kecamatan_santri);
            $sheet->setCellValue("K" . $x, str_replace(['Kabupaten', 'Kota '], '', $row->kabupaten_santri));
            $sheet->setCellValue("L" . $x, $row->provinsi_santri);
            $sheet->setCellValue("M" . $x, $row->kode_pos_santri);
            $sheet->setCellValue("N" . $x, $row->nomor_kamar_santri);
            $sheet->setCellValue("O" . $x, $row->domisili_santri);
            $sheet->setCellValue("P" . $x, $row->kelas);
            $sheet->setCellValue("Q" . $x, $row->tingkat);
            $sheet->setCellValue("R" . $x, $row->ayah_santri);
            $sheet->setCellValue("S" . $x, $row->ibu_santri);
            $sheet->setCellValue("T" . $x, "'" . $row->nik_walisantri);
            $sheet->setCellValue("U" . $x, $row->nama_walisantri);
            $sheet->setCellValue("V" . $x, $row->nomor_hp_walisantri);
            $sheet->setCellValue("W" . $x, $row->pekerjaan_walisantri);
            $sheet->setCellValue("X" . $x, $row->hubungan_wali);
            $x++;
        }
        $writer = new Xlsx($spreadsheet);
        $filename = 'data-santri-baru-' . $arr[$level] . '-' . date('d-m-Y');

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
}
