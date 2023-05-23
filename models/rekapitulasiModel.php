<?php
defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class rekapitulasiModel extends CI_Model
{
	public function rekap($tipe)
	{
		$data = $this->db->select_sum('nominal_pemasukan')->get_where('pemasukan', ['tipe_pemasukan' => $tipe])->row_object();
		$total = $data->nominal_pemasukan;

		$data2 = $this->db->select('COUNT(id_pemasukan) AS transaksi')->get_where('pemasukan', ['tipe_pemasukan' => $tipe])->row_object();
		$transaksi = $data2->transaksi;

		$query = "SELECT SUM(a.`nominal_detail`) AS total, b.`nama_akunkeuangan`
		FROM detail_pemasukan a, akun_keuangan b
		WHERE a.`tipe_detail` = '$tipe' AND a.`akun_detail` = b.`id_akunkeuangan`
		GROUP BY a.`akun_detail` ORDER BY b.`urut_akunkeuangan`";
		$data3 = $this->db->query($query)->result_object();

		return [$total, $transaksi, $data3];
	}


	public function pondok($tipe)
	{
		$data = $this->db->select_sum('nominal_detail')->from('detail_pemasukan')->where('tipe_detail', $tipe)->where_in('akun_detail', ['P01', 'P02', 'P03', 'P04', 'P05', 'P06'])->get()->row_object();
		$total = $data->nominal_detail;

		$data2 = $this->db->select('COUNT(id_pemasukan) AS transaksi')->get_where('pemasukan', ['tipe_pemasukan' => $tipe])->row_object();
		$transaksi = $data2->transaksi;

		$query = "SELECT SUM(a.`nominal_detail`) AS total, b.`nama_akunkeuangan`
		FROM detail_pemasukan a, akun_keuangan b
		WHERE a.`tipe_detail` = '$tipe' AND a.`akun_detail` = b.`id_akunkeuangan`
		AND a.`akun_detail` IN('P01', 'P02', 'P03', 'P04', 'P05', 'P06')
		GROUP BY a.`akun_detail` ORDER BY b.`urut_akunkeuangan`";
		$data3 = $this->db->query($query)->result_object();

		return [$total, $transaksi, $data3];
	}


	public function idad($tipe)
	{
		$data = $this->db->select_sum('nominal_detail')
			->from('detail_pemasukan')->where(['tipe_detail' => $tipe, 'instansi_detail' => 'I\'dadiyah'])
			->where_not_in('akun_detail', ['P01', 'P02', 'P03', 'P04', 'P05', 'P06'])
			->get()->row_object();
		$total = $data->nominal_detail;

		$data2 = $this->db->select('COUNT(id_pemasukan) AS transaksi')->get_where('pemasukan', ['tipe_pemasukan' => $tipe, 'instansi_pemasukan' => 'I\'dadiyah'])->row_object();
		$transaksi = $data2->transaksi;

		$query = "SELECT SUM(a.`nominal_detail`) AS total, b.`nama_akunkeuangan`
		FROM detail_pemasukan a, akun_keuangan b
		WHERE a.`tipe_detail` = '$tipe' AND a.`instansi_detail` = 'I\'dadiyah' AND a.`akun_detail` = b.`id_akunkeuangan`
		AND a.`akun_detail` NOT IN('P01', 'P02', 'P03', 'P04', 'P05', 'P06')
		GROUP BY a.`akun_detail` ORDER BY b.`urut_akunkeuangan`";
		$data3 = $this->db->query($query)->result_object();

		return [$total, $transaksi, $data3];
	}


	public function ts($tipe)
	{
		$data = $this->db->select_sum('nominal_detail')
			->from('detail_pemasukan')->where(['tipe_detail' => $tipe, 'instansi_detail' => 'Tsanawiyah'])
			->where_not_in('akun_detail', ['P01', 'P02', 'P03', 'P04', 'P05', 'P06'])
			->get()->row_object();
		$total = $data->nominal_detail;

		$data2 = $this->db->select('COUNT(id_pemasukan) AS transaksi')->get_where('pemasukan', ['tipe_pemasukan' => $tipe, 'instansi_pemasukan' => 'Tsanawiyah'])->row_object();
		$transaksi = $data2->transaksi;

		$query = "SELECT SUM(a.`nominal_detail`) AS total, b.`nama_akunkeuangan`
		FROM detail_pemasukan a, akun_keuangan b
		WHERE a.`tipe_detail` = '$tipe' AND a.`instansi_detail` = 'Tsanawiyah' AND a.`akun_detail` = b.`id_akunkeuangan`
		AND a.`akun_detail` NOT IN('P01', 'P02', 'P03', 'P04', 'P05', 'P06')
		GROUP BY a.`akun_detail` ORDER BY b.`urut_akunkeuangan`";
		$data3 = $this->db->query($query)->result_object();

		return [$total, $transaksi, $data3];
	}
}