<?php
defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class santribaruModel extends CI_Model
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


	public function GetIndukAkhir()
	{
		return $this->db->get('data_indukakhir')->row_object();
	}


	public function getKamar($tipe)
	{
		return $this->db->get_where('data_kamar', ['tipe_kamar' => $tipe])->result_object();
	}


	public function getPendidikan($tipe, $akses)
	{
		$query = "SELECT * FROM data_pendidikan WHERE tipe_datapendidikan = $tipe AND akses_datapendidikan IN(3, $akses) ORDER BY urut_datapendidikan ASC";
		return $this->db->query($query)->result_object();
	}


	public function cekNIKWali($nik)
	{
		return $this->db->get_where('data_walisantri', ['nik_walisantri' => $nik])->row_object();
	}


	public function CekUrutAkhir($tipe, $tahun)
	{
		return $this->db->order_by('urut_santri', 'DESC')->get_where('data_santri', ['tipe_santri' => $tipe, 'tahun_masuk' => $tahun])->row_object();
	}


	public function GetUrutRegistrasi($tipe, $periode)
	{
		$data = $this->db->order_by('urut_santri', 'DESC')->get_where('data_santri', ['tipe_santri' => $tipe, 'periode_masuk' => $periode])->row_object();
		if ($data) {
			$reg  = $data->no_reg_santri;

			$pecah = explode('.', $reg);
			$akhir = (int)$pecah[2];

			$hasil = sprintf('%03d', $akhir + 1);
		} else {
			$hasil = '001';
		}

		return $hasil;
	}



	public function setIDSantri($id)
	{
		$data = $this->db->select('id_santri')
			->from('data_santri')
			->where('SUBSTRING(id_santri, 1, 6) =', $id)
			->order_by('id_santri', 'DESC')
			->get()->row_object();
		if ($data) {
			$get  = $data->id_santri;
			$hasil = $get + 1;
		} else {
			$hasil = $id . '01';
		}

		return $hasil;
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


	public function TambahSantriBaru()
	{
		$tipe = $this->session->userdata('tipe_user');

		if ($tipe == 1) {
			$sek = 'MUHAMMAD SUPANDI';
		} else {
			$sek = 'FITRI ANISA';
		}

		//Cek Urut terakhir
		// $tahun    = $this->baseModel->GetTahunHijri();
		$tahun    = $this->baseModel->GetTahunSementara();
		$uru     = $this->CekUrutAkhir($tipe, $tahun);
		// $uru     = $this->CekUrutAkhir($tipe);
		$urut    = (int)$uru;
		// $tglmasuk = $this->baseModel->GetHijriSekarang();
		$tglmasuk = $this->baseModel->GetTanggalSementara();
		// $periode  = $this->baseModel->GetPeriode();
		$periode  = $this->baseModel->GetPeriodeSementara();

		$akhirReg = $this->GetUrutRegistrasi($tipe, $periode);
		$indukakhir = $this->GetIndukAkhir();

		$pecah    = explode('-', $tglmasuk);
		$noreg    = $pecah[0] . '.' . $indukakhir . '.' . $akhirReg;

		$tahunid = substr($pecah[0], 2, 2);
		$setid = $tahunid . $pecah[1] . $pecah[2];

		$idsantri = $this->setIDSantri($setid);

		//Tanggal Lahir
		$tgl = $this->input->post('tanggallahirsantri', true);
		$bln = $this->input->post('bulanlahirsantri', true);
		$thn = $this->input->post('tahunlahirsantri', true);
		$ttl = $thn . '-' . $bln . '-' . $tgl;

		$domisili = $this->input->post('rencanadomisili', true);
		if ($domisili == 'LP2K') {
			$kamar = 'Rumah Orang Tua';
			$nomor = 0;
		} else {
			$kamar = $this->input->post('daerahsantri', true);
			$nomor = $this->input->post('nomorkamarsantri', true);
		}

		$nikwali = $this->input->post('nikwali', true);

		$data = [
			'id_santri' => $idsantri,
			'urut_santri' => $urut,
			'tipe_santri' => $tipe,
			'induk_santri' => $tahun . $urut,
			'no_reg_santri' => $noreg,
			'tahun_masuk' => $tahun,
			'tanggal_masuk' => $tglmasuk,
			'periode_masuk' => $periode,
			'nik_santri' => $this->input->post('niksantri', true),
			'kk_santri' => $this->input->post('kksantri', true),
			'nama_santri' => strtoupper($this->input->post('namasantri', true)),
			'tempat_lahir_santri' => ucwords($this->input->post('tempatlahirsantri', true)),
			'tanggal_lahir_santri' => $ttl,
			'dusun_santri' => ucwords($this->input->post('dusunsantri', true)),
			'rt_santri' => $this->input->post('rtsantri', true),
			'rw_santri' => $this->input->post('rwsantri', true),
			'desa_santri' => $this->input->post('desasantri', true),
			'kecamatan_santri' => $this->input->post('kecamatansantri', true),
			'kabupaten_santri' => $this->input->post('kabupatensantri', true),
			'provinsi_santri' => $this->input->post('provinsisantri', true),
			'kode_pos_santri' => $this->input->post('kodepossantri', true),
			'pendidikan_akhir_santri' => $this->input->post('pendidikansantri', true),
			'status_domisili_santri' => $domisili,
			'domisili_santri' => $kamar,
			'nomor_kamar_santri' => $nomor,
			'kelas_diniyah' => $this->input->post('kelasdiniyahsantri', true),
			'kelas_formal' => $this->input->post('kelasformalsantri', true),
			'tingkat_diniyah' => $this->input->post('tingkatdiniyahsantri', true),
			'tingkat_formal' => $this->input->post('tingkatformalsantri', true),
			'ayah_santri' => strtoupper($this->input->post('ayahsantri', true)),
			'ibu_santri' => strtoupper($this->input->post('ibusantri', true)),
			'status_santri' => 1,
			'wali_santri' => $nikwali,
			'hubungan_wali' => $this->input->post('hubunganwali', true),
			'panitia_santri' => $sek
		];

		$this->db->insert('data_santri', $data);

		//Cek apakah wali baru atau sudah ada
		$tipeWali = $this->input->post('tipewali', true);
		if ($tipeWali == 'baru') {
			$this->TambahWali();
		}


		// return $this->GetTerbaru($idsantri);
		return $idsantri;
	}



	public function setIDWali()
	{
		$data = $this->db->select('id_walisantri')
			->from('data_walisantri')
			->order_by('id_walisantri', 'DESC')
			->get()->row_object();
		if ($data) {
			$get  = $data->id_walisantri;
			$hasil = $get + 1;
		} else {
			$hasil = 13910001;
		}

		return $hasil;
	}


	public function TambahWali()
	{
		$nope   = str_replace('-', '', $this->input->post('nomorhpwali', true));
		$nowa   = str_replace('-', '', $this->input->post('nomorwawali', true));

		$data = [
			'id_walisantri' => $this->setIDWali(),
			'nik_walisantri' => $this->input->post('nikwali', true),
			'nama_walisantri' => strtoupper($this->input->post('namawali', true)),
			'nomor_hp_walisantri' => $nope,
			'nomor_wa_walisantri' => $nowa,
			'dusun_walisantri' => ucwords($this->input->post('dusunwali', true)),
			'rt_walisantri' => $this->input->post('rtwali', true),
			'rw_walisantri' => $this->input->post('rwwali', true),
			'desa_walisantri' => $this->input->post('desawali', true),
			'kecamatan_walisantri' => $this->input->post('kecamatanwali', true),
			'kabupaten_walisantri' => $this->input->post('kabupatenwali', true),
			'provinsi_walisantri' => $this->input->post('provinsiwali', true),
			'kode_pos_walisantri' => $this->input->post('kodeposwali', true),
			'pendidikan_akhir_walisantri' => $this->input->post('pendidikanwali', true),
			'pekerjaan_walisantri' => $this->input->post('pekerjaanwali', true)
		];
		$this->db->insert('data_walisantri', $data);

		return $this->db->affected_rows();
	}


	public function GetTerbaru($id)
	{
		return $this->db->affected_rows();
	}


	public function GetEntriTerbaru($id)
	{
		$this->db->select('*')
			->from('data_santri')
			->join('data_walisantri', 'wali_santri = nik_walisantri')
			->where(['id_santri' => $id]);
		return $this->db->get()->row_object();
	}


	public function EditDataSantri()
	{
		$tipe = $this->session->userdata('tipe_user');
		$idsantri = $this->input->post('id_santri', true);

		//Tanggal Lahir
		$tgl = $this->input->post('tanggallahirsantri', true);
		$bln = $this->input->post('bulanlahirsantri', true);
		$thn = $this->input->post('tahunlahirsantri', true);
		$ttl = $thn . '-' . $bln . '-' . $tgl;

		$domisili = $this->input->post('rencanadomisili', true);
		if ($domisili == 'LP2K') {
			$kamar = 'Rumah Orang Tua';
			$nomor = 0;
		} else {
			$kamar = $this->input->post('daerahsantri', true);
			$nomor = $this->input->post('nomorkamarsantri', true);
		}

		$data = [
			'nik_santri' => $this->input->post('niksantri', true),
			'kk_santri' => $this->input->post('kksantri', true),
			'nama_santri' => strtoupper($this->input->post('namasantri', true)),
			'tempat_lahir_santri' => ucwords($this->input->post('tempatlahirsantri', true)),
			'tanggal_lahir_santri' => $ttl,
			'dusun_santri' => ucwords($this->input->post('dusunsantri', true)),
			'rt_santri' => $this->input->post('rtsantri', true),
			'rw_santri' => $this->input->post('rwsantri', true),
			'desa_santri' => $this->input->post('desasantri', true),
			'kecamatan_santri' => $this->input->post('kecamatansantri', true),
			'kabupaten_santri' => $this->input->post('kabupatensantri', true),
			'provinsi_santri' => $this->input->post('provinsisantri', true),
			'kode_pos_santri' => $this->input->post('kodepossantri', true),
			'pendidikan_akhir_santri' => $this->input->post('pendidikansantri', true),
			'status_domisili_santri' => $domisili,
			'domisili_santri' => $kamar,
			'nomor_kamar_santri' => $nomor,
			'kelas_diniyah' => $this->input->post('kelasdiniyahsantri', true),
			'kelas_formal' => $this->input->post('kelasformalsantri', true),
			'tingkat_diniyah' => $this->input->post('tingkatdiniyahsantri', true),
			'tingkat_formal' => $this->input->post('tingkatformalsantri', true),
			'ayah_santri' => strtoupper($this->input->post('ayahsantri', true)),
			'ibu_santri' => strtoupper($this->input->post('ibusantri', true))
		];
		$this->db->where(['id_santri' => $idsantri, 'tipe_santri' => $tipe])->update('data_santri', $data);

		return $idsantri;
	}



	// public function EditDataWali()
	// {
	// 	$idsantri = $this->input->post('idsantri', true);
	// 	$nikwali  = $this->input->post('nikwaliedit', true);
	// 	$nope     = str_replace('-', '', $this->input->post('nomorhpwali', true));

	// 	$data = [
	// 		'nik_walisantri' => $this->input->post('nikwali', true),
	// 		'nama_walisantri' => strtoupper($this->input->post('namawali', true)),
	// 		'nomor_hp_walisantri' => $nope,
	// 		'dusun_walisantri' => ucwords($this->input->post('dusunwali', true)),
	// 		'rt_walisantri' => $this->input->post('rtwali', true),
	// 		'rw_walisantri' => $this->input->post('rwwali', true),
	// 		'desa_walisantri' => $this->input->post('desawali', true),
	// 		'kecamatan_walisantri' => $this->input->post('kecamatanwali', true),
	// 		'kabupaten_walisantri' => $this->input->post('kabupatenwali', true),
	// 		'provinsi_walisantri' => $this->input->post('provinsiwali', true),
	// 		'kode_pos_walisantri' => $this->input->post('kodeposwali', true),
	// 		'pendidikan_akhir_walisantri' => $this->input->post('pendidikanwali', true),
	// 		'pekerjaan_walisantri' => $this->input->post('pekerjaanwali', true),
	// 		'hubungan_walisantri' => $this->input->post('hubunganwali', true),
	// 		'idwali' => $this->input->post('idwali', true),
	// 		'nikwali' => $nikwali,
	// 		'KEBUNBARU-KEY' => $this->_key
	// 	];
	// 	// $this->db->where(['id_walisantri' => $idwali, 'id_wali_for_santri' => $idsantri])->update('data_walisantri', $data);

	// 	//Update data santri yang NO KTP sesuai dengan Wali Santrinya sesuai
	// 	// $this->db->where('wali_santri', $nikwali)->update('data_santri', ['wali_santri' => $this->input->post('nikwali', true)]);

	// 	$response = $this->_client->request('PUT', 'santribaru/editdatawali', [
	// 		'form_params' => $data
	// 	]);
	// 	$hasil = json_decode($response->getBody()->getContents(), false);

	// 	return $idsantri;
	// }

	public function EditDataWali()
	{
		$idsantri = $this->input->post('idsantri', true);
		$nikwali  = $this->input->post('nikwaliedit', true);
		$nope     = str_replace(['-', '_'], '', $this->input->post('nomorhpwali', true));
		$nowa     = str_replace(['-', '_'], '', $this->input->post('nomorwawali', true));
		$nik = $this->input->post('nikwali', true);
		$idwali = $this->input->post('idwali', true);
		$hubungan = $this->input->post('hubunganwali', true);

		$tipe = $this->input->post('tipeupdate', true);
		$total = $this->input->post('totalnik', true);

		$data = [
			'nik_walisantri' => $nik,
			'nama_walisantri' => strtoupper($this->input->post('namawali', true)),
			'nomor_hp_walisantri' => $nope,
			'nomor_wa_walisantri' => $nowa,
			'dusun_walisantri' => ucwords($this->input->post('dusunwali', true)),
			'rt_walisantri' => $this->input->post('rtwali', true),
			'rw_walisantri' => $this->input->post('rwwali', true),
			'desa_walisantri' => $this->input->post('desawali', true),
			'kecamatan_walisantri' => $this->input->post('kecamatanwali', true),
			'kabupaten_walisantri' => $this->input->post('kabupatenwali', true),
			'provinsi_walisantri' => $this->input->post('provinsiwali', true),
			'kode_pos_walisantri' => $this->input->post('kodeposwali', true),
			'pendidikan_akhir_walisantri' => $this->input->post('pendidikanwali', true),
			'pekerjaan_walisantri' => $this->input->post('pekerjaanwali', true)
		];


		$datax = [
			'id_walisantri' => $this->setIDWali(),
			'nik_walisantri' => $nik,
			'nama_walisantri' => strtoupper($this->input->post('namawali', true)),
			'nomor_hp_walisantri' => $nope,
			'nomor_wa_walisantri' => $nowa,
			'dusun_walisantri' => ucwords($this->input->post('dusunwali', true)),
			'rt_walisantri' => $this->input->post('rtwali', true),
			'rw_walisantri' => $this->input->post('rwwali', true),
			'desa_walisantri' => $this->input->post('desawali', true),
			'kecamatan_walisantri' => $this->input->post('kecamatanwali', true),
			'kabupaten_walisantri' => $this->input->post('kabupatenwali', true),
			'provinsi_walisantri' => $this->input->post('provinsiwali', true),
			'kode_pos_walisantri' => $this->input->post('kodeposwali', true),
			'pendidikan_akhir_walisantri' => $this->input->post('pendidikanwali', true),
			'pekerjaan_walisantri' => $this->input->post('pekerjaanwali', true)
		];

		//Cek Apakah NIK berubah atau tidak
		if ($nik != $nikwali) {
			//Cek apakah NIK baru sudah ada atau tidak
			$cekLagi = $this->cekNIKdiWali($nik);
			if ($cekLagi <= 0) {
				//Cek apakah santri dengan NIK lama ganda atau tidak
				if ($total > 1) {
					//Cek apakah user ingin mengubah seluruh NIK lama di data santri yang terhubung
					if ($tipe == 1) {
						$this->db->where(['id_walisantri' => $idwali])->update('data_walisantri', $data);
						$this->db->where('wali_santri', $nikwali)->update('data_santri', ['wali_santri' => $nik]);
						$hasil = 1;
					} else {
						//Jika tidak mengubah semua berarti perlu menambah data wali baru
						$this->db->insert('data_walisantri', $datax);
						$hasil = 2;
					}
				} else {
					$this->db->where(['id_walisantri' => $idwali])->update('data_walisantri', $data);
					$hasil = 3;
				}

				//Update data santri yang NO KTP sesuai dengan Wali Santrinya sesuai
				$this->db->where('id_santri', $idsantri)->update('data_santri', ['wali_santri' => $nik, 'hubungan_wali' => $hubungan]);
			} else {
				//Gagal karena NIK baru sudah tersedia
				$this->db->where('id_santri', $idsantri)->update('data_santri', ['wali_santri' => $nik, 'hubungan_wali' => $hubungan]);
				$hasil = 0;
			}

			$this->db->where('nik', $nikwali)->update('payment', ['nik' => $nik]);
		} else {
			$this->db->where(['id_walisantri' => $idwali])->update('data_walisantri', $data);
			$this->db->where('id_santri', $idsantri)->update('data_santri', ['hubungan_wali' => $hubungan]);
			$hasil = 3;
		}

		return [$idsantri, $hasil];
	}


	public function cekNIKdiWali($nik)
	{
		return $this->db->get_where('data_walisantri', ['nik_walisantri' => $nik])->num_rows();
	}


	public function cekNIKWaliSantriLain($nik, $id)
	{
		return $this->db->get_where('data_santri', ['wali_santri' => $nik, 'id_santri !=' => $id])->num_rows();
	}

	public function cekniksantri($nik)
	{
		$cek = $this->db->get_where('data_santri', ['nik_santri' => $nik])->num_rows();

		return $cek;
	}
}
