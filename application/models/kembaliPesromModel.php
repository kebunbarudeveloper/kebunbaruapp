<?php
defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class kembaliPesromModel extends CI_Model
{
    public function getDomicile()
    {
        $tipe = $this->session->userdata('tipe_user');
        return $this->db->distinct()->select('domisili_santri')->from('data_santri')->where([
            'tipe_santri' => $tipe, 'domisili_santri !=' => ''
        ])->get()->result_object();
    }

    public function gettanggal()
    {
        $user = $this->session->userdata('tipe_user');
        $data = $this->db->get_where('set_date_pesrom', ['tipe' => $user])->row_object();
        if ($data) {
            $hasil = $data->tanggal;
        } else {
            $hasil = 0;
        }

        return $hasil;
    }

    public function tanggal()
    {
        $tanggal = $this->input->post('tanggal', true);
        $bulan = $this->input->post('bulan', true);
        $tahun = $this->input->post('tahun', true);
        $gabung = $tahun . '-' . $bulan . '-' . $tanggal;
        $jam = $this->input->post('jam', true);
        $waktu = $jam . ':00';
        $user = $this->session->userdata('tipe_user');

        $t = date_create($gabung);
        $tt = date_format($t, 'Y-m-d');

        $w = date_create($waktu);
        $ww = date_format($w, 'H:i:s');
        $gb = date_create($tt . ' ' . $ww);
        $jadi = date_format($gb, 'Y-m-d H:i:s');

        $this->db->where('tipe', $user)->delete('set_date_pesrom');

        $this->db->insert('set_date_pesrom', [
            'tanggal' => $jadi,
            'tipe' => $user
        ]);

        $this->setkembalian();
    }


    public function setkembalian()
    {
        $periode = $this->baseModel->GetPeriode();
        $tipe = $this->session->userdata('tipe_user');
        $tanggal = $this->gettanggal();

        //Bersihkan data
        //$this->db->where(['periode' => $periode, 'liburan' => $liburan, 'tipe' => $tipe])->delete('kembalian');

        $cek = $this->db->get_where('kembalian_pesrom', [
            'periode' => $periode,
            'tipe' => $tipe
        ])->num_rows();

        if ($cek > 0) {
            $getdata = $this->db->get_where('kembalian_pesrom', [
                'periode' => $periode,
                'tipe' => $tipe
            ])->result_object();
            foreach ($getdata as $dd) {
                $datax[] = [
                    'id' => $dd->id,
                    'tanggal' => $tanggal
                ];
            }
            $this->db->update_batch('kembalian_pesrom', $datax, 'id');
        } else {
            $get = $this->db->get_where('data_santri', [
                'status_santri' => 1,
                'tingkat_diniyah !=' => 'Kuliah Syari\'ah',
                'kelas_diniyah !=' => 'Lulus',
                'kelas_diniyah !=' => 0,
                'tipe_santri' => $tipe,
                'domisili_santri !=' => 'Rumah Orang Tua'
            ])->result_object();
            $datax = [];

            foreach ($get as $d) {
                $kelas = $d->kelas_diniyah;
                $tingkat = $d->tingkat_diniyah;
                if (($tingkat == 'I\'dadiyah' && $kelas == 'Takhossus') || ($tingkat == 'Ibtidaiyah' && $kelas >= 5) || $tingkat == 'Aliyah' || $tingkat == 'Tsanawiyah') {
                    $statusKembali = 1; //Wajib
                } else {
                    $statusKembali = 0; //Tidak wajib
                }

                $datax[] = [
                    'santri_id' => $d->id_santri,
                    'periode' => $periode,
                    'tanggal' => $tanggal,
                    'tipe' => $tipe,
                    'status_kembali' => $statusKembali,
                    'status' => 0
                ];
            }
            $this->db->insert_batch('kembalian_pesrom', $datax);
        }
    }
    public function getdata()
    {
        $periode = $this->baseModel->GetPeriode();
        $tipe    = $this->session->userdata('tipe_user');

        //Seluruh santri belum kembali
        $data = $this->db->select('COUNT(santri_id) AS total')->from('kembalian_pesrom')->where([
            'periode' => $periode,
            'tipe' => $tipe,
            'status <=' => 1,
            'status_kembali' => 1,
        ])->get()->row_object();
        
        //Seluruh santri sudah kembali
        $data1 = $this->db->select('COUNT(santri_id) AS total')->from('kembalian_pesrom')->where([
            'periode' => $periode,
            'tipe' => $tipe,
            'status >=' => 2,
            'status_kembali' => 1,
        ])->get()->row_object();

        //Kembali disiplin
        $data4 = $this->db->select('COUNT(santri_id) AS total')->from('kembalian_pesrom')->where([
            'periode' => $periode,
            'tipe' => $tipe,
            'status' => 3,
            'status_kembali' => 1,
        ])->get()->row_object();

        //Kembali telat
        $data5 = $this->db->select('COUNT(santri_id) AS total')->from('kembalian_pesrom')->where([
            'periode' => $periode,
            'tipe' => $tipe,
            'status' => 2,
            'status_kembali' => 1,
        ])->get()->row_object();

        //Seluruh santri belum kembali tanpa ijin
        $data10 = $this->db->select('COUNT(santri_id) AS total')->from('kembalian_pesrom')->where([
            'periode' => $periode,
            'tipe' => $tipe,
            'status' => 0,
            'status_kembali' => 1,
        ])->get()->row_object();

        //Seluruh santri belum kembali ijin
        $data11 = $this->db->select('COUNT(santri_id) AS total')->from('kembalian_pesrom')->where([
            'periode' => $periode,
            'tipe' => $tipe,
            'status' => 1,
            'status_kembali' => 1,
        ])->get()->row_object();

        return [
            $data1->total,
            $data->total,
            $data4->total,
            $data5->total,
            $data11->total,
            $data10->total,
        ];
    }


    public function showfilter()
    {
        $periode = $this->baseModel->GetPeriode();
        $tipe    = $this->session->userdata('tipe_user');
        $tipeFilter = $this->input->post('type', true);
        $daerah = $this->input->post('domicile', true);

        $this->db->select('*')->from('kembalian_pesrom');
        $this->db->join('data_santri', 'id_santri = santri_id');
        $this->db->where(['periode' => $periode, 'tipe_santri' => $tipe]);
        if ($tipeFilter == 1) {
            $this->db->where('status >=', 2);
        } else {
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
        $cekID = $this->cekIDSantri($id);
        $cekBalik = $this->kembalian($id, $periode);

        //If id not empty
        if ($id != '') {

            if ($cekID == 0) {
                //If ID Santri Not Found
                $hasil = 4;
            } elseif ($cekID == 1) {
                //If ID Santri Not Active
                $hasil = 5;
            } elseif ($cekID == 2) {
                //If Access Blocked
                $hasil = 6;
            } elseif ($cekBalik != 0) {
                //If ID has been Checked
                $hasil = 8;
            } else {
                //Success
                //STATUS KEMBALI ['Belum Kembali', 'Ijin Telat', 'Telat Kembali', 'Disiplin']
                $data = [
                    'kembali' => date("Y-m-d H:i:s"),
                    'status' => $this->setDiff()
                ];
                $this->db->where(['santri_id' => $id, 'periode' => $periode])->update('kembalian_pesrom', $data);
                $hasil = 0;
            }
        } else {
            //If id is empty
            $hasil = 1;
        }

        return $hasil;
    }

    public function cekIDSantri($id)
    {
        $data = $this->db->get_where('data_santri', [
            'id_santri' => $id
        ])->row_object();

        if ($data) {
            $status = $data->status_santri;
            $tipe = $data->tipe_santri;
            $tingkat = $data->tingkat_diniyah;
            $user = $this->session->userdata('tipe_user');

            if ($status != 1) {
                return 1;
            } elseif ($tipe != $user) {
                return 2;
            } elseif ($tingkat == 'Kuliah Syari\'ah') {
                return 2;
            } else {
                return 3;
            }
        } else {
            return 0;
        }
    }

    public function kembalian($id, $periode)
    {
        return $this->db->get_where('kembalian_pesrom', [
            'santri_id' => $id,
            'periode' => $periode,
            'status >' => 0
        ])->num_rows();
    }


    public function getID()
    {
        $id = $this->input->post('id', true);
        $periode = $this->baseModel->GetPeriode();

        $this->db->select('*')->from('kembalian_pesrom')->join('data_santri', 'id_santri = santri_id');
        $this->db->where(['santri_id' => $id, 'periode' => $periode])->order_by('id', 'DESC');
        return $this->db->get()->row_object();
    }

    public function batal()
    {
        $id = $this->input->post('id', true);
        $this->db->where('id', $id)->update('kembalian_pesrom', ['kembali' => NULL, 'status' => 0, 'alasan' => NULL]);
    }


    public function cekmodal()
    {
        $id = $this->input->post('id', true);
        $tipe = $this->session->userdata('tipe_user');
        $periode = $this->baseModel->GetPeriode();

        $cekkembali = $this->kembalian($id, $periode);
        $data = $this->db->get_where('data_santri', ['id_santri' => $id])->row_object();
        if ($data) {
            $status = $data->status_santri;
            $tingkat = $data->tingkat_diniyah;
            $tipes = $data->tipe_santri;

            if ($status != 1) {
                $hasil = 'GAGAL! Santri sudah tidak aktif';
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
        $alasan = $this->input->post('alasan', true);

        $data = [
            'kembali' => date("Y-m-d H:i:s"),
            'status' => 1,
            'alasan' => ucfirst($alasan)
        ];
        $this->db->where(['santri_id' => $id, 'periode' => $periode])->update('kembalian_pesrom', $data);
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

    public function setDiff()
    {
        $waktu = $this->gettanggal();
        $kembali = date("Y-m-d H:i:s");
        $selisih = strtotime($waktu) - strtotime($kembali);
        $selisih = floor($selisih / 86400);

        if ($selisih >= 0) {
            $hasil = 3;
        } else {
            $hasil = 2;
        }

        return $hasil;
    }

    function selisihWaktu($kembali)
    {
        $waktu = $this->gettanggal();
        $awal = date_create($waktu);
        $akhir = date_create($kembali); // waktu sekarang
        $diff  = date_diff($awal, $akhir);

        $tahun = $diff->y;
        $bulan = $diff->m;
        $hari = $diff->d;
        $jam = $diff->h;
        $menit = $diff->i;
        $detik = $diff->s;

        if ($tahun != 0) {
            $t = $tahun . ' tahun';
        } else {
            $t = '';
        }

        if ($bulan != 0) {
            $b = $bulan . ' bulan';
        } else {
            $b = '';
        }

        if ($hari != 0) {
            $h = $hari . ' hari';
        } else {
            $h = '';
        }

        if ($jam != 0) {
            $j = $jam . ' jam';
        } else {
            $j = '';
        }

        if ($menit != 0) {
            $m = $menit . ' menit';
        } else {
            $m = '';
        }

        if ($detik != 0) {
            $d = $detik . ' detik';
        } else {
            $d = '';
        }

        return $t . ' ' . $b . ' ' . $h . ' ' . $j . ' ' . $m . ' ' . $d;
        // return $diff;
    }
}
