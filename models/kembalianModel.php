<?php
defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class kembalianModel extends CI_Model
{
    public function getdata()
    {
        $periode = $this->baseModel->GetPeriode();
        $liburan = $this->km->getliburan();
        $zone    = $this->km->getZone();
        $tipe    = $this->session->userdata('tipe_user');

        //Seluruh santri
        $data = $this->db->select('COUNT(santri_id) AS total')->from('kembalian')->where([
            'periode' => $periode,
            'liburan' => $liburan,
            'tipe' => $tipe,
            'status <=' => 1,
        ])->get()->row_object();

        $data1 = $this->db->select('COUNT(santri_id) AS total')->from('kembalian')->where([
            'periode' => $periode,
            'liburan' => $liburan,
            'tipe' => $tipe,
            'status >=' => 2,
        ])->get()->row_object();

        //Sesuai zona
        $data2 = $this->db->select('COUNT(santri_id) AS total')->from('kembalian')->where([
            'periode' => $periode,
            'liburan' => $liburan,
            'tipe' => $tipe,
            'status <=' => 1,
            'zone' => $zone
        ])->get()->row_object();

        $data3 = $this->db->select('COUNT(santri_id) AS total')->from('kembalian')->where([
            'periode' => $periode,
            'liburan' => $liburan,
            'tipe' => $tipe,
            'status >=' => 2,
            'zone' => $zone
        ])->get()->row_object();

        //Kembali sesuai zona
        $data4 = $this->db->select('COUNT(santri_id) AS total')->from('kembalian')->where([
            'periode' => $periode,
            'liburan' => $liburan,
            'tipe' => $tipe,
            'status' => 3,
            'zone' => $zone
        ])->get()->row_object();

        $data5 = $this->db->select('COUNT(santri_id) AS total')->from('kembalian')->where([
            'periode' => $periode,
            'liburan' => $liburan,
            'tipe' => $tipe,
            'status' => 2,
            'zone' => $zone
        ])->get()->row_object();

        //Belum Kembali sesuai zona
        $data6 = $this->db->select('COUNT(santri_id) AS total')->from('kembalian')->where([
            'periode' => $periode,
            'liburan' => $liburan,
            'tipe' => $tipe,
            'status' => 1,
            'zone' => $zone
        ])->get()->row_object();

        $data7 = $this->db->select('COUNT(santri_id) AS total')->from('kembalian')->where([
            'periode' => $periode,
            'liburan' => $liburan,
            'tipe' => $tipe,
            'status' => 0,
            'zone' => $zone
        ])->get()->row_object();

        //Seluruh santri disiplin
        $data8 = $this->db->select('COUNT(santri_id) AS total')->from('kembalian')->where([
            'periode' => $periode,
            'liburan' => $liburan,
            'tipe' => $tipe,
            'status' => 3,
        ])->get()->row_object();

        //Seluruh santri telat
        $data9 = $this->db->select('COUNT(santri_id) AS total')->from('kembalian')->where([
            'periode' => $periode,
            'liburan' => $liburan,
            'tipe' => $tipe,
            'status' => 2,
        ])->get()->row_object();

        //Seluruh santri belum kembali tanpa ijin
        $data10 = $this->db->select('COUNT(santri_id) AS total')->from('kembalian')->where([
            'periode' => $periode,
            'liburan' => $liburan,
            'tipe' => $tipe,
            'status' => 0,
        ])->get()->row_object();

        //Seluruh santri belum kembali ijin
        $data11 = $this->db->select('COUNT(santri_id) AS total')->from('kembalian')->where([
            'periode' => $periode,
            'liburan' => $liburan,
            'tipe' => $tipe,
            'status' => 1,
        ])->get()->row_object();

        return [
            $data->total,
            $data1->total,
            $data2->total,
            $data3->total,
            $data4->total,
            $data5->total,
            $data6->total,
            $data7->total,
            $data8->total,
            $data9->total,
            $data10->total,
            $data11->total,
        ];
    }


    public function showfilter()
    {
        $periode = $this->baseModel->GetPeriode();
        $liburan = $this->input->post('liburan', true);
        $zone    = $this->input->post('zone', true);
        $tipe    = $this->session->userdata('tipe_user');
        $tipeFilter = $this->input->post('tipe', true);
        $daerah = $this->input->post('daerah', true);

        $this->db->select('*')->from('kembalian');
        $this->db->join('data_santri', 'id_santri = santri_id');
        $this->db->where(['periode' => $periode, 'zone' => $zone, 'tipe' => $tipe, 'liburan' => $liburan]);
        if ($tipeFilter == 1) {
            $this->db->where('status >=', 2);
        } elseif ($tipeFilter == 2) {
            $this->db->where('status <=', 1);
        }
        if ($daerah != '') {
            $this->db->where('domisili_santri', $daerah);
        }
        $this->db->order_by('status DESC, domisili_santri ASC, nomor_kamar_santri ASC');
        return $this->db->get()->result_object();
    }


    public function save()
    {
        $periode = $this->baseModel->GetPeriode();
        $id = $this->input->post('id', true);
        $liburan = $this->input->post('liburan', true);
        $zone = $this->input->post('zone', true);
        $cekID = $this->cekIDSantri($id, $zone);
        $cekBalik = $this->kembalian($id, $periode, $liburan);

        //If id not empty
        if ($id != '') {

            if ($liburan == 0) {
                //If liburan not set
                $hasil = 2;
            } elseif ($zone == 0) {
                //If zone not set
                $hasil = 3;
            } elseif ($cekID == 0) {
                //If ID Santri Not Found
                $hasil = 4;
            } elseif ($cekID == 1) {
                //If ID Santri Not Active
                $hasil = 5;
            } elseif ($cekID == 2) {
                //If Access Blocked
                $hasil = 6;
            } elseif ($cekID == 3) {
                //If Zone not same
                $hasil = 7;
            } elseif ($cekBalik != 0) {
                //If ID has been Checked
                $hasil = 8;
            } else {
                //Success
                //STATUS KEMBALI ['Belum Kembali', 'Ijin Telat', 'Telat Kembali', 'Disiplin']
                $data = [
                    'kembali' => date("Y-m-d H:i:s"),
                    'status' => setselisih()
                ];
                $this->db->where(['santri_id' => $id, 'periode' => $periode, 'liburan' => $liburan])->update('kembalian', $data);
                $hasil = 0;
            }
        } else {
            //If id is empty
            $hasil = 1;
        }

        return $hasil;
    }

    public function cekIDSantri($id, $zone)
    {
        if ($zone == 1) {
            $listZone = [
                'Bahasa Arab',
                'Bahasa Inggris',
                'Bahasa Jawa',
                'Khusus Tahfidz al-Qur\'an'
            ];
        } elseif ($zone == 2) {
            $listZone = [
                'Khusus Takhossus',
                'Khusus Qur\'ani',
                'Bahasa Indonesia'
            ];
        }

        $data = $this->db->get_where('data_santri', [
            'id_santri' => $id
        ])->row_object();

        if ($data) {
            $status = $data->status_santri;
            $tipe = $data->tipe_santri;
            $daerah = $data->domisili_santri;
            $tingkat = $data->tingkat_diniyah;
            $user = $this->session->userdata('tipe_user');

            if ($status != 1) {
                return 1;
            } elseif ($tipe != $user) {
                return 2;
            } elseif (in_array($daerah, $listZone) == FALSE) {
                return 3;
            } elseif ($tingkat == 'Kuliah Syari\'ah') {
                return 2;
            } else {
                return 4;
            }
        } else {
            return 0;
        }
    }

    public function kembalian($id, $periode, $liburan)
    {
        return $this->db->get_where('kembalian', [
            'santri_id' => $id,
            'periode' => $periode,
            'liburan' => $liburan,
            'status >' => 0
        ])->num_rows();
    }


    public function getID()
    {
        $id = $this->input->post('id', true);

        $this->db->select('*')->from('kembalian')->join('data_santri', 'id_santri = santri_id');
        $this->db->where('santri_id', $id)->order_by('id', 'DESC');
        return $this->db->get()->row_object();
    }

    public function batal()
    {
        $id = $this->input->post('id', true);
        $this->db->where('id', $id)->update('kembalian', ['kembali' => NULL, 'status' => 0, 'alasan' => NULL]);
    }


    public function cekmodal()
    {
        $id = $this->input->post('id', true);
        $zone = $this->input->post('zone', true);
        $liburan = $this->input->post('liburan', true);
        $tipe = $this->session->userdata('tipe_user');
        $periode = $this->baseModel->GetPeriode();

        $cekkembali = $this->kembalian($id, $periode, $liburan);

        if ($zone == 1) {
            $listZone = [
                'Bahasa Arab',
                'Bahasa Inggris',
                'Bahasa Jawa',
                'Khusus Tahfidz al-Qur\'an'
            ];
        } elseif ($zone == 2) {
            $listZone = [
                'Khusus Takhossus',
                'Khusus Qur\'ani',
                'Bahasa Indonesia'
            ];
        }
        $data = $this->db->get_where('data_santri', ['id_santri' => $id])->row_object();
        if ($data) {
            $status = $data->status_santri;
            $daerah = $data->domisili_santri;
            $tingkat = $data->tingkat_diniyah;
            $tipes = $data->tipe_santri;

            if ($status != 1) {
                $hasil = 'GAGAL! Santri sudah tidak aktif';
            } elseif (in_array($daerah, $listZone) == FALSE) {
                $hasil = 'GAGAL! Daerah santri tidak cocok dengan zona';
            } elseif ($tingkat == 'Kuliah Syari\'ah') {
                $hasil = 'GAGAL! Tidak bisa melayani Santri Kuliah Syari\'ah';
            } elseif ($tipes != $tipe) {
                $hasil = 'GAGAL! Akses dicegah';
            } elseif ($cekkembali > 0) {
                $hasil = 'GAGAL! Santri ini sudah melakukan check in';
            } else {
                $hasil = 0;
            }
        } else {
            $hasil = 'GAGAL! Data tidak ditemukan';
        }

        return ['hasil' => $hasil];
    }

    public function getmodal()
    {
        $id = $this->input->post('id', true);

        $this->db->select('*')->from('data_santri')->join('data_walisantri', 'nik_walisantri = wali_santri');
        return $this->db->where('id_santri', $id)->get()->row_object();
    }

    public function saveijin()
    {
        $periode = $this->baseModel->GetPeriode();
        $id = $this->input->post('id', true);
        $liburan = $this->input->post('liburan', true);
        $alasan = $this->input->post('alasan', true);

        $data = [
            'kembali' => date("Y-m-d H:i:s"),
            'status' => 1,
            'alasan' => ucfirst($alasan)
        ];
        $this->db->where(['santri_id' => $id, 'periode' => $periode, 'liburan' => $liburan])->update('kembalian', $data);
    }

    public function setdata()
    {
        $data = $this->db->get('backup_kembalian')->result_object();

        // $set = [];
        // foreach ($data as $d) {
        //     $set[] = [
        //         'santri_id' => $d->santri_id,
        //         'kembali' => $d->kembali,
        //         'status' => $d->status,
        //         'alasan' => $d->alasan
        //     ];
        // }

        // $this->db->update_batch('kembalian', $set, 'santri_id');

        $set = [];
        foreach ($data as $d) {
            $set[] = [
                'santri_id' => $d->santri_id,
                'periode' => $d->periode,
                'zone' => $d->zone,
                'tanggal' => $d->tanggal,
                'kembali' => $d->kembali,
                'liburan' => $d->liburan,
                'tipe' => $d->tipe,
                'status' => $d->status,
                'alasan' => $d->alasan
            ];
        }
        $this->db->insert_batch('kembalian', $set);
    }
}
