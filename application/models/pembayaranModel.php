<?php
defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class pembayaranModel extends CI_Model
{
	public function getTahunan($pendidikan, $tipe)
	{
		$data = $this->db->get_where('list_tahunan', ['name' => $pendidikan, 'tipe' => $tipe])->row_object();
		return $data;
	}


	public function getDetailTahunanIdad($tipe)
	{
		if ($tipe == 1) {
			$data = $this->db->get('tahunan_idad')->result_object();
		} else {
			$data = $this->db->get_where('tahunan_idad', ['nominal_2 !=' => 0])->result_object();
		}
		return $data;
	}


	public function getDetailTahunanIdadPengurangan($tipe, $pengurangan)
	{
		//1 => lain jenis | 2 => sama jenis
		$lain = ['P02', 'P03'];
		$sama = ['P02', 'P03', 'P12', 'P15'];
		if ($tipe == 1) {
			if ($pengurangan == 1) {
				$data = $this->db->where_not_in('id_keu', $lain)->get('tahunan_idad')->result_object();
			} else {
				$data = $this->db->where_not_in('id_keu', $sama)->get('tahunan_idad')->result_object();
			}
			// $data = $this->db->get('tahunan_idad')->result_object();
		} else {
			if ($pengurangan == 1) {
				$data = $this->db->where('nominal_2 !=', 0)->where_not_in('id_keu', $lain)->get('tahunan_idad')->result_object();
			} else {
				$data = $this->db->where('nominal_2 !=', 0)->where_not_in('id_keu', $sama)->get('tahunan_idad')->result_object();
			}
			//$data = $this->db->get_where('tahunan_idad', ['nominal_2 !=' => 0])->result_object();
		}
		return $data;
	}


	public function getDetailTahunanTs($tipe)
	{
		if ($tipe == 1) {
			$data = $this->db->get('tahunan_ts')->result_object();
		} else {
			$data = $this->db->get_where('tahunan_ts', ['nominal_2 !=' => 0])->result_object();
		}
		return $data;
	}


	public function getDetailTahunanTsPengurangan($tipe, $pengurangan)
	{
		//1 => lain jenis | 2 => sama jenis
		$lain = ['P02', 'P03'];
		$sama = ['P02', 'P03', 'P12', 'P15'];
		if ($tipe == 1) {
			if ($pengurangan == 1) {
				$data = $this->db->where_not_in('id_keu', $lain)->get('tahunan_ts')->result_object();
			} else {
				$data = $this->db->where_not_in('id_keu', $sama)->get('tahunan_ts')->result_object();
			}
			// $data = $this->db->get('tahunan_ts')->result_object();
		} else {
			if ($pengurangan == 1) {
				$data = $this->db->where('nominal_2 !=', 0)->where_not_in('id_keu', $lain)->get('tahunan_ts')->result_object();
			} else {
				$data = $this->db->where('nominal_2 !=', 0)->where_not_in('id_keu', $sama)->get('tahunan_ts')->result_object();
			}
			//$data = $this->db->get_where('tahunan_ts', ['nominal_2 !=' => 0])->result_object();
		}
		return $data;
	}


	public function updateNik()
	{
		$periode = $this->baseModel->GetPeriode();

		$this->db->select('*')
			->from('pemasukan')
			->join('data_santri', 'id_santri = id_santri_pemasukan')
			->where([
				'periode_pemasukan' => $periode
			])->order_by('urut_pemasukan', 'DESC');
		return $this->db->get()->result_object();
	}


	public function getdataall()
	{
		return $this->db->get('pemasukan')->result_object();
	}


	public function ubahNik($id, $nik)
	{
		// $this->db->update('pemasukan', ['nik_pemasukan' => $nik], ['id_santri_pemasukan' => $id]);
		// $this->db->where('id_santri_pemasukan', $id)->update('pemasukan', ['nik_pemasukan' => $nik]);

		$this->db->where('id_pemasukan', $id)->update('pemasukan', ['status_pemasukan' => $nik]);
	}

	public function getDataPemasukan($tipe)
	{
		$periode = $this->baseModel->GetPeriode();
		$tanggal = $this->baseModel->GetHijriSekarang();

		$this->db->select('*')
			->from('pemasukan')
			->join('data_santri', 'id_santri = id_santri_pemasukan')
			->where([
				'periode_pemasukan' => '1442-1443',
				'tipe_pemasukan' => $tipe
			])->order_by('urut_pemasukan', 'DESC');
		$data = $this->db->get()->result_object();

		$this->db->select('COUNT(id_pemasukan) AS total')
			->from('pemasukan')
			->where([
				'periode_pemasukan' => $periode,
				'tipe_pemasukan' => $tipe
			]);
		$total = $this->db->get()->row_object();


		$this->db->select('SUM(nominal_pemasukan) AS total')
			->from('pemasukan')
			->where([
				'periode_pemasukan' => $periode,
				'tipe_pemasukan' => $tipe,
				'tanggal_pemasukan' => $tanggal
			]);
		$totali = $this->db->get()->row_object();


		$this->db->select('SUM(nominal_pemasukan) AS total')
			->from('pemasukan')
			->where([
				'periode_pemasukan' => $periode,
				'tipe_pemasukan' => $tipe
			]);
		$totall = $this->db->get()->row_object();


		return [$data, $total, $totali, $totall];
	}



	public function cekIDSantri($id)
	{
		return $this->db->get_where('data_santri', [
			'id_santri' => $id
		])->row_object();
	}

	public function cekIDBoyong($id)
	{
		$periode = $this->baseModel->GetPeriode();
		return $this->db->get_where('data_santriboyong', [
			'id_santriboyong' => $id,
			'periode_boyong' => $periode,
			'status_angket' => 0
		])->row_object();
	}


	public function setNomor($periode)
	{
		$cek = $this->db->order_by('id_datasantriboyong', 'DESC')->get_where('data_santriboyong', ['periode_boyong' => $periode])->row_object();
		if ($cek) {
			$nomor = $cek->id_datasantriboyong;
			$hasil = $nomor + 1;
		} else {
			$hasil = 1;
		}

		return $hasil;
	}


	public function getSantri($id)
	{
		$this->db->select('*')
			->from('data_santri')
			->join('data_walisantri', 'nik_walisantri = wali_santri')
			->where('id_santri', $id);
		return $this->db->get()->row_object();
	}


	public function setNomorSurat($nomor, $tanggal)
	{
		$pecah = explode('-', $tanggal);
		$bulan = (int)$pecah[1];
		$romawi = [1 => 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VII', 'IX', 'X', 'XI', 'XII'];

		return sprintf('%03d', $nomor) . '/D.P2K/' . $romawi[$bulan] . '/' . $pecah[0];
	}


	public function cekNIK($nik, $tipe)
	{
		$periode = $this->baseModel->GetPeriode();

		if ($tipe == 1) {
			$t = 2;
		} else {
			$t = 1;
		}

		$cek = $this->db->get_where('data_santri', ['wali_santri' => $nik, 'status_santri' => 1])->num_rows();
		if ($cek <= 1) {
			$hasil = 0;
			$teks = '';
		} else {
			$cekLagi = $this->db->get_where('data_santri', [
				'wali_santri' => $nik,
				'status_santri' => 1,
				'tipe_santri' => $t
			])->num_rows();
			if ($cekLagi > 0) {
				$hasil = 1;
				$teks = 'lain jenis';
				//Lain jenis
			} else {
				$hasil = 2;
				//Satu jenis
				$teks = 'satu jenis';
			}
		}

		return [$hasil, $teks];
	}


	public function getPotongan($tipe, $potongan, $tingkat)
	{
		//1 => lain jenis | 2 => sama jenis
		$lain = ['P02', 'P03'];
		$sama = ['P02', 'P03', 'P12', 'P15'];

		if ($tipe == 1) {
			$select = 'SUM(nominal_1) AS total';
		} else {
			$select = 'SUM(nominal_2) AS total';
		}

		if ($tingkat == 'idad') {
			$from = 'tahunan_idad';
		} else {
			$from = 'tahunan_ts';
		}

		$this->db->select($select);
		$this->db->from($from);
		if ($potongan == 1) {
			$this->db->where_in('id_keu', $lain);
		} else {
			$this->db->where_in('id_keu', $sama);
		}
		$data = $this->db->get()->row_object();
		return $data->total;
	}


	public function tambahPemasukan($id, $pendidikan, $tarif, $tipe, $nik)
	{
		$periode = $this->baseModel->GetPeriode();
		$nomor =  mt_rand(10000000, 99999999);
		$tanggal = $this->baseModel->GetHijriSekarang();


		$data = [
			'urut_pemasukan' => '',
			'id_pemasukan' => $nomor,
			'tanggal_pemasukan' => $tanggal,
			'id_santri_pemasukan' => $id,
			'tarif_pemasukan' => $tarif,
			'tipe_pemasukan' => $tipe,
			'periode_pemasukan' => $periode,
			'instansi_pemasukan' => $pendidikan,
			'nik_pemasukan' => $nik
		];

		$this->db->insert('pemasukan', $data);

		$hasil = [$id, $nomor];


		return $hasil;
	}

	public function getHasilSukses($id)
	{
		$this->db->select('*')
			->from('data_santri')
			->join('data_walisantri', 'nik_walisantri = wali_santri')
			->join('pemasukan', 'id_santri_pemasukan = id_santri')
			->where(['id_santri' => $id])
			->order_by('urut_pemasukan', 'DESC');
		return $this->db->get()->row_object();
	}


	public function cekPembayaran($id, $periode)
	{
		$data = $this->db->order_by('urut_pemasukan', 'DESC')->get_where('pemasukan', [
			'id_santri_pemasukan' => $id,
			'periode_pemasukan' => $periode
		])->row_object();

		return $data;
	}

	public function getDataBoyong($id)
	{
		$periode = $this->baseModel->GetPeriode();
		$this->db->select('*')
			->from('data_santriboyong')
			->join('data_santri', 'id_santri = id_santriboyong')
			->where(['id_datasantriboyong' => $id, 'periode_boyong' => $periode]);
		return $this->db->get()->row_object();
	}


	public function batalkanProses($id)
	{
		$this->db->where('id_pemasukan', $id)->delete('pemasukan');
	}


	public function ubahDataWali()
	{
		$id = $this->input->post('idsantriboyong', true);
		$periode = $this->baseModel->GetPeriode();
		$data = [
			'status_wali' => 2,
			'nama_wali' => strtoupper($this->input->post('namawakilwali', true)),
			'desa_wali' => $this->input->post('desawakilwali', true),
			'kec_wali' => $this->input->post('kecwakilwali', true),
			'kab_wali' => $this->input->post('kabwakilwali', true),
			'pro_wali' => $this->input->post('prowakilwali', true),
			'pos_wali' => $this->input->post('poswakilwali', true),
			'pekerjaan_wali' => $this->input->post('pekerjaanwakilwali', true)
		];
		$this->db->where([
			'id_datasantriboyong' => $id,
			'periode_boyong' => $periode
		])->update('data_santriboyong', $data);
		return $this->db->affected_rows();
	}


	public function simpanBoyong($id, $bayar, $statusp, $nominalp, $tarifjadi, $statusPemasukan)
	{
		$this->db->where('id_pemasukan', $id)->update('pemasukan', [
			'nominal_pemasukan' => $bayar,
			'status_pengurangan' => $statusp,
			'nominal_pengurangan' => $nominalp,
			'tarif_jadi' => $tarifjadi,
			'status_pemasukan' => $statusPemasukan
		]);
		return $this->db->affected_rows();
	}



	public function updateDataSantri($id)
	{
		$this->db->where('id_santri', $id)->update('data_santri', ['status_santri' => 0]);
	}


	public function selesaikanProses($id)
	{
		$periode = $this->baseModel->GetPeriode();
		$tanggal = $this->baseModel->GetHijriSekarang();
		$this->db->where([
			'id_datasantriboyong' => $id,
			'periode_boyong' => $periode
		])->update('data_santriboyong', [
			'status_angket' => 1,
			'tanggal_boyong' => $tanggal
		]);
		return $this->db->affected_rows();
	}


	public function getNamaPengurus($induk)
	{
		$data = $this->db->get_where('data_pengurus', ['induk_pengurus' => $induk])->row_object();
		if ($data) {
			$hasil = $data->nama_pengurus;
		} else {
			$hasil = 'TIDAK ADA';
		}

		return $hasil;
	}


	public function getKepalaPendidikan($periode, $tipe, $madrasah)
	{
		$data = $this->db->get_where('jabatan_pengurus', [
			'jabatan_jabatanpengurus' => 26,
			'bagian_jabatanpengurus' => $tipe,
			'instansi_jabatanpengurus' => $madrasah,
			'periode_jabatanpengurus' => $periode,
			'status_jabatanpengurus' => 1
		])->row_object();
		if ($data) {
			$id = $data->induk_jabatanpengurus;
			$hasil = $this->getNamaPengurus($id);
		} else {
			$hasil = 'TIDAK ADA';
		}

		return $hasil;
	}


	public function getKetua($periode, $tipe, $jabatan)
	{
		if ($jabatan == 20) {
			$tipex = $tipe;
		} else {
			$tipex = 3;
		}

		$data = $this->db->get_where('jabatan_pengurus', [
			'jabatan_jabatanpengurus' => $jabatan,
			'bagian_jabatanpengurus' => $tipex,
			'periode_jabatanpengurus' => $periode,
			'status_jabatanpengurus' => 1
		])->row_object();
		if ($data) {
			$id = $data->induk_jabatanpengurus;
			$hasil = $this->getNamaPengurus($id);
		} else {
			$hasil = 'TIDAK ADA';
		}

		return $hasil;
	}

	public function getPemasukan($id)
	{
		//return $this->db->get_where('pemasukan', ['id_pemasukan' => $id])->row_object();
		$this->db->select('*')
			->from('pemasukan')
			->join('data_santri', 'id_santri = id_santri_pemasukan')
			->where(['id_pemasukan' => $id]);
		return $this->db->get()->row_object();
	}


	public function getDetailPemasukan($id)
	{
		$this->db->select('*')
			->from('detail_pemasukan')
			->join('akun_keuangan', 'id_akunkeuangan = akun_detail')
			->where('pemasukan_id', $id);
		return $this->db->get()->result_object();
	}

	public function totalKe($idx)
	{
		$getID = $this->db->get_where('pemasukan', ['id_pemasukan' => $idx])->row_object();
		$id = $getID->id_santri_pemasukan;

		$periode = $this->baseModel->GetPeriode();
		$ke = $this->db->get_where('pemasukan', [
			'id_santri_pemasukan' => $id,
			'periode_pemasukan' => $periode
		])->num_rows();

		$this->db->select('SUM(nominal_pemasukan) AS total')
			->from('pemasukan')
			->where([
				'id_santri_pemasukan' => $id,
				'periode_pemasukan' => $periode
			]);
		$total = $this->db->get()->row_object();
		return [$ke, $total];
	}
}
