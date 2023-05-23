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


	public function getDataSantri($tipe)
	{
		try {
			$response = $this->_client->request('GET', 'datasantri', [
				'query' => [
					'KEBUNBARU-KEY' => $this->_key,
					'tipe' => $tipe
				]
			]);

			$hasil = json_decode($response->getBody()->getContents(), false);
			return $hasil->data;
		} catch (ClientException $e) {
			return '';
		}
	}


	public function dataSantriAll($tipe)
	{
		try {
			$response = $this->_client->request('GET', 'datasantri/dataSantriAll', [
				'query' => [
					'KEBUNBARU-KEY' => $this->_key,
					'tipe' => $tipe
				]
			]);

			$hasil = json_decode($response->getBody()->getContents(), false);
			return $hasil->data;
		} catch (ClientException $e) {
			return '';
		}
	}


	public function getDetail($id)
	{
		try {
			$response = $this->_client->request('GET', 'datasantri/getdetail', [
				'query' => [
					'KEBUNBARU-KEY' => $this->_key,
					'id' => $id
				]
			]);

			$hasil = json_decode($response->getBody()->getContents(), false);
			return $hasil->data;
		} catch (ClientException $e) {
			return '';
		}
	}


	public function getDataSantriFilter($params = [])
	{
		try {
			$response = $this->_client->request('GET', 'datasantri/getDataSantriFilter', [
				'query' => [
					'KEBUNBARU-KEY' => $this->_key,
					'params' => $params
				]
			]);

			$hasil = json_decode($response->getBody()->getContents(), false);
			return $hasil->data;
		} catch (ClientException $e) {
			return '';
		}
	}


	public function getDataSantriID($id)
	{
		try {
			$response = $this->_client->request('GET', 'datasantri/getDataSantriID', [
				'query' => [
					'KEBUNBARU-KEY' => $this->_key,
					'id' => $id
				]
			]);

			$hasil = json_decode($response->getBody()->getContents(), false);
			return $hasil->data;
		} catch (ClientException $e) {
			return '';
		}
	}


	public function getDataWaliSantri($id)
	{
		try {
			$response = $this->_client->request('GET', 'datasantri/getDataWaliSantri', [
				'query' => [
					'KEBUNBARU-KEY' => $this->_key,
					'id' => $id
				]
			]);

			$hasil = json_decode($response->getBody()->getContents(), false);
			return $hasil->data;
		} catch (ClientException $e) {
			return '';
		}
	}


	public function EditDataWali()
	{
		$idsantri = $this->input->post('idsantri', true);
		$nikwali  = $this->input->post('nikwaliedit', true);
		$nope     = str_replace('-', '', $this->input->post('nomorhpwali', true));

		$data = [
			'nik_walisantri' => $this->input->post('nikwali', true),
			'nama_walisantri' => strtoupper($this->input->post('namawali', true)),
			'nomor_hp_walisantri' => $nope,
			'dusun_walisantri' => ucwords($this->input->post('dusunwali', true)),
			'rt_walisantri' => $this->input->post('rtwali', true),
			'rw_walisantri' => $this->input->post('rwwali', true),
			'desa_walisantri' => $this->input->post('desawali', true),
			'kecamatan_walisantri' => $this->input->post('kecamatanwali', true),
			'kabupaten_walisantri' => $this->input->post('kabupatenwali', true),
			'provinsi_walisantri' => $this->input->post('provinsiwali', true),
			'kode_pos_walisantri' => $this->input->post('kodeposwali', true),
			'pendidikan_akhir_walisantri' => $this->input->post('pendidikanwali', true),
			'pekerjaan_walisantri' => $this->input->post('pekerjaanwali', true),
			'hubungan_walisantri' => $this->input->post('hubunganwali', true),
			'idwali' => $this->input->post('idwali', true),
			'nikwali' => $nikwali,
			'idsantri' => $idsantri,
			'tipe' => $this->input->post('tipewali', true),
			'KEBUNBARU-KEY' => $this->_key
		];
		// $this->db->where(['id_walisantri' => $idwali, 'id_wali_for_santri' => $idsantri])->update('data_walisantri', $data);

		//Update data santri yang NO KTP sesuai dengan Wali Santrinya sesuai
		// $this->db->where('wali_santri', $nikwali)->update('data_santri', ['wali_santri' => $this->input->post('nikwali', true)]);

		$response = $this->_client->request('PUT', 'datasantri/editdatawali', [
			'form_params' => $data
		]);
		$hasil = json_decode($response->getBody()->getContents(), false);

		return $idsantri;
	}
}