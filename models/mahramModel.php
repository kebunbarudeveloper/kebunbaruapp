<?php
defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class mahramModel extends CI_Model
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

    public function getData()
    {
        // return $this->db->order_by('print ASC, status ASC')->get('mahram')->result_object();
        $nama = $this->input->post('nama', true);
        $status = $this->input->post('status', true);
        $print = $this->input->post('print', true);
        $this->db->select('*')->from('mahram');
        if ($nama != '') {
            $this->db->like('nama', $nama);
        }

        if ($status != 111) {
            $this->db->where('status', $status);
        }

        if ($print != 111) {
            $this->db->where('print', $print);
        }

        $this->db->order_by('print ASC, pengajuan DESC, urut ASC, status ASC');

        return $this->db->get()->result_object();
    }

    public function getTotal()
    {
        return $this->db->get('mahram')->num_rows();
    }

    public function cekIDSantri($id)
    {
        return $this->db->get_where('data_santri', [
            'id_santri' => $id
        ])->row_object();
    }

    public function cekNIK($nik, $opsi)
    {
        $data = $this->db->get_where('mahram', ['nik' => $nik, 'status <=' => 1])->row_object();
        if ($data) {
            $opsidb = $data->firoq;
            if ($opsidb == 3) {
                return [1, 'Gagal.! Kartu mahram dengan opsi non-firoq sudah diterbitkan sebelumnya'];
            } elseif ($opsidb != 3 && $opsi == 3) {
                return [1, 'Gagal.! Kartu mahram dengan opsi firoq sudah diterbitkan sebelumnya'];
            } else {
                if ($opsi == $opsidb) {
                    $kata = ['', 'pihak suami', 'pihak istri', ''];
                    return [1, 'Gagal.! Kartu Mahram opsi firoq dari ' . $kata[$opsi] . ' sudah ada sebelumnya'];
                } else {
                    return [0, ''];
                }
            }
        } else {
            return [0, ''];
        }
    }

    public function getWali($nik)
    {
        return $this->db->get_where('data_walisantri', ['nik_walisantri' => $nik])->row_object();
    }

    public function getSantri($nik)
    {
        return $this->db->get_where('data_santri', [
            'wali_santri' => $nik,
            'status_santri' => 1,
            'tipe_santri' => 2
        ])->result_object();
    }

    public function updatenomor($nomor, $nik)
    {
        $this->db->where('nik_walisantri', $nik)->update('data_walisantri', ['nomor_hp_walisantri' => $nomor]);
        return $this->db->affected_rows();
    }

    public function add($nik, $foto, $opsi)
    {
        $tipewali = $this->input->post('tipewali', true);
        $idwalistatis = $this->input->post('idwalistatis', true);
        if ($tipewali > 0) {
            $datax = $this->db->get_where('mahram_temp', ['id' => $idwalistatis])->row_object();
            $nama = $datax->nama;
            $nope = $datax->nope;
            $desa = $datax->desa;
            $kab = $datax->kab;
        } else {
            $datax = $this->db->get_where('data_walisantri', ['nik_walisantri' => $nik])->row_object();
            $nama = $datax->nama_walisantri;
            $nope = $datax->nomor_hp_walisantri;
            $desa = $datax->desa_walisantri;
            $kab = $datax->kabupaten_walisantri;
        }

        $data = [
            'id' => '1391' . mt_rand(100000, 999999),
            'nik' => $nik,
            'foto' => $foto,
            'tipe' => $tipewali, //1 => wakil wali || 0 => wali
            'firoq' => $opsi, //Bukan firoq => 1 Pihak suami || 2 pihak istri
            'nama' => $nama,
            'desa' => $desa,
            'kab' => $kab,
            'nope' => $nope,
            'tanggal' => $this->baseModel->GetHijriSekarang(),
            'status' => 0, //0 => belum aktif, 1 => aktif, 2 => hilang, 3 => rusak/salah data
            'print' => 0 //0 => belum diprint, 1 => sudah diprint
        ];
        $this->db->insert('mahram', $data);
        if ($tipewali > 0 && $this->db->affected_rows() > 0) {
            $this->db->where('id', $idwalistatis)->delete('mahram_temp');
        }

        return $this->db->affected_rows();
    }

    public function updateprint($id)
    {
        $this->db->where('id', $id)->update('mahram', ['print' => 1, 'status' => 1]);
        $hasil = $this->db->affected_rows();
        if ($hasil > 0) {
            return ['hasil' => 200];
        } else {
            return ['hasil' => 500];
        }
    }


    public function getdatakartu($id)
    {
        //$this->db->select('*')->from('mahram')->join('data_walisantri', 'wali_id = id_walisantri')->where('id', $id);
        $data = $this->db->get_where('mahram', ['id' => $id])->row_object();
        //$total = $this->db->get()->num_rows();
        return $data;
    }


    public function getTotalSantri($nik)
    {
        return $this->db->get_where('data_santri', ['tipe_santri' => 2, 'wali_santri' => $nik, 'status_santri' => 1])->num_rows();
    }

    public function walistatis()
    {
        $id = mt_rand(100, 999);
        $nama = strtoupper($this->input->post('nama', true));
        $nope     = str_replace(['-', '_'], '', $this->input->post('nope', true));
        $desa  = ucwords($this->input->post('desa', true));
        $kab  = ucwords($this->input->post('kab', true));

        $data = [
            'id' => $id,
            'nama' => $nama,
            'desa' => $desa,
            'kab' => $kab,
            'nope' => $nope
        ];
        $this->db->insert('mahram_temp', $data);

        return ['hasil' => $id];
    }

    public function getdatamahram($id)
    {
        $cek = $this->db->get_where('mahram', ['id' => $id])->num_rows();
        if ($cek > 0) {
            $data = $this->db->get_where('mahram', ['id' => $id])->row_object();
            $hasil = ['message' => 200, 'data' => $data];
        } else {
            $hasil = ['message' => 0, 'data' => 'Kosong'];
        }

        return $hasil;
    }

    public function simpanedit()
    {
        $id = $this->input->post('idmahram', true);
        $nama = $this->input->post('namamahram', true);
        $nope = str_replace(['-', '_'], '', $this->input->post('nopemahram', true));
        $desa = $this->input->post('desamahram', true);
        $kab = $this->input->post('kabupatenmahram', true);

        $cekid = $this->db->get_where('mahram', ['id' => $id])->num_rows();
        if ($cekid > 0) {
            $data = [
                'nama' => strtoupper($nama),
                'desa' => ucwords($desa),
                'kab' => ucwords($kab),
                'nope' => $nope
            ];
            $this->db->where('id', $id)->update('mahram', $data);
            $cekrow = $this->db->affected_rows();
            if ($cekrow > 0) {
                $hasil = ['message' => 200];
            } else {
                $hasil = ['message' => 500];
            }
        } else {
            $hasil = ['message' => 500];
        }

        return $hasil;
    }

    public function simpanpengajuan()
    {
        $id = $this->input->post('idpengajuan', true);
        $alasan = $this->input->post('alasanpengajuan', true);

        $cekid = $this->db->get_where('mahram', ['id' => $id])->num_rows();
        if ($cekid > 0) {
            $this->db->where('id', $id)->update('mahram', ['pengajuan' => $alasan]);
            $cekrow = $this->db->affected_rows();
            if ($cekrow > 0) {
                $hasil = ['message' => 200];
            } else {
                $hasil = ['message' => 500];
            }
        } else {
            $hasil = ['message' => 500];
        }

        return $hasil;
    }

    public function terimaaduan()
    {
        $id = $this->input->post('id', true);
        $aduan = $this->input->post('aduan', true);
        $sekarang = $this->baseModel->GetHijriSekarang();

        //Cek ID
        $cekid = $this->db->get_where('mahram', ['id' => $id])->num_rows();
        if ($cekid > 0) {
            //Ubah status pengajuan
            $this->db->where('id', $id)->update('mahram', ['pengajuan' => 0, 'status' => $aduan]);

            //Cek tipe aduan
            if ($aduan == 2) {
                //Hilang
                $this->db->where('id', $id)->update('mahram', ['blokir_at' => $sekarang]);
                //Tambah baru
                $getdataid = $this->db->get_where('mahram', ['id' => $id])->row_object();
                $newID = '1391' . mt_rand(100000, 999999);
                $data = [
                    'id' => $newID,
                    'nik' => $getdataid->nik,
                    'foto' => $getdataid->foto,
                    'tipe' => $getdataid->tipe, //1 => wakil wali || 0 => wali
                    'firoq' => $getdataid->firoq, //Bukan firoq => 1 Pihak suami || 2 pihak istri
                    'nama' => $getdataid->nama,
                    'desa' => $getdataid->desa,
                    'kab' => $getdataid->kab,
                    'nope' => $getdataid->nope,
                    'tanggal' => $sekarang,
                    'status' => 0, //0 => belum aktif, 1 => aktif, 2 => hilang, 3 => rusak/salah data
                    'print' => 0 //0 => belum diprint, 1 => sudah diprint
                ];
                $this->db->insert('mahram', $data);
            } else {
                //Rusak/Salah data
                $this->db->where('id', $id)->update('mahram', ['print' => 0, 'status' => 0]);
                $newID = $id;
            }

            $cekrow = $this->db->affected_rows();
            if ($cekrow > 0) {
                $hasil = ['message' => 200, 'id' => encrypt_url($newID)];
            } else {
                $hasil = ['message' => 500];
            }
        } else {
            $hasil = ['message' => 500];
        }
        return $hasil;
    }
}
