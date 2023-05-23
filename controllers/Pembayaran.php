<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pembayaran extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('baseModel');
		$this->load->model('pembayaranModel', 'pm');

		CekLoginAkses();
	}

	public function Index()
	{
		$data = [
			'title' => 'Pembayaran Santri Baru'
		];

		$this->load->view('layout/header', $data);
		$this->load->view('pembayaran/pembayaran');
		$this->load->view('layout/footer');
		$this->load->view('pembayaran/javapembayaran');
	}


	public function coba()
	{
		// $data = [
		// 	'title' => 'Santri Boyong'
		// ];

		// $this->load->view('layout/header', $data);
		// $this->load->view('pembayaran/pembayaran');
		// $this->load->view('layout/footer');
		// $this->load->view('pembayaran/javapembayaran');

		// $pendidikan = 'idad';
		// $tipe = $this->session->userdata('tipe_user');
		// $data = $this->pm->getTahunan($pendidikan, $tipe);
		// $nominal = $data->total;

		// $detail = $this->pm->getDetailTahunanIdad($tipe);

		// $bayar = 120000;

		// foreach ($detail as $dd) {
		// 	$persen = $dd->persen_2;
		// 	$nominalj = ($bayar * $persen) / 100;
		// 	$jadi = number_format($nominalj, 0, '', '');
		// 	$this->db->insert('coba', ['nominal' => $jadi, 'tt' => 2]);
		// 	//$jadi number_format($nominalj, 0, '', '') . '<br>';
		// 	// echo $persen . '<br>';
		// }
		$nominal = 1045000;
		$bayar = 200000;

		// $persen = ($bayar / $nominal) * 100;
		$persen = ($nominal * 19.138755980861) / 100;
		echo $persen;
	}


	public function loadData()
	{
		$tipe = $this->session->userdata('tipe_user');
		$data = [
			'data' => $this->pm->getDataPemasukan($tipe)
		];

		$this->load->view('pembayaran/ajax-pembayaran', $data);
	}


	public function cekIDSantri()
	{
		$tipe = $this->session->userdata('tipe_user');
		$id = $this->input->post('id', true);
		$periode = $this->baseModel->GetPeriode();

		$cekSantri = $this->pm->cekIDSantri($id);
		$cekPembayaran = $this->pm->cekPembayaran($id, $periode);
		if ($cekPembayaran) {
			$statusPembayaran = $cekPembayaran->status_pemasukan;
			if ($statusPembayaran == 1) {
				$statusPembayaranJadi = 1;
			} else {
				$statusPembayaranJadi = 0;
			}
		} else {
			$statusPembayaranJadi = 0;
		}


		if ($cekSantri) {
			// $cekBoyong = $this->pm->cekIDBoyong($id);
			$tipeSantri = $cekSantri->tipe_santri;
			$statusSantri = $cekSantri->status_santri;
			$kelas = $cekSantri->kelas_diniyah;
			$tingkat = $cekSantri->tingkat_diniyah;
			$nik = $cekSantri->wali_santri;

			if ($tipeSantri != $tipe) {
				$hasil = ['hasil' => 'Gagal...!! ID Santri ditemukan tetapi login Anda tidak punya hak akses'];
			} elseif ($statusSantri == 0) {
				$hasil = ['hasil' => 'Gagal...!! ID Santri tercatat sudah boyong'];
			} elseif ($statusSantri == 2) {
				$hasil = ['hasil' => 'Gagal...!! Santri yang Anda maksud sedang melaksanakan tugas mengajar'];
			} elseif ($tingkat !== 'Tsanawiyah' && $tingkat !== 'I\'dadiyah') {
				$hasil = ['hasil' => 'Gagal...!! Pembayaran harus dengan manual'];
			} elseif ($tingkat == 'I\'dadiyah' && $kelas !== 'Jilid') {
				$hasil = ['hasil' => 'Gagal...!! Pembayaran harus dengan manual'];
			} elseif ($tingkat == 'Tsanawiyah' && $kelas !== '1') {
				$hasil = ['hasil' => 'Gagal...!! Pembayaran harus dengan manual'];
			} elseif ($statusPembayaranJadi == 0) {
				$hasil = ['hasil' => 'Gagal...!! ID Santri yang Anda entri sudah melunasi pembayaran'];
			} else {
				if ($tingkat == 'I\'dadiyah') {
					$tingkatx = 'idad';
				} else {
					$tingkatx = 'ts';
				}

				$cekNik = $this->pm->cekNIK($nik, $tipe);

				if ($cekNik[0] == 0) {
					$potongan = 0;
				} else {
					$potongan = $this->pm->getPotongan($tipe, $cekNik[0], $tingkatx);
				}

				$data = $this->pm->getTahunan($tingkatx, $tipe);
				if ($cekPembayaran) {
					$tarif = $cekPembayaran->tarif_jadi;
					$pemasukan = $cekPembayaran->nominal_pemasukan;
					$nominal = $tarif - $pemasukan;
				} else {
					$nominal = $data->total;
				}

				$tambah = $this->pm->tambahPemasukan($id, $tingkat, $nominal, $tipe, $nik);
				if ($tambah == 'gagal') {
					$hasil = ['hasil' => 'Gagal...!! Terjadi kesalahan saat proses'];
				} else {
					$hasil = [
						'hasil' => 0,
						'data' => $tambah[0],
						'nominal' => number_format($nominal, 0, ',', '.'),
						'nominalval' => $nominal,
						'idpemasukan' => $tambah[1],
						'pendidikan' => $tingkatx,
						'pengurangan' => $cekNik[0],
						'teks' => $cekNik[1],
						'potongan' => number_format($potongan, 0, ',', '.'),
						'potonganval' => $potongan
					];
				}
			}
		} else {
			$hasil = ['hasil' => 'Gagal...!! ID Santri tidak ditemukan'];
		}

		echo json_encode($hasil);
	}


	public function getLink($id)
	{
		$url = encrypt_url($id);

		redirect('pembayaran/alternatifWali/' . $url);
	}


	public function getLinkAngket($id)
	{
		$url = encrypt_url($id);

		redirect('pembayaran/printangket/' . $url);
	}


	public function printAngket($idx)
	{
		$id = decrypt_url($idx);

		$generator = new Picqer\Barcode\BarcodeGeneratorHTML();
		$jadi =  $generator->getBarcode($id, $generator::TYPE_CODE_128, 2, 40);

		$data = [
			'title' => 'Slip Pembayaran',
			'data' => $this->pm->getPemasukan($id),
			'detail' => $this->pm->getDetailPemasukan($id),
			'totalKe' => $this->pm->totalKe($id),
			'barcode' => @$jadi
		];

		$this->load->view('print/slip', $data);
	}


	public function cobalagi($id)
	{
		$total = $this->pm->totalKe($id);

		echo $total[0];
	}


	public function alternatifWali($id)
	{
		$idx = decrypt_url($id);
		$data = [
			'title' => 'Tambah Data Wakil Wali',
			'id' => $idx
		];
		$this->load->view('pembayaran/alternatifwali', $data);
	}


	public function getHasilSukses()
	{
		$id = $this->input->post('id', true);
		$data = ['data' => $this->pm->getHasilSukses($id)];

		$this->load->view('pembayaran/ajax-suksesdata', $data);
	}


	public function batalkanProses()
	{
		$id = $this->input->post('id', true);
		$this->pm->batalkanProses($id);
	}


	public function ubahDataWali()
	{
		$hasil = $this->pm->ubahDataWali();
		if ($hasil > 0) {
			$feedback = ['hasil' => 1];
		} else {
			$feedback = ['hasil' => 0];
		}

		echo json_encode($feedback);
	}


	public function simpanBoyong()
	{
		$id = $this->input->post('id', true);
		$bayar = $this->input->post('alasan', true);
		$pendidikan = $this->input->post('pendidikan', true);
		$pengurangan = $this->input->post('pengurangan', true);
		$potongan = $this->input->post('potongan', true);

		$tipe = $this->session->userdata('tipe_user');
		$data = $this->pm->getTahunan($pendidikan, $tipe);
		$nominal = $data->total;

		if ($pendidikan == 'idad') {
			if ($pengurangan == 0) {
				$detail = $this->pm->getDetailTahunanIdad($tipe);
				$statusp = 0;
				$nominalp = 0;
				$tarifjadi = $nominal;
			} else {
				$detail = $this->pm->getDetailTahunanIdadPengurangan($tipe, $pengurangan);
				$statusp = $pengurangan;
				$nominalp = $potongan;
				$tarifjadi = $nominal - $potongan;
			}
			$instansi = 'I\'dadiyah';
		} else {
			if ($pengurangan == 0) {
				$detail = $this->pm->getDetailTahunanTs($tipe);
				$statusp = $pengurangan;
				$nominalp = 0;
				$tarifjadi = $nominal;
			} else {
				$detail = $this->pm->getDetailTahunanTsPengurangan($tipe, $pengurangan);
				$statusp = $pengurangan;
				$nominalp = $potongan;
				$tarifjadi = $nominal - $potongan;
			}

			$instansi = 'Tsanawiyah';
		}

		//Status pemasukan 1 => Belum lunas, 2 => Lunas
		$akhir = $tarifjadi - $bayar;
		if ($akhir > 0) {
			$statusPemasukan = 1;
		} else {
			$statusPemasukan = 2;
		}

		if ($tipe == 1) {
			foreach ($detail as $dd) {
				$nominaldetail = $dd->nominal_1;

				//Ambil persen
				$topersen = ($nominaldetail / $tarifjadi) * 100;
				//Ambil nominal dari persen
				$frompersen = ($bayar * $topersen) / 100;


				// $persen = $dd->persen_1;
				// $nominalj = ($bayar * $persen) / 100;
				$jadi = number_format($frompersen, 0, '', '');
				$datax = [
					'id_detail' => '',
					'pemasukan_id' => $id,
					'akun_detail' => $dd->id_keu,
					'instansi_detail' => $instansi,
					'nominal_detail' => $jadi,
					'tipe_detail' => $tipe
				];
				$this->db->insert('detail_pemasukan', $datax);
			}
		} else {
			foreach ($detail as $dd) {
				$nominaldetail = $dd->nominal_2;

				//Ambil persen
				$topersen = ($nominaldetail / $tarifjadi) * 100;
				//Ambil nominal dari persen
				$frompersen = ($bayar * $topersen) / 100;


				// $persen = $dd->persen_1;
				// $nominalj = ($bayar * $persen) / 100;
				$jadi = number_format($frompersen, 0, '', '');
				$datax = [
					'id_detail' => '',
					'pemasukan_id' => $id,
					'akun_detail' => $dd->id_keu,
					'instansi_detail' => $instansi,
					'nominal_detail' => $jadi,
					'tipe_detail' => $tipe
				];
				$this->db->insert('detail_pemasukan', $datax);
			}
		}



		$hasil = $this->pm->simpanBoyong($id, $bayar, $statusp, $nominalp, $tarifjadi, $statusPemasukan);

		if ($hasil > 0) {
			$feedback = ['hasil' => 1];
		} else {
			$feedback = ['hasil' => 0];
		}

		// $feedback = ['hasil' => $pengurangan];

		echo json_encode($feedback);
	}


	public function getDetail()
	{
		$id = $this->input->post('id', true);
		$hasil = $this->pm->getDataBoyong($id);

		if ($hasil) {
			$data = ['hasil' => 1, 'data' => $hasil];
		} else {
			$data = ['hasil' => 0];
		}

		echo json_encode($data);
	}


	public function selesaikanProses()
	{
		$id = $this->input->post('id', true);
		$idS = $this->input->post('ids', true);
		$this->pm->updateDataSantri($idS);
		$hasil = $this->pm->selesaikanProses($id);
		if ($hasil) {
			$data = ['hasil' => $id];
		} else {
			$data = ['hasil' => 0];
		}

		echo json_encode($data);
	}


	public function updateNik()
	{
		$data = $this->pm->updateNik();
		$no = 1;
		foreach ($data as $d) {
			$id = $d->id_santri_pemasukan;
			$nik = $d->wali_santri;

			$this->pm->ubahNik($id, $nik);
		}


		// $this->db->update_batch('pemasukan', $no, 'id_santri_pemasukan');
	}


	public function UpdateStatus()
	{
		$data = $this->pm->getdataall();
		foreach ($data as $d) {
			$id = $d->id_pemasukan;
			$nik = $d->tarif_pemasukan;
			$n = $d->nominal_pemasukan;

			$j = $nik - $n;
			if ($j <= 0) {
				$hasil = 0;
			} else {
				$hasil = 1;
			}

			$this->pm->ubahNik($id, $hasil);
		}
	}


	public function ha($id)
	{
		$data = $this->db->get_where('data_santri', ['id_santri' => $id])->row_object();
		$nik = $data->wali_santri;

		$lagi = $this->db->get_where('data_santri', ['wali_santri' => $nik])->num_rows();

		print_r($lagi);
	}
}
