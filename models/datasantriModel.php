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
		try {
			$response = $this->_client->request('GET', 'datasantri', [
				'query' => [
					'KEBUNBARU-KEY' => $this->_key,
					'jabatan' => $jabatan,
					'periode' => $this->baseModel->GetPeriode(),
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


	// public function getDataWaliSantri($id)
	// {
	// 	try {
	// 		$response = $this->_client->request('GET', 'datasantri/getDataWaliSantri', [
	// 			'query' => [
	// 				'KEBUNBARU-KEY' => $this->_key,
	// 				'id' => $id
	// 			]
	// 		]);

	// 		$hasil = json_decode($response->getBody()->getContents(), false);
	// 		return $hasil->data;
	// 	} catch (ClientException $e) {
	// 		return '';
	// 	}
	// }

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
