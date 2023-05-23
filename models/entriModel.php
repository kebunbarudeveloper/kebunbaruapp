<?php
defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class entriModel extends CI_Model
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

    public function getdata()
    {
        $platform = $this->input->post('platform', true);
        $tipe = $this->session->userdata('tipe_user');
        $this->db->select('*')->from('verifikasi')->where([
            'input' => 1,
            'tipe' => $tipe
        ]);
        if ($platform) {
            $this->db->where('platform', $platform);
        }
        $data = $this->db->order_by('status', 'ASC')->get()->result_object();

        $this->db->select('*')->from('verifikasi')->where([
            'input' => 1,
            'tipe' => $tipe
        ]);
        if ($platform) {
            $this->db->where('platform', $platform);
        }
        $total = $this->db->order_by('status', 'ASC')->get()->num_rows();

        return [$data, $total];
    }

    public function ceknoreg($noreg)
    {
        $tipe = $this->session->userdata('tipe_user');
        $cek = $this->db->get_where('verifikasi', [
            'id' => $noreg,
            'tipe' => $tipe,
            'status' => 0
        ])->num_rows();
        if ($cek > 0) {
            return ['status' => 200];
        } else {
            return ['status' => 400];
        }
    }
    public function loadnoreg($noreg)
    {
        $tipe = $this->session->userdata('tipe_user');
        return $this->db->get_where('verifikasi', [
            'id' => $noreg,
            'tipe' => $tipe,
            'status' => 0
        ])->row_object();
    }

    public function simpansantri()
    {
        $id = $this->input->post('noreg', true);
        $kk = $this->input->post('kk', true);
        $pendidikan = $this->input->post('pendidikan', true);
        $tempat = $this->input->post('tempat', true);
        $tanggal = $this->input->post('tanggal', true);
        $bulan = $this->input->post('bulan', true);
        $tahun = $this->input->post('tahun', true);
        $provinsi = $this->input->post('provinsi', true);
        $kabupaten = $this->input->post('kabupaten', true);
        $kecamatan = $this->input->post('kecamatan', true);
        $desa = $this->input->post('desa', true);
        $dusun = $this->input->post('dusun', true);
        $rt = $this->input->post('rt', true);
        $rw = $this->input->post('rw', true);
        $pos = $this->input->post('pos', true);
        $ayah = $this->input->post('ayah', true);
        $ibu = $this->input->post('ibu', true);

        $data = [
            'kk' => $kk,
            'pendidikans' => $pendidikan,
            'tempat' => ucwords($tempat),
            'tanggal' => $tahun . '-' . $bulan . '-' . $tanggal,
            'dusun' => ucwords($dusun),
            'rt' => $rt,
            'rw' => $rw,
            'desa' => $desa,
            'kecamatan' => $kecamatan,
            'kabupaten' => $kabupaten,
            'provinsi' => $provinsi,
            'pos' => $pos,
            'ayah' => strtoupper($ayah),
            'ibu' => strtoupper($ibu)
        ];
        $this->db->where('id', $id)->update('verifikasi', $data);
        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    public function simpanwali()
    {
        $id = $this->input->post('noreg', true);
        $provinsi = $this->input->post('provinsiw', true);
        $kabupaten = $this->input->post('kabupatenw', true);
        $kecamatan = $this->input->post('kecamatanw', true);
        $desa = $this->input->post('desaw', true);
        $dusun = $this->input->post('dusunw', true);
        $rt = $this->input->post('rtw', true);
        $rw = $this->input->post('rww', true);
        $pos = $this->input->post('posw', true);
        $pekerjaan = $this->input->post('pekerjaan', true);

        $data = [
            'input' => 1,
            'dusunw' => ucwords($dusun),
            'rtw' => $rt,
            'rww' => $rw,
            'desaw' => $desa,
            'kecamatanw' => $kecamatan,
            'kabupatenw' => $kabupaten,
            'provinsiw' => $provinsi,
            'posw' => $pos,
            'pekerjaan' => $pekerjaan
        ];
        $this->db->where('id', $id)->update('verifikasi', $data);
        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    public function getalamat($noreg)
    {
        $tipe = $this->session->userdata('tipe_user');
        $cek = $this->db->get_where('verifikasi', [
            'id' => $noreg,
            'tipe' => $tipe,
            'status' => 0
        ])->row_array();
        if ($cek) {
            return [
                'status' => 200,
                'data' => $cek
            ];
        } else {
            return [
                'status' => 400,
                'data' => []
            ];
        }
    }

    public function cekniksantri($nik)
    {
        return $this->db->get_where('data_santri', ['nik_santri' => $nik])->num_rows();
    }
    public function ceknikwali($nik)
    {
        return $this->db->get_where('data_walisantri', ['nik_walisantri' => $nik])->num_rows();
    }

    public function CekUrutAkhir($tipe, $tahun)
    {
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

    public function GetIndukAkhir()
    {
        $tipe = $this->session->userdata('tipe_user');

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

    public function setsantri($data)
    {
        $tipe = $this->session->userdata('tipe_user');

        if ($tipe == 1) {
            $sek = 'RAHMAN FARUQ';
        } else {
            $sek = 'SITI ROHMAH';
        }

        $tahun    = $this->baseModel->GetTahunHijri();
        $uru     = $this->CekUrutAkhir($tipe, $tahun);
        $urut    = (int)$uru;
        $tglmasuk = $this->baseModel->GetHijriSekarang();
        $periode  = $this->baseModel->GetPeriode();

        $akhirReg = $this->GetUrutRegistrasi($tipe, $periode);
        $indukakhir = $this->GetIndukAkhir();

        $pecah    = explode('-', $tglmasuk);
        $noreg    = $pecah[0] . '.' . $indukakhir . '.' . $akhirReg;

        $tahunid = substr($pecah[0], 2, 2);
        $setid = $tahunid . $pecah[1] . $pecah[2];

        $idsantri = $this->setIDSantri($setid);

        $data = [
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
            'pendidikan_akhir_santri' => $data->pendidikans,
            'status_domisili_santri' => $data->domisili,
            'domisili_santri' => $data->daerah,
            'nomor_kamar_santri' => $data->kamar,
            'kelas_diniyah' => $data->kelas,
            'kelas_formal' => $data->kelasf,
            'tingkat_diniyah' => $data->tingkat,
            'tingkat_formal' => $data->tingkatf,
            'ayah_santri' => $data->ayah,
            'ibu_santri' => $data->ibu,
            'status_santri' => 1,
            'wali_santri' => $data->nikw,
            'hubungan_wali' => $data->hubungan,
            'panitia_santri' => $sek,
            'KEBUNBARU-KEY' => $this->_key
        ];

        // $this->db->insert('data_santri', $data);

        $response = $this->_client->request('POST', 'santribaru', [
            'form_params' => $data
        ]);

        $hasil = json_decode($response->getBody()->getContents(), false);
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


    public function setwali($data)
    {
        $result = [
            'id_walisantri' => $this->setIDWali(),
            'nik_walisantri' => $data->nikw,
            'nama_walisantri' => $data->namaw,
            'nomor_hp_walisantri' => $data->hp,
            'nomor_wa_walisantri' => $data->wa,
            'dusun_walisantri' => $data->dusunw,
            'rt_walisantri' => $data->rtw,
            'rw_walisantri' => $data->rww,
            'desa_walisantri' => $data->desaw,
            'kecamatan_walisantri' => $data->kecamatanw,
            'kabupaten_walisantri' => $data->kabupatenw,
            'provinsi_walisantri' => $data->provinsiw,
            'kode_pos_walisantri' => $data->posw,
            'pendidikan_akhir_walisantri' => $data->pendidikan,
            'pekerjaan_walisantri' => $data->pekerjaan,
            'KEBUNBARU-KEY' => $this->_key
        ];

        $response = $this->_client->request('POST', 'santribaru/tambahwali', [
            'form_params' => $result
        ]);
        $hasil = json_decode($response->getBody()->getContents(), false);
    }

    public function getentri($id)
    {
        try {
            $response = $this->_client->request('GET', 'santribaru/GetEntriTerbaru', [
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

    public function updatestatus($id, $idSantri)
    {
        $this->db->where('id', $id)->update('verifikasi', ['status' => 1, 'id_santri' => $idSantri]);
        return $this->db->affected_rows();
    }
}
