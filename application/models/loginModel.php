<?php
defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class loginModel extends CI_Model
{
	private $_client;

	public function __construct()
	{
		parent::__construct();
		$this->_client = new Client([
			'base_uri' => getURLAPI()
		]);
	}


	public function CekUser($username)
	{
		// return $this->db->get_where('data_pengguna', ['username' => $user])->row_object();
		try {
			$response = $this->_client->request('GET', 'login', [
				'query' => [
					'username' => $username,
					'KEBUNBARU-KEY' => 'f7f3d294cb068555257017c1dfb0f2'
				]
			]);

			$hasil = json_decode($response->getBody()->getContents(), false);
			return $hasil->data;
		} catch (ClientException $e) {
			return '';
		}
	}


	public function getDataLengkap($kategori, $jabatan, $user)
	{
		// $query = "SELECT a.`nama_pengguna`, b.`nama_kategoripengguna`, c.`nama_jabatan`
		// FROM data_pengguna a, kategori_pengguna b, data_jabatan c
		// WHERE a.`kategori_pengguna` = b.`id_kategoripengguna` AND a.`jabatan_pengguna` = c.`id_jabatan`
		// AND b.`id_kategoripengguna` = $kategori AND c.`id_jabatan` = $jabatan AND a.`username` = '$user'";

		// return $this->db->query($query)->row_object();

		try {
			$response = $this->_client->request('GET', 'login/getdata', [
				'query' => [
					'kategori' => $kategori,
					'jabatan' => $jabatan,
					'user' => $user,
					'KEBUNBARU-KEY' => 'f7f3d294cb068555257017c1dfb0f2'
				]
			]);

			$hasil = json_decode($response->getBody()->getContents(), false);
			return $hasil->data;
		} catch (ClientException $e) {
			return '';
		}
	}


	public function TambahAdmin()
	{
		$data = [
			'id_pengguna' => '',
			'kode_pengguna' => 'AD01',
			'nama_pengguna' => 'ADMINISTRATOR',
			'nama_ranting' => 'Administrator',
			'user_name' => 'admin',
			'kata_sandi' => password_hash('123456', PASSWORD_DEFAULT),
			'status_pengguna' => 1,
			'otoritas_pengguna' => 1,
			'gambar_pengguna' => 'default.jpg'
		];
		$this->db->insert('pengguna', $data);
	}
}