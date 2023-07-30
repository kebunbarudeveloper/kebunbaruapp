<?php
defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class pengurusModel extends CI_Model
{
    public function getDataPengurus()
    {
        $this->db->select('*, TIMESTAMPDIFF(YEAR, tanggal_pengurus, CURDATE()) AS umur')
            ->from('data_pengurus')->order_by('urut_pengurus', 'ASC');
        $data = $this->db->get()->result_object();


        $this->db->select('COUNT(induk_pengurus) AS total');
        $this->db->from('data_pengurus');
        $total = $this->db->get()->row_object();

        return [$data, $total];
    }


    public function getIDSantri($nik)
    {
        return $this->db->get_where('data_santri', ['nik_santri' => $nik])->row_object();
    }


    public function getUrut()
    {
        $ambil = $this->db->order_by('urut_pengurus', 'DESC')->get('data_pengurus')->row_object();
        if ($ambil) {
            $urut = $ambil->urut_pengurus;
            $hasil = $urut + 1;
        } else {
            $hasil = 1;
        }

        return $hasil;
    }


    public function CekPengurus($id)
    {
        return $this->db->get_where('data_pengurus', ['nik_pengurus' => $id])->num_rows();
    }


    public function tambahPengurus()
    {
        $tahun    = $this->baseModel->GetTahunHijri();
        $urut = $this->getUrut();
        $induk = $tahun . sprintf('%04d', $urut);

        $tglmasuk = $this->baseModel->GetHijriSekarang();
        $tipe = $this->input->post('tipe', true);
        $id = $this->input->post('idPengurus', true);
        $nik = $this->input->post('nikpengurus', true);
        $kelamin = $this->input->post('kelaminpengurus', true);
        $tempat = $this->input->post('tempatpengurus', true);
        $pro = $this->input->post('propengurus', true);
        $kec = $this->input->post('kecpengurus', true);
        $dusun = $this->input->post('dusunpengurus', true);
        $nama = $this->input->post('namapengurus', true);
        $kab = $this->input->post('kabpengurus', true);
        $desa = $this->input->post('desapengurus', true);
        $rt = $this->input->post('rtpengurus', true);
        $rw = $this->input->post('rwpengurus', true);
        $pos = $this->input->post('pospengurus', true);
        $id = $this->input->post('idPengurus', true);

        $tgl = $this->input->post('tgl', true);
        $bln = $this->input->post('bln', true);
        $thn = $this->input->post('thn', true);
        $ttl = $thn . '-' . $bln . '-' . $tgl;
        $hp  = str_replace('-', '', $this->input->post('hppengurus', true));

        $cekPengurus = $this->CekPengurus($nik);
        if ($tipe == 'tambah') {
            if ($cekPengurus > 0) {
                return 0;
            } else {
                $data = [
                    'id_pengurus' => '',
                    'urut_pengurus' => $urut,
                    'masuk_pengurus' => $tglmasuk,
                    'induk_pengurus' => $induk,
                    'nik_pengurus' => $nik,
                    'nama_pengurus' => strtoupper($nama),
                    'kelamin_pengurus' => $kelamin,
                    'tempat_pengurus' => ucwords($tempat),
                    'tanggal_pengurus' => $ttl,
                    'dusun_pengurus' => ucwords($dusun),
                    'rt_pengurus' => $rt,
                    'rw_pengurus' => $rw,
                    'desa_pengurus' => $desa,
                    'kec_pengurus' => $kec,
                    'kab_pengurus' => $kab,
                    'pro_pengurus' => $pro,
                    'pos_pengurus' => $pos,
                    'status_pengurus' => 1,
                    'hp_pengurus' => $hp
                ];

                $this->db->insert('data_pengurus', $data);
                return 1;
            }
        } else {
            $data = [
                'nik_pengurus' => $nik,
                'nama_pengurus' => strtoupper($nama),
                'kelamin_pengurus' => $kelamin,
                'tempat_pengurus' => ucwords($tempat),
                'tanggal_pengurus' => $ttl,
                'dusun_pengurus' => ucwords($dusun),
                'rt_pengurus' => $rt,
                'rw_pengurus' => $rw,
                'desa_pengurus' => $desa,
                'kec_pengurus' => $kec,
                'kab_pengurus' => $kab,
                'pro_pengurus' => $pro,
                'pos_pengurus' => $pos,
                'hp_pengurus' => $hp
            ];
            $this->db->where('induk_pengurus', $id)->update('data_pengurus', $data);
            return $id;
        }
    }


    public function getDetail($induk)
    {
        return $this->db->get_where('data_pengurus', ['induk_pengurus' => $induk])->row_object();
    }
}