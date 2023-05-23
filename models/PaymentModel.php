<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PaymentModel extends CI_Model
{
    public function getdata()
    {
        $periode = $this->baseModel->GetPeriode();
        $tipe = $this->session->userdata('tipe_user');
        $status = $this->input->post('status', true);
        $bulan = $this->input->post('hijriah', true);
        $nama = $this->input->post('nama', true);

        $this->db->select('*')->from('payment')->join('data_santri', 'id_santri = santri');
        if (!empty($status)) {
            $this->db->where('status', $status);
        }
        if (!empty($bulan)) {
            $this->db->where('SUBSTRING(hijriah, 6, 2) =', $bulan);
        }
        if (!empty($nama)) {
            $this->db->like('nama_santri', $nama);
        }
        $this->db->where(['periode' => $periode, 'tipe' => $tipe])->order_by('urut', 'DESC');
        $data = $this->db->get()->result_object();

        //GET TOTAL
        $this->db->select('id')->from('payment')->where(['periode' => $periode, 'tipe' => $tipe]);
        if (!empty($status)) {
            $this->db->where('status', $status);
        }
        if (!empty($bulan)) {
            $this->db->where('SUBSTRING(hijriah, 6, 2) =', $bulan);
        }

        $total = $this->db->get()->num_rows();

        //GET TOTAL NOMINAL
        $this->db->select_sum('nominal')->from('payment')->where(['periode' => $periode, 'tipe' => $tipe]);
        if (!empty($status)) {
            $this->db->where('status', $status);
        }
        if (!empty($bulan)) {
            $this->db->where('SUBSTRING(hijriah, 6, 2) =', $bulan);
        }

        $nominal = $this->db->get()->row_object();
        return [$data, $total, $nominal];
    }

    public function getpengaturan()
    {
        $periode = $this->baseModel->GetPeriode();
        $tipe = $this->session->userdata('tipe_user');
        return $this->db->get_where('tutup_pengaturan', [
            'tipe' => $tipe,
            'periode' => $periode
        ])->num_rows();
    }

    public function cekdata()
    {
        $periode = $this->baseModel->GetPeriode();
        $id = $this->input->post('id', true);
        $tipe = $this->session->userdata('tipe_user');

        //CEK DATA SANTRI
        $cekDataSantri = $this->db->get_where('data_santri', ['id_santri' => $id])->row_object();
        if (!$cekDataSantri) {
            return ['status' => 500, 'message' => 'Santri tidak ditemukan'];
        }

        $statusSantri = $cekDataSantri->status_santri;
        $jenisSantri = $cekDataSantri->tipe_santri;
        $kelas = $cekDataSantri->kelas_diniyah;
        $tingkat = $cekDataSantri->tingkat_diniyah;
        if ($statusSantri != 1) {
            return ['status' => 500, 'message' => 'Santri sudah tidak aktif'];
        }

        if ($jenisSantri != $tipe) {
            return ['status' => 500, 'message' => 'Anda tidak punya hak akses untuk melayani'];
        }

        if ($tingkat == '' || $tingkat == 'RA' || $tingkat == 'Kuliah Syari\'ah') {
            return ['status' => 500, 'message' => 'Pelayanan untuk RA atau TIDAK SEKOLAH tetap manual'];
        }

        // if ($tingkat == '' || $tingkat == 'Kuliah Syari\'ah') {
        //     return ['status' => 500, 'message' => 'Tingkat madrasah tidak valid'];
        // }

        //CEK PAYMENT
        $cekPayment = $this->cekpayment($id, $periode);
        if ($cekPayment) {
            $status = $cekPayment->status;
            if ($status == 'LUNAS') {
                return ['status' => 500, 'message' => 'Santri ini sudah melunasi pembayaran'];
            }
        }

        //CEK TARIF
        if ($kelas == 'Takhossus' || $kelas == 'Praktik') {
            $kelas = 'jilid';
        } else {
            $kelas = $kelas;
        }

        $cekTarif = $this->db->get_where('list_tarif', [
            'kelas' => $kelas, 'tingkat' => $tingkat, 'tipe' => $tipe, 'periode' => $periode
        ])->num_rows();
        if ($cekTarif <= 0) {
            return ['status' => 500, 'message' => 'Tarif kelas ' . $kelas . ' - ' . $tingkat . ' belum diatur'];
        }

        return ['status' => 200, 'message' => 'Sukses'];
    }

    public function cekdetaildiskon()
    {
        $periode = $this->baseModel->GetPeriode();
        $id = $this->input->post('id', true);
        $cekDataSantri = $this->cekidsantri($id);
        $kelas = $cekDataSantri->kelas_diniyah;
        $tingkat = $cekDataSantri->tingkat_diniyah;
        $nik = $cekDataSantri->wali_santri;
        $tipeSantri = $cekDataSantri->tipe_santri;
        $periodeSantri = $cekDataSantri->periode_masuk;

        //CEK SANTRI DI PAYMENT || JIKA SUDAH ADA, MAKA PENGURANGAN ADA
        $cekpayemnt = $this->cekpayment($id, $periode);

        //SET SEMUA KOSONG
        $domisili = 0;
        $saudara = 0;
        $tipesaudara = 0;
        $seragam = 0;
        $penambahan = 0;
        $tagihan = 0;
        $sisa = 0;
        $edit = 0;
        $pembayaran = 0;
        $ubahDomisili = 0;

        if (!$cekpayemnt) {

            //OPSI MUTASI DOMISILI
            if ($periodeSantri == $periode || $kelas == 1 || $kelas == 'TPQ') {
                $domisili = 1;
            }

            //OPSI SAUDARA
            $ceksaudara = $this->ceksaudara($id, $nik, $tipeSantri);

            //OPSI SERAGAM
            if ($kelas == 3 && $tingkat == 'Tsanawiyah' && $tipeSantri == 1) {
                $seragam = 1;
            }

            //OPSI PENAMBAHAN MUTASI JENJANG
            // if ($periodeSantri != $periode && $kelas != 1 && $tingkat == 'Ibtidaiyah') {
            //     $penambahan = 1;
            // }
            if ($periodeSantri != $periode && $kelas != 1) {
                $penambahan = 1;
            }

            if ($cekDataSantri->status_domisili_santri == 'P2K' && $periodeSantri != $periode) {
                $ubahDomisili = 1;
            }

            $saudara = $ceksaudara[0];
            $tipesaudara = $ceksaudara[1];
            $tagihan = $this->pm->gettarif($id);
            $sisa = $this->pm->gettarif($id);
            $edit = 1;
            $pembayaran = 'Pembayaran Pertama';
        } else {
            $pembayaran = 'Pembayaran Kedua';
            $tagihan = $cekpayemnt->tagihan;
            $sisa = $cekpayemnt->sisa;
        }

        return [
            'domisili' => $domisili,
            'ubah_domisili' => $ubahDomisili,
            'saudara' => $saudara,
            'tipe_saudara' => $tipesaudara,
            'seragam' => $seragam,
            'penambahan' => $penambahan,
            'tagihan' => $tagihan,
            'sisa' => $sisa,
            'edit' => $edit,
            'tahap' => $pembayaran,
            'nik' => $nik
        ];
    }

    public function ceksaudara($id, $nik, $tipe)
    {
        $periode = $this->baseModel->GetPeriode();
        //CEK NIK YANG SAMA DI TABEL PAYMENT
        $ceknik = $this->db->get_where('payment', [
            'nik' => $nik, 'santri !=' => $id, 'periode' => $periode
        ])->num_rows();

        $cekniksantri = $this->db->get_where('data_santri', [
            'wali_santri' => $nik, 'id_santri !=' => $id, 'status_santri' => 1
        ])->num_rows();

        //CEK NIK LAIN YANG SAMA DI PAYMENT
        if ($ceknik > 0) {

            //CEK NIK LAIN YANG SAMA DI DATA_SANTRI
            if ($cekniksantri > 0) {
                $dataniksantri = $this->db->get_where('data_santri', [
                    'wali_santri' => $nik, 'status_santri' => 1
                ])->result_object();


                $domisili = [];
                foreach ($dataniksantri as $d) {
                    $domisili[] = [$d->status_domisili_santri];
                }

                $dataniktipesantri = $this->db->get_where('data_santri', [
                    'wali_santri' => $nik, 'status_santri' => 1, 'id_santri !=' => $id
                ])->result_object();

                $tipes = [];
                foreach ($dataniktipesantri as $d) {
                    $tipes[] = [$d->tipe_santri];
                }

                //JIKA SEJENIS => 1 || BUKAN SEJENIS => 2
                if (in_array_r($tipe, $tipes)) {
                    $jenis = 1;
                } else {
                    $jenis = 2;
                }

                //JIKA SAUDARA BEDA DOMISILI, MAKA YANG DIKURANGI ADALAH INFAQ PEMBANGUNAN LP2K
                if (in_array_r('LP2K', $domisili)) {
                    $dom = 'LP2K';
                } else {
                    $dom = 'P2K';
                }

                return [$jenis, $dom];
                // return [$tipes, $domisili];
            } else {
                return [0, 0];
            }
        } else {
            return [0, 0];
        }
    }

    public function cekidsantri($id)
    {
        $tipe = $this->session->userdata('tipe_user');
        return $this->db->get_where('data_santri', [
            'tipe_santri' => $tipe,
            'status_santri' => 1,
            'id_santri' => $id
        ])->row_object();
    }

    public function cekpayment($id, $periode)
    {
        return $this->db->order_by('created_at', 'DESC')->get_where('payment', [
            'santri' => $id, 'periode' => $periode
        ])->row_object();
    }

    public function gettarif($id)
    {
        $cek = $this->cekidsantri($id);
        $kelas = $cek->kelas_diniyah;
        $tingkat = $cek->tingkat_diniyah;
        $tipe = $cek->tipe_santri;
        $periodeSantri = $cek->periode_masuk;
        $periode = $this->baseModel->GetPeriode();
        $domisili = $cek->status_domisili_santri;

        if ($kelas == 'Praktik' || $kelas == 'Takhossus') {
            $kelasfinal = 'Jilid';
        } else {
            $kelasfinal = $kelas;
        }

        $get = $this->db->get_where('list_tarif', [
            'kelas' => $kelasfinal,
            'tingkat' => $tingkat,
            'tipe' => $tipe,
            'periode' => $periode
        ])->row_object();

        //GET TARIF PENDAFTARAN MADRASAH
        $tarifP07 = $this->db->get_where('tarif_pendaftaran', [
            'kode' => 'P07', 'periode' => $periode
        ])->row_object();
        $tarifPendaftaran = $tarifP07->nominal;

        if ($domisili == 'P2K') {
            if ($periodeSantri != $periode) {
                //SANTRI LAMA
                $tarif = $get->santri_lama;
            } else {
                //SANTRI BARU
                $tarif = $get->santri_baru;
            }

            $penguranganRA = 0;
        } else {
            if ($periodeSantri != $periode) {
                //MURID LAMA
                $tarif = $get->murid_lama;
            } else {
                //MURID BARU
                $tarif = $get->murid_baru;
            }

            $penguranganRA = 50000;
        }

        if ($kelas == 1 && $periodeSantri != $periode) {
            $tarifjadi = $tarif + $tarifPendaftaran;
        } else {
            $tarifjadi = $tarif;
        }

        if ($tingkat == 'RA') {
            $tarifAkhir = $tarifjadi - $penguranganRA;
        } else {
            $tarifAkhir = $tarifjadi;
        }

        // return $tarifjadi;
        return $tarifAkhir;
    }

    public function getdatasantri($id)
    {
        $this->db->select('*')->from('data_santri')->join('data_walisantri', 'wali_santri = nik_walisantri');
        $this->db->where('id_santri', $id);
        return $this->db->get()->row_object();
    }

    public function editkelas()
    {
        $id = $this->input->post('id', true);
        $kelas = $this->input->post('kelas', true);
        $tingkat = $this->input->post('tingkat', true);
        $this->db->where('id_santri', $id)->update('data_santri', [
            'kelas_diniyah' => $kelas,
            'tingkat_diniyah' => $tingkat
        ]);
    }

    public function pay()
    {
        $periode = $this->baseModel->GetPeriode();
        $invoice = $this->idgenerator();
        $id = $this->input->post('idfix', true);
        $nik = $this->input->post('nikfix', true);
        $tagihan = $this->input->post('tagihanfix', true);
        $jumlah = $this->input->post('jumlahfix', true);
        $nominal = $this->input->post('nominalfix', true);
        $domisili = $this->input->post('mutasidomisili', true);
        $saudara = $this->input->post('saudara', true);
        $lainjenis = $this->input->post('lainjenis', true);
        $tipesaudara = $this->input->post('tipe_saudara', true);
        $seragam = $this->input->post('seragam', true);
        $penambahan = $this->input->post('penambahan', true);
        $ubahDomisili = $this->input->post('ubah_domisili', true);
        $totaldiskon = $this->input->post('totaldiskon', true);
        $tanggal = date('Y-m-d H:i:s');
        $hijri = $this->baseModel->GetHijriSekarang();
        $tarif = $this->gettarif($id);
        $tipe = $this->session->userdata('tipe_user');
        $tahappembayaran = $this->input->post('tahappembayaran', true);
        $bendahara = [1 => 'ABD. KHOFI', 'HALIMAH'];

        if ($tahappembayaran == 'Pembayaran Pertama') {
            $tahap = 1;
        } elseif ($tahappembayaran == 'Pembayaran Kedua') {
            $tahap = 2;
        } else {
            $tahap = 0;
        }

        $sisa = $tagihan - $nominal;
        if ($sisa <= 0) {
            $status = 'LUNAS';
        } else {
            $status = 'BELUM LUNAS';
        }

        //PENAMBAHAN
        if ($penambahan > 0) {
            $getpenambahan = $this->setkodepenambahan($id);
            $tarifbeforefix = $tarif + $getpenambahan;
        } else {
            $tarifbeforefix = $tarif;
        }

        if ($ubahDomisili > 0) {
            $getpenambahanubah = $this->setkodepenambahanubahdomisili($id);
            $tariffix = $tarifbeforefix + $getpenambahanubah;
        } else {
            $tariffix = $tarifbeforefix;
        }


        //GET DISKON PADA PEMBAYARAN SEBELUMNYA
        $qlastdiskon = $this->db->order_by('created_at', 'DESC')->get_where('payment', [
            'santri' => $id,
            'periode' => $periode
        ])->row_object();
        if ($qlastdiskon) {
            $diskonID = $qlastdiskon->diskon_id;
            $diskon = $qlastdiskon->diskon;
            $diskondetail = 2;
        } else {
            if ($totaldiskon != 0) {
                $diskonID = $this->iddiskongenerator();
                $diskon = $totaldiskon;
                $diskondetail = 1;
                $this->setdetaildiskon($domisili, $saudara, $lainjenis, $tipesaudara, $seragam, $diskonID);
            } else {
                $diskonID = 0;
                $diskon = 0;
                $diskondetail = 0;
            }
        }

        $data = [
            'id' => $invoice,
            'created_at' => $tanggal,
            'hijriah' => $hijri,
            'santri' => $id,
            'tarif' => $tariffix,
            'diskon_id' => $diskonID,
            'diskon' => $diskon,
            'tagihan' => $jumlah,
            'nominal' => $nominal,
            'sisa' => $sisa,
            'tipe' => $tipe,
            'periode' => $periode,
            'nik' => $nik,
            'status' => $status,
            'tahap' => $tahap,
            'user' => $bendahara[$tipe]
        ];
        $this->db->insert('payment', $data);
        if ($this->db->affected_rows() > 0) {
            //SET DETAIL
            $this->setDetail($id, $nominal, $jumlah, $invoice, $domisili, $saudara, $lainjenis, $tipesaudara, $seragam, $diskondetail, $diskonID);
        }

        if ($this->db->affected_rows() > 0) {
            return $invoice;
        } else {
            return 0;
        }
    }

    public function idgenerator()
    {
        $tanggal = date('Y-m-d');
        $pecah = explode('-', $tanggal);
        $acak = mt_rand(1000, 9999);
        $id = $pecah[0] . $pecah[1] . $pecah[2] . $acak;
        return $id;
    }

    public function iddiskongenerator()
    {
        $tanggal = date('Y-m-d');
        $pecah = explode('-', $tanggal);
        $acak = mt_rand(1000, 9999);
        $id = $pecah[0] . $pecah[1] . $pecah[2] . $acak;
        return $id;
    }

    public function getdiskon()
    {
        $periode = $this->baseModel->GetPeriode();
        $domisili = $this->input->post('domisili', true);
        if ($domisili == 'P2K') {
            $fixdom = 'LP2K';
        } else {
            $fixdom = 'P2K';
        }
        $tipe = $this->input->post('tipe', true);

        //SAUDARA SEJENIS
        $qsejenis = "SELECT SUM(nominal) AS total FROM list_diskon WHERE tipe != '$fixdom' AND periode = '$periode' AND opsi > 1 AND opsi < 4";
        $dsejenis = $this->db->query($qsejenis)->row_object();

        //SAUDARA LAIN JENIS
        $qlain = "SELECT SUM(nominal) AS total FROM list_diskon WHERE tipe != '$fixdom' AND periode = '$periode' AND opsi = 3";
        $dlain = $this->db->query($qlain)->row_object();

        //MUTASI DOMISILI ATAU MUTASI JENJANG
        $qdomisili = $this->db->get_where('list_diskon', [
            'periode' => $periode, 'opsi' => 1
        ])->row_object();


        //SERAGAM
        $qseragam = $this->db->get_where('list_diskon', [
            'periode' => $periode, 'opsi' => 4
        ])->row_object();

        if ($tipe == 2) {
            $jadi = $dsejenis->total;
        } elseif ($tipe == 1) {
            $jadi = $dlain->total;
        } elseif ($tipe == 3) {
            $jadi = $qdomisili->nominal;
        } elseif ($tipe == 4) {
            $jadi = $qseragam->nominal;
        } else {
            $jadi = $qdomisili->nominal;
        }

        return $jadi;
    }

    public function setkodepenambahan($id)
    {
        $periode = $this->baseModel->GetPeriode();
        $cek = $this->cekidsantri($id);
        $tingkat = $cek->tingkat_diniyah;
        $q = $this->db->get_where('tarif_pendaftaran', [
            'tipe' => 'LP2K', 'periode' => $periode
        ])->row_object();
        if ($q) {
            $this->db->insert('pay_temp', [
                'kode' => $q->kode,
                'nominal' => $q->nominal,
                'instansi' => $tingkat,
                'user' => $this->session->userdata('id_user')
            ]);
            $hasil = $q->nominal;
        } else {
            $hasil = 0;
        }

        return $hasil;
    }

    public function setkodepenambahanubahdomisili($id)
    {
        $periode = $this->baseModel->GetPeriode();
        $cek = $this->cekidsantri($id);
        $tingkat = $cek->tingkat_diniyah;
        $q = $this->db->get_where('tarif_pendaftaran', [
            'tipe' => 'P2K', 'periode' => $periode
        ])->row_object();
        if ($q) {
            $this->db->insert('pay_temp', [
                'kode' => $q->kode,
                'nominal' => $q->nominal,
                'instansi' => $tingkat,
                'user' => $this->session->userdata('id_user')
            ]);
            $hasil = $q->nominal;
        } else {
            $hasil = 0;
        }

        return $hasil;
    }

    public function setDetail($id, $nominal, $tagihan, $invoice, $domisilid, $saudara, $lainjenis, $tipesaudara, $seragam, $diskon, $diskonID)
    {
        $idUser = $this->session->userdata('id_user');
        $hijri = $this->baseModel->GetHijriSekarang();
        $cek = $this->cekidsantri($id);
        $kelas = $cek->kelas_diniyah;
        $tingkat = $cek->tingkat_diniyah;
        $tipe = $cek->tipe_santri;
        $periodeSantri = $cek->periode_masuk;
        $periode = $this->baseModel->GetPeriode();
        $domisili = $cek->status_domisili_santri;
        if ($domisili == 'P2K') {
            $penguranganRA = 0;
            $kondisi = 'LP2K';
        } else {
            if ($tingkat == 'RA') {
                $penguranganRA = 50000;
            } else {
                $penguranganRA = 50000;
            }
            $kondisi = 'P2K';
        }
        //GET TARIF INFAQ
        $dTarif = $this->db->get_where('tarif_infaq', [
            'periode' => $periode, 'tipe !=' => $kondisi
        ])->result_object();
        $dataInfaq = [];
        foreach ($dTarif as $dinfaq) {
            $kode = $dinfaq->kode;

            if ($kode == 'P02') {
                $nominalAkhir = $dinfaq->nominal - $penguranganRA;
            } else {
                $nominalAkhir = $dinfaq->nominal;
            }

            if ($kode == 'P02') {
                $instansi = 'Kabid IV';
            } elseif ($kode == 'P03' || $kode == 'P19') {
                $instansi = 'Kabid V';
            } elseif ($kode == 'P08') {
                $instansi = $tingkat;
            } else {
                $instansi = 'Umum';
            }
            $dataInfaq[] = [
                'kode' => $kode,
                'nominal' => $nominalAkhir,
                'instansi' => $instansi,
                'user' => $idUser
            ];
        }
        $this->db->insert_batch('pay_temp', $dataInfaq);

        //GET PENDAFTARAN
        if ($periodeSantri == $periode) {
            $this->db->select('*')->from('tarif_pendaftaran');
            if ($domisili == 'LP2K') {
                $this->db->where('tipe', 'LP2K');
            }
            $this->db->where('periode', $periode);
            $qpendaftaran = $this->db->get()->result_object();
        } else {
            if ($kelas == 1) {
                $this->db->select('*')->from('tarif_pendaftaran');
                $this->db->where('tipe', 'LP2K');
                $this->db->where('periode', $periode);
                $qpendaftaran = $this->db->get()->result_object();
            } else {
                $qpendaftaran = '';
            }
        }
        if ($qpendaftaran != '') {
            foreach ($qpendaftaran as $dpendaftaran) {
                $tipePendaftaran = $dpendaftaran->tipe;
                if ($tipePendaftaran == 'P2K') {
                    $instansi = 'Umum';
                } else {
                    $instansi = $tingkat;
                }

                $dataPendaftaran = [
                    'kode' => $dpendaftaran->kode,
                    'nominal' => $dpendaftaran->nominal,
                    'instansi' => $instansi,
                    'user' => $idUser
                ];
                $this->db->insert('pay_temp', $dataPendaftaran);
            }
        }

        //GET TARIF PESANTREN
        if ($domisili == 'P2K') {
            $qPesantren = $this->db->get_where('tarif_pesantren', [
                'periode' => $periode
            ])->result_object();
            $dataPesantren = [];
            foreach ($qPesantren as $dPesantren) {
                $kodeP = $dPesantren->kode;
                if ($kodeP == 'P04') {
                    $instansi = 'Kabid IV';
                } elseif ($kodeP == 'P05') {
                    $instansi = 'Kabid I';
                } else {
                    $instansi = 'Umum';
                }
                $dataPesantren[] = [
                    'kode' => $dPesantren->kode,
                    'nominal' => $dPesantren->nominal,
                    'instansi' => $instansi,
                    'user' => $idUser
                ];
            }
            $this->db->insert_batch('pay_temp', $dataPesantren);
        }

        //GET TARIF MADRASAH
        if ($kelas == 'Praktik' || $kelas == 'Takhossus') {
            $kelasfinal = 'Jilid';
        } else {
            $kelasfinal = $kelas;
        }
        $qMadrasah = $this->db->get_where('tarif_madrasah', [
            'tipe' => $tipe,
            'kelas' => $kelasfinal,
            'tingkat' => $tingkat,
            'periode' => $periode
        ])->result_object();
        $dataMadrasah = [];
        foreach ($qMadrasah as $dMadrasah) {
            $dataMadrasah[] = [
                'kode' => $dMadrasah->kode,
                'nominal' => $dMadrasah->nominal,
                'instansi' => $tingkat,
                'user' => $idUser
            ];
        }
        $this->db->insert_batch('pay_temp', $dataMadrasah);

        //BUANG DISKON
        if ($diskon > 0) {
            if ($diskon == 1) {
                if ($domisilid > 0) {
                    //MUTASI DOMISILI ATAU MUTASI JENJANG
                    $qdomisili = $this->db->get_where('list_diskon', [
                        'periode' => $periode, 'opsi' => 1
                    ])->row_object();
                    $this->db->where(['kode' => $qdomisili->kode, 'user' => $idUser])->delete('pay_temp');
                }

                //FUNGSI UNTUK CEK STATUS DOMISILI (KEBALIKAN)
                if ($tipesaudara == 'P2K') {
                    $fixsaudara = 'LP2K';
                } else {
                    $fixsaudara = 'P2K';
                }

                //SAUDARA SEJENIS
                if ($saudara > 0) {
                    $qsejenis = "SELECT * FROM list_diskon WHERE tipe != '$fixsaudara' AND periode = '$periode' AND opsi > 1 AND opsi < 4";
                    $dsejenis = $this->db->query($qsejenis)->result_object();
                    foreach ($dsejenis as $osejenis) {
                        $this->db->where(['kode' => $osejenis->kode, 'user' => $idUser])->delete('pay_temp');
                    }
                }

                //SAUDARA LAIN JENIS
                if ($lainjenis > 0) {
                    $qlain = "SELECT * FROM list_diskon WHERE tipe != '$fixsaudara' AND periode = '$periode' AND opsi = 3";
                    $dlain = $this->db->query($qlain)->result_object();
                    foreach ($dlain as $olain) {
                        $this->db->where(['kode' => $olain->kode, 'user' => $idUser])->delete('pay_temp');
                    }
                }

                //DISKON SERAGAM
                if ($seragam > 0) {
                    $qseragam = $this->db->get_where('list_diskon', [
                        'periode' => $periode, 'opsi' => 4
                    ])->row_object();
                    $this->db->where(['kode' => $qseragam->kode, 'user' => $idUser])->delete('pay_temp');
                }
            } elseif ($diskon == 2) {
                $qddd = $this->db->get_where('payment_diskon', ['payment_diskon' => $diskonID])->result_object();
                foreach ($qddd as $dk) {
                    $this->db->where(['kode' => $dk->kode, 'user' => $idUser])->delete('pay_temp');
                }
            }
        }

        //GET PAY TEMP
        $qPay = $this->db->get_where('pay_temp', ['user' => $idUser])->result_object();
        $dataPay = [];
        foreach ($qPay as $dPay) {
            $nominalKode = $dPay->nominal;
            //Ambil persen
            $topersen = ($nominalKode / $tagihan) * 100;
            //Ambil nominal dari persen
            $frompersen = ($nominal * $topersen) / 100;
            // $persen = $dd->persen_1;
            // $nominalj = ($bayar * $persen) / 100;
            $detailjadi = number_format($frompersen, 0, '', '');
            $dataPay[] = [
                'payment_id' => $invoice,
                'kode' => $dPay->kode,
                'nominal' => $detailjadi,
                'tipe' => $cek->tipe_santri,
                'kelas' => $kelas,
                'instansi' => $dPay->instansi,
                'periode' => $periode,
                'tanggal' => $hijri
            ];
        }
        $this->db->insert_batch('payment_detail', $dataPay);
        if ($this->db->affected_rows() > 0) {
            $this->db->where('user', $idUser)->delete('pay_temp');
        }
    }

    public function setdetaildiskon($domisili, $saudara, $lainjenis, $tipesaudara, $seragam, $diskonID)
    {
        $periode = $this->baseModel->GetPeriode();
        if ($domisili > 0) {
            //MUTASI DOMISILI ATAU MUTASI JENJANG
            $qdomisili = $this->db->get_where('list_diskon', [
                'periode' => $periode, 'opsi' => 1
            ])->row_object();
            $this->db->insert('payment_diskon', [
                'payment_diskon' => $diskonID,
                'kode' => $qdomisili->kode,
                'nominal' => $qdomisili->nominal,
                'status' => 0 //FUNGSI UNTUK KLASIFIKASI PENGURANGAN
            ]);
        }

        //FUNGSI UNTUK CEK STATUS DOMISILI (KEBALIKAN)
        if ($tipesaudara == 'P2K') {
            $fixsaudara = 'LP2K';
        } else {
            $fixsaudara = 'P2K';
        }

        //SAUDARA SEJENIS
        if ($saudara > 0) {
            $qsejenis = "SELECT * FROM list_diskon WHERE tipe != '$fixsaudara' AND periode = '$periode' AND opsi > 1 AND opsi < 4";
            $dsejenis = $this->db->query($qsejenis)->result_object();
            $datasejenis = [];
            foreach ($dsejenis as $osejenis) {
                $datasejenis[] = [
                    'payment_diskon' => $diskonID,
                    'kode' => $osejenis->kode,
                    'nominal' => $osejenis->nominal,
                    'status' => 1
                ];
            }
            $this->db->insert_batch('payment_diskon', $datasejenis);
        }

        //SAUDARA LAIN JENIS
        if ($lainjenis > 0) {
            $qlain = "SELECT * FROM list_diskon WHERE tipe != '$fixsaudara' AND periode = '$periode' AND opsi = 3";
            $dlain = $this->db->query($qlain)->result_object();
            $datalain = [];
            foreach ($dlain as $olain) {
                $datalain[] = [
                    'payment_diskon' => $diskonID,
                    'kode' => $olain->kode,
                    'nominal' => $olain->nominal,
                    'status' => 2
                ];
            }
            $this->db->insert_batch('payment_diskon', $datalain);
        }

        //DISKON SERAGAM
        if ($seragam > 0) {
            $qseragam = $this->db->get_where('list_diskon', [
                'periode' => $periode, 'opsi' => 4
            ])->row_object();
            $this->db->insert('payment_diskon', [
                'payment_diskon' => $diskonID,
                'kode' => $qseragam->kode,
                'nominal' => $qseragam->nominal,
                'status' => 3
            ]);
        }
    }

    public function getdataprint($invoice)
    {
        $periode = $this->baseModel->GetPeriode();
        $tipe = $this->session->userdata('tipe_user');
        $this->db->select('*')->from('payment')->join('data_santri', 'santri = id_santri');
        $this->db->where(['periode' => $periode, 'tipe' => $tipe, 'id' => $invoice]);
        return $this->db->get()->row_object();
    }

    public function getsecond($id)
    {
        $periode = $this->baseModel->GetPeriode();
        return $this->db->get_where('payment', ['santri' => $id, 'periode' => $periode, 'tahap' => 1])->row_object();
    }

    public function getdatadiskon($id)
    {
        return $this->db->select('SUM(nominal) AS total, status')->from('payment_diskon')->where('payment_diskon', $id)->group_by('status')->order_by('status', 'ASC')->get()->result_object();
    }

    public function getpenambahan()
    {
        $periode = $this->baseModel->GetPeriode();
        $tipe = $this->input->post('tipe', true);

        //MUTASI DOMISILI ATAU MUTASI JENJANG
        $qdomisili = $this->db->get_where('list_diskon', [
            'periode' => $periode, 'opsi' => 1
        ])->row_object();

        if ($tipe == 1) {
            $qdomisili = $this->db->get_where('list_diskon', [
                'periode' => $periode, 'opsi' => 1
            ])->row_object();
            if ($qdomisili) {
                $hasil = (int)$qdomisili->nominal;
            } else {
                $hasil = 0;
            }
        } else {
            $hasil = 200000;
        }

        return ['status' => 200, 'hasil' => $hasil];
    }

    public function getpaymentdetail($id)
    {
        $this->db->select_sum('nominal')->from('payment_detail')->where('payment_id', $id);
        $data = $this->db->get()->row_object();
        return $data->nominal;
    }

    public function getdetailpayment($id)
    {
        $this->db->select('*')->from('payment_detail')->join('akun_keuangan', 'kode = id_akunkeuangan');
        $this->db->where('payment_id', $id)->order_by('kode', 'ASC');
        return $this->db->get()->result_object();
    }

    public function getdiskondetail($id)
    {
        $this->db->select('*')->from('payment_diskon')->join('akun_keuangan', 'kode = id_akunkeuangan');
        $this->db->where('payment_diskon', $id)->order_by('status', 'ASC');
        return $this->db->get()->result_object();
    }

    public function deletepayment($id)
    {
        $cek = $this->db->get_where('payment', ['id' => $id])->row_object();
        if (!$cek) {
            $hasil = ['status' => 0];
        } else {
            $diskon = $cek->diskon;
            $diskonId = $cek->diskon_id;
            if ($diskon > 0) {
                $this->db->where('payment_diskon', $diskonId)->delete('payment_diskon');
            }
            $this->db->where('payment_id', $id)->delete('payment_detail');
            $this->db->where('id', $id)->delete('payment');

            $this->db->insert('payment_trash', [
                'payment_id' => $cek->id,
                'santri_id' => $cek->santri,
                'nominal' => $cek->nominal,
                'created_at' => date('Y-m-d H:i:s'),
                'period' => $this->baseModel->GetPeriode()
            ]);

            $hasil = ['status' => $this->db->affected_rows()];
        }

        return $hasil;
    }
}
