<?php
defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class datasantriModel extends CI_Model
{
	private $_client;
	private $_key;

	public function __construct()
	{
		parent::__construct();
		$this->_client = new Client([
			'base_uri' => getURLAPI()
		]);

		$this->_key = 'f7f3d294cb068555257017c1dfb0f2';
	}


	public function getDataSantri($tipe, $jabatan)
	{
		$periode  = $this->baseModel->GetPeriode();
		$this->db->select('id_santri, tipe_santri, desa_santri, tempat_lahir_santri, tanggal_lahir_santri, induk_santri, nama_santri, kabupaten_santri, status_domisili_santri, domisili_santri, nomor_kamar_santri, kelas_diniyah, kelas_formal, tingkat_diniyah, tingkat_formal, TIMESTAMPDIFF(YEAR, tanggal_lahir_santri, CURDATE()) AS umur');
		$this->db->from('data_santri');
		$this->db->where(['status_santri >' => 0, 'status_santri <' => 10]);
		if ($tipe != 3) {
			$this->db->where('tipe_santri', $tipe);
		}

		if ($jabatan == 46 || $jabatan == 47) {
			$this->db->where('periode_masuk', $periode);
		}

		$this->db->order_by('induk_santri', 'ASC');
		$data = $this->db->get()->result_object();

		$this->db->select('COUNT(id_santri) AS total');
		$this->db->from('data_santri');
		if ($tipe != 3) {
			$this->db->where('tipe_santri', $tipe);
		}
		if ($jabatan == 46 || $jabatan == 47) {
			$this->db->where('periode_masuk', $periode);
		}
		$this->db->where(['status_santri >' => 0, 'status_santri <' => 10]);
		$total = $this->db->get()->row_object();

		return [$data, $total];
	}


	public function dataSantriAll($tipe)
	{
		$query = "SELECT a.*, b.*, TIMESTAMPDIFF(YEAR, a.`tanggal_lahir_santri`, CURDATE()) AS umur FROM data_santri a, data_walisantri b WHERE a.`wali_santri` = b.`nik_walisantri` AND a.`tipe_santri` = '$tipe' AND a.`status_santri` = 1";
		return $this->db->query($query)->result_object();
	}


	public function getDetail($id)
	{
		$this->db->select('*, TIMESTAMPDIFF(YEAR, tanggal_lahir_santri, CURDATE()) AS umur')
			->from('data_santri')
			->join('data_walisantri', 'wali_santri = nik_walisantri')
			->where('id_santri', $id);
		return $this->db->get()->row_array();
	}


	public function getDataSantriFilter($params = [])
	{
		$this->db->select('id_santri, induk_santri, desa_santri, tipe_santri, tempat_lahir_santri, tanggal_lahir_santri, nama_santri, kabupaten_santri, status_domisili_santri, domisili_santri, nomor_kamar_santri, kelas_diniyah, kelas_formal, tingkat_diniyah, status_santri, tingkat_formal, TIMESTAMPDIFF(YEAR, tanggal_lahir_santri, CURDATE()) AS umur');
		$this->db->from('data_santri');
		$this->db->where(['status_santri >' => 0, 'status_santri <' => 10]);

		if (is_array($params) && array_key_exists('where', $params)) {
			foreach ($params['where'] as $key => $val) {
				$this->db->where($key, $val);
			}
		}


		if (is_array($params) && array_key_exists('carinama', $params)) {
			$namax = $params['carinama']['nama'];
			if (!empty($namax)) {
				$cekNum = is_numeric($namax);
				if ($cekNum == 1) {
					$this->db->like('id_santri', $namax, 'after');
				} else {
					$this->db->like('nama_santri', $namax, 'both');
				}
			}
		}


		$this->db->order_by('induk_santri', 'ASC');

		if (array_key_exists("returnType", $params) && $params['returnType'] == 'count') {
			$result = $this->db->count_all_results();
		} else {

			$query = $this->db->get();
			$result = ($query->num_rows() > 0) ? $query->result_object() : FALSE;
		}


		return $result;
	}


	public function getDataSantriID($id)
	{
		return $this->db->get_where('data_santri', ['id_santri' => $id])->row_object();
	}


	public function getDataWaliSantri($id)
	{
		return $this->db->select('*')->from('data_santri')->join('data_walisantri', 'nik_walisantri = wali_santri')->where('id_santri', $id)->get()->row_object();
	}

	public function getTotalNik($nik)
	{
		return $this->db->get_where('data_santri', ['wali_santri' => $nik])->num_rows();
	}

	public function getdetailnikwali($nik)
	{
		return $this->db->get_where('data_santri', ['wali_santri' => $nik])->result_object();
		// return $this->db->get_where('data_santri', ['wali_santri' => $nik, 'status_santri >' => 0, 'status_santri <' => 10])->result_object();
	}
}
