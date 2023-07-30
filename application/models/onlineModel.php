<?php
defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class onlineModel extends CI_Model
{
	private $_client;
	private $_key;

	public function __construct()
	{
		parent::__construct();
		$this->_client = new Client([
			'base_uri' => 'https://bpstikebunbaru.com/'
		]);

		$this->_key = 'f7f3d294cb068555257017c1dfb0f2';
	}


	public function getData()
	{
		try {
			$response = $this->_client->request('GET', 'datasantri', [
				'query' => [
					'KEBUNBARU-KEY' => $this->_key
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


	public function proses($data)
	{
		$datax = [
			'id_santri' => $data->id_santri,
			'jenis' => $data->jenis,
			'nik' => $data->nik,
			'kk' => $data->kk,
			'nama' => $data->nama,
			'tempat' => $data->tempat,
			'tanggal' => $data->tanggal,
			'dusun' => $data->dusun,
			'rt' => $data->rt,
			'rw' => $data->rw,
			'desa' => $data->desa,
			'kecamatan' => $data->kecamatan,
			'kabupaten' => $data->kabupaten,
			'provinsi' => $data->provinsi,
			'pos' => $data->pos,
			'pendidikan' => $data->pendidikan,
			'domisili' => $data->domisili,
			'daerah' => $data->daerah,
			'nomor' => $data->nomor,
			'kelasd' => $data->kelasd,
			'kelasf' => $data->kelasf,
			'diniyah' => $data->diniyah,
			'formal' => $data->formal,
			'ayah' => $data->ayah,
			'ibu' => $data->ibu
		];
		$this->db->insert('santri_online', $datax);

		$this->simpanDataWali($data);
	}



	public function simpanDataWali($data)
	{
		$datax = [
			'id_wali' => $data->id_wali,
			'santri' => $data->santri,
			'nikw' => $data->nikw,
			'namaw' => $data->namaw,
			'hp' => $data->hp,
			'wa' => $data->wa,
			'dusunw' => $data->dusunw,
			'rtw' => $data->rtw,
			'rww' => $data->rww,
			'desaw' => $data->desaw,
			'kecamatanw' => $data->kecamatanw,
			'kabupatenw' => $data->kabupatenw,
			'provinsiw' => $data->provinsiw,
			'posw' => $data->posw,
			'pendidikanw' => $data->pendidikanw,
			'pekerjaan' => $data->pekerjaan,
			'hubungan' => $data->hubungan
		];
		$this->db->insert('wali_online', $datax);
	}


	public function ubahStatus($id)
	{
		$data = [
			'id' => $id,
			'status' => 2,
			'KEBUNBARU-KEY' => $this->_key
		];

		$response = $this->_client->request('PUT', 'datasantri', [
			'form_params' => $data
		]);
		$hasil = json_decode($response->getBody()->getContents(), false);


		return $id;
	}
}
