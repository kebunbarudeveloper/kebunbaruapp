<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExportExcel extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('baseModel');
		$this->load->model('dataModel');
		$this->load->model('exportModel', 'em');

		CekLogin();
	}

	public function index()
	{
		$tipe = $this->session->userdata('tipe_user');

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
		$sheet->setCellValue('P1', 'KELAS DINIYAH');
		$sheet->setCellValue('Q1', 'TINGKAT DINIYAH');
		$sheet->setCellValue('R1', 'KELAS FORMAL');
		$sheet->setCellValue('S1', 'TINGKAT FORMAL');
		$sheet->setCellValue('T1', 'AYAH');
		$sheet->setCellValue('U1', 'IBU');
		$sheet->setCellValue('V1', 'NIK WALI');
		$sheet->setCellValue('W1', 'NAMA WALI');
		$sheet->setCellValue('X1', 'NO HP');
		$sheet->setCellValue('Y1', 'PEKERJAAN');
		$sheet->setCellValue('Z1', 'HUBUNGAN');
		$sheet->setCellValue('AA1', 'PERIODE');

		$siswa = $this->em->dataSantriAll($tipe);
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
			$sheet->setCellValue("P" . $x, $row->kelas_diniyah);
			$sheet->setCellValue("Q" . $x, $row->tingkat_diniyah);
			$sheet->setCellValue("R" . $x, $row->kelas_formal);
			$sheet->setCellValue("S" . $x, $row->tingkat_formal);
			$sheet->setCellValue("T" . $x, $row->ayah_santri);
			$sheet->setCellValue("U" . $x, $row->ibu_santri);
			$sheet->setCellValue("V" . $x, "'" . $row->nik_walisantri);
			$sheet->setCellValue("W" . $x, $row->nama_walisantri);
			$sheet->setCellValue("X" . $x, $row->nomor_hp_walisantri);
			$sheet->setCellValue("Y" . $x, $row->pekerjaan_walisantri);
			$sheet->setCellValue("Z" . $x, $row->hubungan_wali);
			$sheet->setCellValue("AA" . $x, $row->periode_masuk);
			$x++;
		}
		$writer = new Xlsx($spreadsheet);
		$filename = 'data-santri-' . date('d-m-Y');

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
	}

	public function boyong()
	{
		$tipe = $this->session->userdata('tipe_user');

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
		$sheet->setCellValue('P1', 'KELAS DINIYAH');
		$sheet->setCellValue('Q1', 'TINGKAT DINIYAH');
		$sheet->setCellValue('R1', 'KELAS FORMAL');
		$sheet->setCellValue('S1', 'TINGKAT FORMAL');
		$sheet->setCellValue('T1', 'WALI');
		$sheet->setCellValue('U1', 'ALASAN');
		$sheet->setCellValue('V1', 'PERIODE');
		$sheet->setCellValue('W1', 'STATUS');

		$siswa = $this->em->dataSantriBoyong($tipe);
		$no = 1;
		$x = 2;
		foreach ($siswa as $row) {
			$status = $row->status_angket;
			$kataStatus = ['Dalam Proses', 'Resmi'];

			$alasan = $row->alasan_boyong;
			if ($alasan == '') {
				$alasanx = 'Tanpa Alasan';
			} else {
				$alasanx = $alasan;
			}

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
			$sheet->setCellValue("P" . $x, $row->kelas_diniyah);
			$sheet->setCellValue("Q" . $x, $row->tingkat_diniyah);
			$sheet->setCellValue("R" . $x, $row->kelas_formal);
			$sheet->setCellValue("S" . $x, $row->tingkat_formal);
			$sheet->setCellValue("T" . $x, $row->nama_wali);
			$sheet->setCellValue("U" . $x, $alasanx);
			$sheet->setCellValue("V" . $x, $row->periode_boyong);
			$sheet->setCellValue("W" . $x, $kataStatus[$status]);
			$x++;
		}
		$writer = new Xlsx($spreadsheet);
		$filename = 'data-santri-boyong-' . date('d-m-Y');

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
	}

	public function mutasi()
	{
		$tipe = $this->session->userdata('tipe_user');

		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$sheet->setCellValue('A1', 'NO');
		$sheet->setCellValue('B1', 'ID P2K');
		$sheet->setCellValue('C1', 'NAMA');
		$sheet->setCellValue('D1', 'DESA');
		$sheet->setCellValue('E1', 'KABUPATEN/KOTA');
		$sheet->setCellValue('F1', 'KELAS');
		$sheet->setCellValue('G1', 'TINGKAT');
		$sheet->setCellValue('H1', 'DAERAH ASAL');
		$sheet->setCellValue('I1', 'KAMAR ASAL');
		$sheet->setCellValue('J1', 'DAERAH BARU');
		$sheet->setCellValue('K1', 'KAMAR BARU');

		$siswa = $this->em->datamutasi($tipe);
		$no = 1;
		$x = 2;
		foreach ($siswa as $row) {

			$sheet->setCellValue("A" . $x, $no++);
			$sheet->setCellValue("B" . $x, $row->id_santri);
			$sheet->setCellValue("C" . $x, $row->nama_santri);
			$sheet->setCellValue("D" . $x, $row->desa_santri);
			$sheet->setCellValue("E" . $x, str_replace(['Kabupaten', 'Kota '], '', $row->kabupaten_santri));
			$sheet->setCellValue("F" . $x, $row->kelas_diniyah);
			$sheet->setCellValue("G" . $x, $row->tingkat_diniyah);
			$sheet->setCellValue("H" . $x, $row->domisili);
			$sheet->setCellValue("I" . $x, $row->kamar);
			$sheet->setCellValue("J" . $x, $row->db);
			$sheet->setCellValue("K" . $x, $row->kb);
			$x++;
		}
		$writer = new Xlsx($spreadsheet);
		$filename = 'data-mutasi-' . date('d-m-Y');

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
	}

	public function payment()
	{
		$tipe = $this->session->userdata('tipe_user');

		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$sheet->setCellValue('A1', 'NO');
		$sheet->setCellValue('B1', 'ID P2K');
		$sheet->setCellValue('C1', 'NAMA');
		$sheet->setCellValue('D1', 'DESA');
		$sheet->setCellValue('E1', 'KABUPATEN/KOTA');
		$sheet->setCellValue('F1', 'KELAS');
		$sheet->setCellValue('G1', 'TINGKAT');
		$sheet->setCellValue('H1', 'NOMINAL');
		$sheet->setCellValue('I1', 'STATUS');

		$siswa = $this->em->datapayment($tipe);
		$no = 1;
		$x = 2;
		foreach ($siswa as $row) {

			$sheet->setCellValue("A" . $x, $no++);
			$sheet->setCellValue("B" . $x, $row->id_santri);
			$sheet->setCellValue("C" . $x, $row->nama_santri);
			$sheet->setCellValue("D" . $x, $row->desa_santri);
			$sheet->setCellValue("E" . $x, str_replace(['Kabupaten', 'Kota '], '', $row->kabupaten_santri));
			$sheet->setCellValue("F" . $x, $row->kelas_diniyah);
			$sheet->setCellValue("G" . $x, $row->tingkat_diniyah);
			$sheet->setCellValue("H" . $x, number_format($row->nominal, 0, ',', '.'));
			$sheet->setCellValue("I" . $x, $row->status);
			$x++;
		}
		$writer = new Xlsx($spreadsheet);
		$filename = 'data-pembayaran-' . date('d-m-Y');

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
	}
}
