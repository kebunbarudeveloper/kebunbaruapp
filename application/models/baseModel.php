<?php
defined('BASEPATH') or exit('No direct script access allowed');

class baseModel extends CI_Model
{
	public function GetTampilPeriode()
	{
		$data = $this->db->get('periode')->row_object();
		if ($data) {
			$hasil = 'Tahun Periode : ' . $data->tahun_periode . ' H';
		} else {
			$hasil = 'Periode Belum Diatur';
		}

		return $hasil;
	}


	public function GetPeriode()
	{
		$data = $this->db->get('periode')->row_object();
		return $data->tahun_periode;
	}


	public function SetHariIni()
	{
		$tgl1 = new DateTime('now');

		$jam  = $tgl1->format('H:m');

		$set = new DateTime('tomorrow');
		if ($jam > '18:00' and $jam < '23:59') {
			$set = new DateTime('tomorrow');
			$sekarang = $set->format('Y-m-d');
		} else {
			$sekarang = $tgl1->format('Y-m-d');
		}

		return $sekarang;
		// return $jam;
	}


	public function GetHijriSekarang()
	{
		$tanggalMasehi = $this->SetHariIni();

		$data = $this->db->get_where('kalender', ['masehi' => $tanggalMasehi])->row_object();

		if ($data) {
			$tgl = $data->hijri;
		} else {
			$tgl = '1441-01-01';
		}

		return $tgl;
	}


	public function GetTahunHijri()
	{
		$tanggalMasehi = $this->SetHariIni();

		$data = $this->db->get_where('kalender', ['masehi' => $tanggalMasehi])->row_object();
		$tglx = explode('-', $data->hijri);
		if ($data) {
			$tgl = $tglx[0];
		} else {
			$tgl = '1441';
		}

		return $tgl;
	}

	public function GetBulanHijri()
	{
		$tanggalMasehi = $this->SetHariIni();

		$data = $this->db->get_where('kalender', ['masehi' => $tanggalMasehi])->row_object();
		$tglx = explode('-', $data->hijri);
		if ($data) {
			$tgl = $tglx[1];
		} else {
			$tgl = '00';
		}

		return $tgl;
	}


	public function TampilHijriSekarang()
	{
		$tanggalMasehi = $this->SetHariIni();

		$hijri = $this->GetHijriSekarang();

		$hari = array(
			1 => 'Senin',
			'Selasa',
			'Rabu',
			'Kamis',
			'Jum\'at',
			'Sabtu',
			'Ahad'
		);

		$bulan = array(
			1 =>   'Muharram',
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

		$pecahkan = explode('-', $hijri);
		$num = date('N', strtotime($tanggalMasehi));

		return $hari[$num] . ', ' . $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
	}


	public function TampilHijri($tanggal)
	{

		$bulan = array(
			1 =>   'Muharram',
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

		$pecahkan = explode('-', $tanggal);

		return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0] . ' H';
	}


	public function TampilMasehi($tanggal)
	{

		$bulan = array(
			1 =>   'Januari',
			'Februari',
			'Maret',
			'April',
			'Mei',
			'Juni',
			'Juli',
			'Agustus',
			'September',
			'Oktober',
			'November',
			'Desember'
		);

		$pecahkan = explode('-', $tanggal);

		return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
	}


	public function GetPeriodeSementara()
	{
		$tipe = $this->session->userdata('tipe_user');
		$data = $this->db->get_where('atur_sementara', ['tipe' => $tipe])->row_object();
		return $data->periode;
	}

	public function GetTanggalSementara()
	{
		$tipe = $this->session->userdata('tipe_user');
		$data = $this->db->get_where('atur_sementara', ['tipe' => $tipe])->row_object();
		return $data->tanggal;
	}


	public function GetTahunSementara()
	{
		$tipe = $this->session->userdata('tipe_user');
		$data = $this->db->get_where('atur_sementara', ['tipe' => $tipe])->row_object();
		$tanggal = $data->tanggal;

		$pecah = explode('-', $tanggal);

		return $pecah[0];
	}

	public function getMasehi($tanggal)
	{
		$data = $this->db->get_where('kalender', ['hijri' => $tanggal])->row_object();
		if ($data) {
			return $data->masehi;
		}

		return date('Y-m-d');
	}
}
