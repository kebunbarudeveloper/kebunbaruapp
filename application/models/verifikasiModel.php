<?php
defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class verifikasiModel extends CI_Model
{
	private $_client;
	private $_sekretaris;
	private $_key;

	public function __construct()
	{
		parent::__construct();
		$this->_client = new Client([
			'base_uri' => getURLAPI()
		]);

		$this->_sekretaris = $this->session->userdata('tipe_user');
		$this->_key = 'f7f3d294cb068555257017c1dfb0f2';
	}


	public function cekNomorRegistrasi($id)
	{
		$cek = $this->db->get_where('santri_online', ['id_santri' => $id])->num_rows();

		if ($cek >= 1) {
			$this->db->select('*')
				->from('santri_online')
				->join('wali_online', 'santri = id_santri')
				->where(['id_santri' => $id]);
			return $this->db->get()->row_object();
		} else {
			return 0;
		}
	}


	public function ubahStatus($id, $hasil)
	{
		$this->db->where('id_santri', $id)->update('santri_online', ['status' => $hasil]);
	}


	public function GetIndukAkhir()
	{
		$tipe = $this->session->userdata('tipe_user');
		// $data = $this->db->get('data_indukakhir')->row_object();

		try {
			$response = $this->_client->request('GET', 'santribaru', [
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


	public function getKamar($tipe)
	{
		// return $this->db->get_where('data_kamar', ['tipe_kamar' => $tipe])->result_object();
		try {
			$response = $this->_client->request('GET', 'santribaru/getkamar', [
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


	public function getPendidikan($tipe, $akses)
	{
		// $query = "SELECT * FROM data_pendidikan WHERE tipe_datapendidikan = $tipe AND akses_datapendidikan IN(3, $akses) ORDER BY urut_datapendidikan ASC";
		// return $this->db->query($query)->result_object();
		try {
			$response = $this->_client->request('GET', 'santribaru/getpendidikan', [
				'query' => [
					'KEBUNBARU-KEY' => $this->_key,
					'tipe' => $tipe,
					'akses' => $akses
				]
			]);

			$hasil = json_decode($response->getBody()->getContents(), false);
			return $hasil->data;
		} catch (ClientException $e) {
			return '';
		}
	}


	public function cekNIKWali($nik)
	{
		// return $this->db->get_where('data_walisantri', ['nik_walisantri' => $nik])->row_object();
		try {
			$response = $this->_client->request('GET', 'santribaru/cekNIKWali', [
				'query' => [
					'KEBUNBARU-KEY' => $this->_key,
					'nik' => $nik
				]
			]);

			$hasil = json_decode($response->getBody()->getContents(), false);
			return $hasil->data;
		} catch (ClientException $e) {
			return '';
		}
	}


	public function CekUrutAkhir($tipe, $tahun)
	{
		// $data = $this->db->order_by('urut_santri', 'DESC')->get_where('data_santri', ['tipe_santri' => $tipe])->row_object();
		// $akhir = $data->urut_santri;

		// return $akhir + 1;

		try {
			$response = $this->_client->request('GET', 'santribaru/CekUrutAkhir', [
				'query' => [
					'KEBUNBARU-KEY' => $this->_key,
					'tipe' => $tipe,
					'tahun' => $tahun
				]
			]);

			$hasil = json_decode($response->getBody()->getContents(), false);
			return $hasil->data;
		} catch (ClientException $e) {
			return '';
		}
	}


	public function GetUrutRegistrasi($tipe, $periode)
	{
		// $data = $this->db->order_by('urut_santri', 'DESC')->get_where('data_santri', ['tipe_santri' => $tipe, 'periode_masuk' => $periode])->row_object();
		// if ($data) {
		//     $reg  = $data->no_reg_santri;

		//     $pecah = explode('.', $reg);
		//     $akhir = (int)$pecah[2];

		//     $hasil = sprintf('%03d', $akhir + 1);
		// } else {
		//     $hasil = '001';
		// }

		// return $hasil;

		try {
			$response = $this->_client->request('GET', 'santribaru/GetUrutRegistrasi', [
				'query' => [
					'KEBUNBARU-KEY' => $this->_key,
					'tipe' => $tipe,
					'periode' => $periode
				]
			]);

			$hasil = json_decode($response->getBody()->getContents(), false);
			return $hasil->data;
		} catch (ClientException $e) {
			return '';
		}
	}



	public function setIDSantri($id)
	{
		try {
			$response = $this->_client->request('GET', 'santribaru/setIDSantri', [
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


	public function getIDSekretaris($periode)
	{
		$data = $this->db->get_where('jabatan_pengurus', [
			'jabatan_jabatanpengurus' => 21,
			'bagian_jabatanpengurus' => $this->_sekretaris,
			'periode_jabatanpengurus' => $periode,
			'status_jabatanpengurus' => 1
		])->row_object();

		$induk = $data->induk_jabatanpengurus;

		$getNama = $this->db->select('nama_pengurus')->from('data_pengurus')->where('induk_pengurus', $induk)
			->get()->row_object();

		return $getNama->nama_pengurus;
	}


	public function prosesData($data)
	{
		$tipe = $this->session->userdata('tipe_user');

		if ($tipe == 1) {
			$sek = 'RAHMAN FARUQ';
		} else {
			$sek = 'SITI ROHMAH';
		}

		//Cek Urut terakhir
		$tahun    = $this->baseModel->GetTahunHijri();
		//$tahun    = $this->baseModel->GetTahunSementara();
		$uru     = $this->CekUrutAkhir($tipe, $tahun);
		$urut    = (int)$uru;
		$tglmasuk = $this->baseModel->GetHijriSekarang();
		//$tglmasuk = $this->baseModel->GetTanggalSementara();
		$periode  = $this->baseModel->GetPeriode();
		//$periode  = $this->baseModel->GetPeriodeSementara();

		$akhirReg = $this->GetUrutRegistrasi($tipe, $periode);
		$indukakhir = $this->GetIndukAkhir();

		$pecah    = explode('-', $tglmasuk);
		$noreg    = $pecah[0] . '.' . $indukakhir . '.' . $akhirReg;

		$tahunid = substr($pecah[0], 2, 2);
		$setid = $tahunid . $pecah[1] . $pecah[2];

		$idsantri = $this->setIDSantri($setid);

		$datax = [
			'id_santri' => $idsantri,
			'urut_santri' => $urut,
			'tipe_santri' => $tipe,
			'induk_santri' => $tahun . $urut,
			'no_reg_santri' => $noreg,
			'tahun_masuk' => $tahun,
			'tanggal_masuk' => $tglmasuk,
			'periode_masuk' => $periode,
			'nik_santri' => $data->nik,
			'kk_santri' => $data->kk,
			'nama_santri' => $data->nama,
			'tempat_lahir_santri' => $data->tempat,
			'tanggal_lahir_santri' => $data->tanggal,
			'dusun_santri' => $data->dusun,
			'rt_santri' => $data->rt,
			'rw_santri' => $data->rw,
			'desa_santri' => $data->desa,
			'kecamatan_santri' => $data->kecamatan,
			'kabupaten_santri' => $data->kabupaten,
			'provinsi_santri' => $data->provinsi,
			'kode_pos_santri' => $data->pos,
			'pendidikan_akhir_santri' => $data->pendidikan,
			'status_domisili_santri' => $data->domisili,
			'domisili_santri' => $data->daerah,
			'nomor_kamar_santri' => $data->nomor,
			'kelas_diniyah' => $data->kelasd,
			'kelas_formal' => $data->kelasf,
			'tingkat_diniyah' => $data->diniyah,
			'tingkat_formal' => $data->formal,
			'ayah_santri' => $data->ayah,
			'ibu_santri' => $data->ibu,
			'status_santri' => 1,
			'wali_santri' => $data->nikw,
			'panitia_santri' => $sek,
			'KEBUNBARU-KEY' => $this->_key
		];

		// $this->db->insert('data_santri', $data);

		$response = $this->_client->request('POST', 'santribaru', [
			'form_params' => $datax
		]);

		$hasil = json_decode($response->getBody()->getContents(), false);

		//Cek apakah wali baru atau sudah ada
		$tipeWali = $this->cekNIKWali($data->nikw);
		if ($tipeWali == FALSE) {
			$this->TambahWali($data);
		}


		// return $this->GetTerbaru($idsantri);
		return $idsantri;
	}



	public function setIDWali()
	{
		try {
			$response = $this->_client->request('GET', 'santribaru/setIDWali', [
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


	public function TambahWali($data)
	{

		$datax = [
			'id_walisantri' => $this->setIDWali(),
			'nik_walisantri' => $data->nikw,
			'nama_walisantri' => $data->namaw,
			'nomor_hp_walisantri' => $data->hp,
			'dusun_walisantri' => $data->dusunw,
			'rt_walisantri' => $data->rtw,
			'rw_walisantri' => $data->rww,
			'desa_walisantri' => $data->desaw,
			'kecamatan_walisantri' => $data->kecamatanw,
			'kabupaten_walisantri' => $data->kabupatenw,
			'provinsi_walisantri' => $data->provinsiw,
			'kode_pos_walisantri' => $data->posw,
			'pendidikan_akhir_walisantri' => $data->pendidikanw,
			'pekerjaan_walisantri' => $data->pekerjaan,
			'hubungan_walisantri' => $data->hubungan,
			'KEBUNBARU-KEY' => $this->_key
		];
		// $this->db->insert('data_walisantri', $data);

		$response = $this->_client->request('POST', 'santribaru/tambahwali', [
			'form_params' => $datax
		]);
		$hasil = json_decode($response->getBody()->getContents(), false);
	}
}
