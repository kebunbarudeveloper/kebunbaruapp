<?php
defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class perizinanModel extends CI_Model
{
	public function alasan()
	{
		return $this->db->get('alasan')->result_object();
	}

	public function getDataPerizinan($tipe)
	{
		$nama = $this->input->post('nama', true);
		$status = $this->input->post('status', true);
		$bulan = $this->input->post('bulan', true);

		$this->db->select('a.*, b.*')
			->from('perizinan as a')
			->join('data_santri as b', 'b.id_santri = a.santri_id')
			->where('a.tipe', $tipe);
		if (!empty($status)) {
			$this->db->where('a.status', $status);
		}
		if (!empty($nama)) {
			$this->db->like('b.nama_santri', $nama);
		}
		if (!empty($bulan)) {
			$this->db->where('SUBSTRING(a.created_at_hijri, 6, 2) =', $bulan);
		}
		$this->db->order_by('a.status ASC, a.finish_at DESC, a.created_at DESC');
		$data = $this->db->get();

		return [
			$data->result_object(),
			$data->num_rows()
		];
	}

	public function getIzin($id)
	{
		$this->db->select('a.*, b.*')->from('perizinan as a')->join('data_santri as b', 'b.id_santri = a.santri_id');
		return $this->db->where('a.id', $id)->get()->row_object();
	}

	public function cekIDSantri()
	{
		$tipe = $this->session->userdata('tipe_user');
		$id = $this->input->post('id', true);
		$data = $this->db->get_where('data_santri', [
			'id_santri' => $id, 'status_santri' => 1, 'tipe_santri' => $tipe
		])->row_object();

		if ($id == '') {
			return [
				'status' => 400,
				'message' => 'ID tidak valid. Pastikan ID sudah diisi'
			];
		}

		if (!$data) {
			return [
				'status' => 400,
				'message' => 'ID tidak valid. Data tidak ditemukan'
			];
		}

		if ($this->cekPerizinan($id) > 0) {
			return [
				'status' => 400,
				'message' => 'Santri ini masih dalam izin yang aktif'
			];
		}

		return [
			'status' => 200,
			'message' => $id
		];
	}

	public function cekPerizinan($id)
	{
		return $this->db->get_where('perizinan', [
			'santri_id' => $id,
			'status <' => 2
		])->num_rows();
	}

	public function save()
	{
		$tipe = $this->session->userdata('tipe_user');
		$periode  = $this->baseModel->GetPeriode();

		$id = $this->input->post('idsantri', true);
		$tipeAlasan = $this->input->post('tipe_alasan', true);
		$alasan = $this->input->post('alasan', true);
		$alasanLain = $this->input->post('alasan_lain', true);

		if ($tipeAlasan == 1) {
			$alasan = $alasanLain;
		} else {
			$alasan;
		}

		if ($id == '' || $alasan == '') {
			return [
				'status' => 400,
				'message' => 'Pastikan ID atau alasan sudah diisi'
			];
		}

		if ($this->cekPerizinan($id) > 0) {
			return [
				'status' => 400,
				'message' => 'Santri ini masih dalam izin yang aktif'
			];
		}

		if ($tipeAlasan == 1) {
			$this->db->insert('alasan', ['name' => ucfirst($alasan)]);
		}

		$nomor = $this->setNomor();
		$tanggal = $this->baseModel->GetHijriSekarang();
		$ref = date('Ymd') . sprintf('%03d', $nomor);
		$data = [
			'id' => $ref,
			'order' => $nomor,
			'santri_id' => $id,
			'registrasi' => $this->setNomorSurat($nomor, $tanggal),
			'alasan' => ucfirst($alasan),
			'created_at_hijri' => $tanggal,
			'created_at' => date('Y-m-d H:i:s'),
			'status' => 0,
			'periode' => $periode,
			'tipe' => $tipe,
			'user' => $this->session->userdata('nama_user')
		];

		$this->db->insert('perizinan', $data);
		if ($this->db->affected_rows() <= 0) {
			return [
				'status' => 400,
				'message' => 'Kesalahan server'
			];
		}

		return [
			'status' => 200,
			'message' => $ref
		];
	}

	public function setNomor()
	{
		$tipe = $this->session->userdata('tipe_user');
		$periode  = $this->baseModel->GetPeriode();

		// $cek = $this->db->order_by('created_at', 'DESC')->get_where('perizinan', [
		$cek = $this->db->order_by('order', 'DESC')->get_where('perizinan', [
			'periode' => $periode
		])->row_object();
		if ($cek) {
			$hasil = $cek->order + 1;
		} else {
			$hasil = 1;
		}

		return $hasil;
	}

	public function getDataSantri($id)
	{
		return $this->db->get_where('data_santri', ['id_santri' => $id])->row_object();
	}

	public function setNomorSurat($nomor, $tanggal)
	{
		$pecah = explode('-', $tanggal);
		$bulan = (int)$pecah[1];
		$romawi = [1 => 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VII', 'IX', 'X', 'XI', 'XII'];

		return sprintf('%03d', $nomor) . '/SIP.P2K/' . $romawi[$bulan] . '/' . $pecah[0];
	}

	public function cekDataPerizinan($id)
	{
		$data = $this->db->get_where('perizinan', [
			'id' => $id, 'status' => 0
		])->row_object();

		if (!$data) {
			return [
				'status' => 400,
				'message' => 'Data tidak ditemukan'
			];
		}

		return [
			'status' => 200,
			'message' => $id
		];
	}

	public function saveIzin()
	{
		$id = $this->input->post('id_proses', true);
		$tanggal = $this->input->post('tanggal', true);
		$bulan = $this->input->post('bulan', true);
		$tahun = $this->input->post('tahun', true);
		if ($id == '' || $tanggal == '' || $bulan == '' || $tahun == '') {
			return [
				'status' => 400,
				'message' => 'Pastikan semua inputan sudah diisi/dipilih'
			];
		}

		$data = $this->db->get_where('perizinan', [
			'id' => $id, 'status' => 0
		])->num_rows();
		if ($data <= 0) {
			return [
				'status' => 400,
				'message' => 'Data perizinan tidak ditemukan'
			];
		}

		$gabungan = $tahun . '-' . $bulan . '-' . $tanggal;

		$hijriSekarang = $this->baseModel->GetHijriSekarang();
		$masehiSekarang = $this->baseModel->getMasehi($gabungan);
		$time = '17:00:00';
		$this->db->where('id', $id)->update('perizinan', [
			'created_at' => date('Y-m-d H:i:s'),
			'created_at_hijri' => $hijriSekarang,
			'updated_at' => $gabungan,
			'active_to' => date('Y-m-d H:i:s', strtotime($masehiSekarang . $time)),
			'status' => 1
		]);

		if ($this->db->affected_rows() <= 0) {
			return [
				'status' => 400,
				'message' => 'Server tidak merespon'
			];
		}

		return [
			'status' => 200,
			'message' => $id
		];
	}

	public function cekDataPerizinanKembali($id)
	{
		$data = $this->db->get_where('perizinan', [
			'id' => $id, 'status' => 1
		])->row_object();

		if (!$data) {
			return [
				'status' => 400,
				'message' => 'Data tidak ditemukan'
			];
		}

		return [
			'status' => 200,
			'message' => $id
		];
	}

	public function saveIzinKembali()
	{
		$id = $this->input->post('id', true);
		$tanggal = $this->input->post('tanggal', true);
		$bulan = $this->input->post('bulan', true);
		$tahun = $this->input->post('tahun', true);
		$waktu = $this->input->post('waktu', true);

		if ($id == '') {
			return [
				'status' => 400,
				'message' => 'Pastikan No. Reg. sudah diisi'
			];
		}

		if ($waktu != '' || $tanggal != '' || $bulan != '' || $tahun != '') {
			$gabung = $tahun . '-' . $bulan . '-' . $tanggal;
			$kembali = date('Y-m-d H:i:s', strtotime($gabung . $waktu));
		} else {
			$kembali = date('Y-m-d H:i:s');
		}

		$data = $this->db->get_where('perizinan', [
			'id' => $id, 'status' => 1
		])->row_object();
		if (!$data) {
			return [
				'status' => 400,
				'message' => 'Data perizinan tidak ditemukan'
			];
		}

		$selisih = setselisihkembali($data->active_to, $kembali);

		$this->db->where('id', $id)->update('perizinan', [
			'finish_at' => $kembali,
			'status' => $selisih
		]);

		if ($this->db->affected_rows() <= 0) {
			return [
				'status' => 400,
				'message' => 'Server tidak merespon'
			];
		}

		return [
			'status' => 200,
			'message' => $id
		];
	}
}
