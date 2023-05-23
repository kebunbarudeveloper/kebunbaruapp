<?php
defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class suratijinModel extends CI_Model
{
    public function data()
    {
        $user = $this->session->userdata('tipe_user');
        $periode = $this->baseModel->GetPeriode();
        $jadwal = $this->km->getjadwal();
        $liburan = $this->km->getliburan();

        //Jumlah Santri
        $santri = $this->db->select('count(id_santri) AS totalSantri')->from('data_santri')->where([
            'status_santri' => 1,
            'tipe_santri' => $user,
            'tingkat_diniyah !=' => 'Kuliah Syari\'ah'
        ])->get()->row_object();
        if ($santri) {
            $jSantri = $santri->totalSantri;
        } else {
            $jSantri = 0;
        }


        //Jumlah Santri sesuai jadwal
        $pengambil = $this->db->select('count(id_santri) AS totalpengambil')->from('data_santri')->where([
            'status_santri' => 1,
            'tipe_santri' => $user,
            'domisili_santri' => $jadwal,
            'tingkat_diniyah !=' => 'Kuliah Syari\'ah'
        ])->get()->row_object();
        if ($pengambil) {
            $jpengambil = $pengambil->totalpengambil;
        } else {
            $jpengambil = 0;
        }


        $data = $this->db->get_where('surat_ijin', [
            'jenis_liburan' => $liburan,
            'periode_surat' => $periode,
            'tipe_surat' => $user
        ])->result_object();

        if ($data) {
            foreach ($data as $d) {
                $id[] = $d->santri_id;
            }
            $idx = implode(',', $id);
            $ids = explode(',', $idx);
            $this->db->select('count(id_santri) AS totalSurat')->from('data_santri')->where([
                'status_santri' => 1,
                'tipe_santri' => $user,
                'domisili_santri' => $jadwal,
                'tingkat_diniyah !=' => 'Kuliah Syari\'ah'
            ]);
            $this->db->where_in('id_santri', $ids);
            $surat = $this->db->get()->row_object();
        }
        if (@$surat) {
            $jSurat = $surat->totalSurat;
        } else {
            $jSurat = 0;
        }

        $akhir = $jpengambil - $jSurat;
        return [$jSantri, $jSurat, $akhir, $jpengambil];
    }
    public function save()
    {
        $id = $this->input->post('id', true);
        $periode = $this->baseModel->GetPeriode();
        $user = $this->session->userdata('tipe_user');
        $jadwal = $this->km->getjadwal();
        $liburan = $this->km->getliburan();
        $cekSantri = $this->cekIDSantri($id, $jadwal);
        $cekSurat = $this->cekSurat($id, $periode);


        if ($jadwal == 'Belum Diatur') {
            //Jadwal belum diatur
            $hasil = 5;
        } elseif ($liburan == 0) {
            //liburan belum diatur
            $hasil = 6;
        } elseif ($cekSantri == 0) {
            //ID tidak ada
            $hasil = 1;
        } elseif ($cekSantri == 1) {
            //Santri tidak aktif
            $hasil = 2;
        } elseif ($cekSantri == 2) {
            //Tidak ada akses
            $hasil = 3;
        } elseif ($cekSantri == 4) {
            //Bukan daerah jadwal
            $hasil = 7;
        } elseif ($cekSurat > 0) {
            //Sudah ambil surat
            $hasil = 4;
        } else {
            //sukses
            $data = [
                'santri_id' => $id,
                'periode_surat' => $periode,
                'jenis_liburan' => $liburan,
                'tanggal_surat' => date("Y-m-d H:i:s"),
                'tipe_surat' => $user
            ];
            $this->db->insert('surat_ijin', $data);
            $hasil = 0;
        }

        return $hasil;
    }

    public function cekIDSantri($id, $jadwal)
    {
        $data = $this->db->get_where('data_santri', [
            'id_santri' => $id
        ])->row_object();

        if ($data) {
            $status = $data->status_santri;
            $tipe = $data->tipe_santri;
            $daerah = $data->domisili_santri;
            $user = $this->session->userdata('tipe_user');

            if ($status != 1) {
                return 1;
            } elseif ($tipe != $user) {
                return 2;
            } elseif ($daerah != $jadwal) {
                return 4;
            } else {
                return 3;
            }
        } else {
            return 0;
        }
    }

    public function cekSurat($id, $periode)
    {
        return $this->db->get_where('surat_ijin', [
            'santri_id' => $id,
            'periode_surat' => $periode,
            'jenis_liburan' => 1
        ])->num_rows();
    }

    public function getID()
    {
        $id = $this->input->post('id', true);

        $this->db->select('*')->from('surat_ijin')->join('data_santri', 'id_santri = santri_id');
        $this->db->where('santri_id', $id)->order_by('id_surat', 'DESC');
        return $this->db->get()->row_object();
    }


    public function datajadwal()
    {
        $kamar = $this->input->post('kamar', true);
        $liburan = $this->input->post('liburan', true);
        $jadwal = $this->input->post('jadwal', true);
        $user = $this->session->userdata('tipe_user');

        $this->db->select('id_santri, induk_santri, nama_santri, kabupaten_santri, desa_santri, nomor_kamar_santri');
        $this->db->from('data_santri');
        $this->db->where(['tipe_santri' => $user, 'tingkat_diniyah !=' => 'Kuliah Syari\'ah']);
        $this->db->where('domisili_santri', $jadwal);
        if ($kamar != '') {
            $this->db->where('nomor_kamar_santri', $kamar);
        }
        $this->db->order_by('id_santri', 'ASC');
        return [$this->db->get()->result_object(), $liburan];
    }


    public function getstatus($id, $liburan)
    {
        $periode = $this->baseModel->GetPeriode();
        $data = $this->db->get_where('surat_ijin', [
            'santri_id' => $id,
            'jenis_liburan' => $liburan,
            'periode_surat' => $periode
        ])->num_rows();
        if ($data > 0) {
            return 1;
        } else {
            return 0;
        }
    }


    public function datajadwalstatus()
    {
        $kamar = $this->input->post('kamar', true);
        $liburan = $this->input->post('liburan', true);
        $jadwal = $this->input->post('jadwal', true);
        $status = $this->input->post('status', true);
        $user = $this->session->userdata('tipe_user');
        $periode = $this->baseModel->GetPeriode();

        $data = $this->db->get_where('surat_ijin', [
            'jenis_liburan' => $liburan,
            'periode_surat' => $periode,
            'tipe_surat' => $user
        ])->result_object();
        foreach ($data as $d) {
            $id[] = $d->santri_id;
        }
        $idx = implode(',', $id);
        $ids = explode(',', $idx);

        $this->db->select('id_santri, induk_santri, nama_santri, kabupaten_santri, desa_santri, nomor_kamar_santri');
        $this->db->from('data_santri');
        $this->db->where(['tipe_santri' => $user, 'tingkat_diniyah !=' => 'Kuliah Syari\'ah', 'status_santri' => 1]);
        if ($jadwal != 'Belum Diatur') {
            $this->db->where('domisili_santri', $jadwal);
        }
        if ($kamar != '') {
            $this->db->where('nomor_kamar_santri', $kamar);
        }
        if ($status == 1) {
            $this->db->where_in('id_santri', $ids);
        } elseif ($status == 2) {
            $this->db->where_not_in('id_santri', $ids);
        }

        return $this->db->order_by('id_santri', 'ASC')->get()->result_object();
    }

    public function batal()
    {
        $id = $this->input->post('id', true);
        $this->db->where('id_surat', $id)->delete('surat_ijin');
    }
}
