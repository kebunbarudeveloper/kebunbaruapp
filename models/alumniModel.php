<?php
defined('BASEPATH') or exit('No direct script access allowed');

class alumniModel extends CI_Model
{
	public function TambahSantriBaru()
	{
		$tipe = $this->session->userdata('tipe_user');

		//Cek Urut terakhir
		// $tahun    = $this->baseModel->GetTahunHijri();
		$tahun    = $this->baseModel->GetTahunSementara();
		$uru     = $this->CekUrutAkhir($tipe, $tahun);
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
			'panitia_santri' => $this->getIDSekretaris($periode),
			'KEBUNBARU-KEY' => $this->_key
		];

		// $this->db->insert('data_santri', $data);

		$response = $this->_client->request('POST', 'santribaru', [
			'form_params' => $data
		]);

		$hasil = json_decode($response->getBody()->getContents(), false);

		// return $this->GetTerbaru($idsantri);
		return $idsantri;
	}
}
