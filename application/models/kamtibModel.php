<?php
defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class kamtibModel extends CI_Model
{
    public function getliburan()
    {
        $data = $this->db->get('atur_liburan')->row_object();

        if ($data) {
            $hasil = $data->jenis;
        } else {
            $hasil = 0;
        }

        return $hasil;
    }

    public function getjadwal()
    {
        $user = $this->session->userdata('id_user');
        $data = $this->db->get_where('jadwal_surat', ['user' => $user])->row_object();
        if ($data) {
            $hasil = $data->daerah;
        } else {
            $hasil = 'Belum Diatur';
        }

        return $hasil;
    }


    public function getdomisili($tipe)
    {
        return $this->db->get_where('data_kamar', ['tipe_kamar' => $tipe])->result_object();
    }


    public function gettanggal()
    {
        $user = $this->session->userdata('tipe_user');
        $data = $this->db->get_where('set_date', ['tipe' => $user])->row_object();
        if ($data) {
            $hasil = $data->tanggal;
        } else {
            $hasil = 0;
        }

        return $hasil;
    }


    public function aturliburan()
    {
        $id = $this->input->post('id', true);

        //Hapus isi tabel
        $this->db->empty_table('atur_liburan');

        //perbarui data
        $this->db->insert('atur_liburan', ['jenis' => $id]);
    }


    public function aturjadwal()
    {
        $id = $this->input->post('id', true);
        $user = $this->session->userdata('id_user');

        //Hapus isi tabel
        // $this->db->empty_table('jadwal_surat');
        $this->db->where('user', $user)->delete('jadwal_surat');

        //perbarui data
        $this->db->insert('jadwal_surat', ['daerah' => $id, 'user' => $user]);
    }

    public function print()
    {
        $daerah = $this->input->post('filterDaerah', true);
        $liburan = $this->getliburan();
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

        $this->db->select('id_santri, induk_santri, nama_santri, kabupaten_santri, desa_santri, nomor_kamar_santri, domisili_santri');
        $this->db->from('data_santri');
        $this->db->where(['tipe_santri' => $user, 'tingkat_diniyah !=' => 'Kuliah Syari\'ah', 'status_santri' => 1]);
        $this->db->where_not_in('id_santri', $ids);
        if ($daerah != '') {
            $this->db->where('domisili_santri', $daerah);
        }
        return [$this->db->order_by('domisili_santri ASC, nomor_kamar_santri ASC')->get()->result_object(), $daerah];
    }


    public function zone()
    {
        $zone = $this->input->post('zone', true);
        $user = $this->session->userdata('id_user');

        //Delete Old Data From This User
        $this->db->where('user', $user)->delete('set_zone');

        //Insert or set new data
        $this->db->insert('set_zone', [
            'zone' => $zone,
            'user' => $user
        ]);
    }


    public function getZone()
    {
        $user = $this->session->userdata('id_user');
        $data = $this->db->get_where('set_zone', ['user' => $user])->row_object();
        if ($data) {
            $hasil = $data->zone;
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

        $this->db->where('tipe', $user)->delete('set_date');

        $this->db->insert('set_date', [
            'tanggal' => $jadi,
            'tipe' => $user
        ]);

        $this->setkembalian();
    }


    public function setkembalian()
    {
        $periode = $this->baseModel->GetPeriode();
        $liburan = $this->getliburan();
        $tipe = $this->session->userdata('tipe_user');
        $tanggal = $this->gettanggal();

        //Bersihkan data
        //$this->db->where(['periode' => $periode, 'liburan' => $liburan, 'tipe' => $tipe])->delete('kembalian');

        $cek = $this->db->get_where('kembalian', [
            'periode' => $periode,
            'liburan' => $liburan,
            'tipe' => $tipe
        ])->num_rows();

        if ($cek > 0) {
            $getdata = $this->db->get_where('kembalian', [
                'periode' => $periode,
                'liburan' => $liburan,
                'tipe' => $tipe
            ])->result_object();
            foreach ($getdata as $dd) {
                $datax[] = [
                    'id' => $dd->id,
                    'tanggal' => $tanggal
                ];
            }
            $this->db->update_batch('kembalian', $datax, 'id');
        } else {
            $get = $this->db->get_where('data_santri', ['status_santri' => 1, 'tingkat_diniyah !=' => 'Kuliah Syari\'ah', 'tipe_santri' => $tipe])->result_object();
            $datax = [];

            $listZone1 = [
                'Bahasa Arab',
                'Bahasa Inggris',
                'Bahasa Jawa',
                'Khusus Tahfidz al-Qur\'an'
            ];

            $listZone2 = [
                'Khusus Takhossus',
                'Khusus Qur\'ani',
                'Bahasa Indonesia'
            ];
            foreach ($get as $d) {

                $daerah = $d->domisili_santri;
                if (in_array($daerah, $listZone1)) {
                    $zone = 1;
                } elseif (in_array($daerah, $listZone2)) {
                    $zone = 2;
                }

                $datax[] = [
                    'santri_id' => $d->id_santri,
                    'periode' => $periode,
                    'zone' => $zone,
                    'tanggal' => $tanggal,
                    'liburan' => $liburan,
                    'tipe' => $tipe,
                    'status' => 0
                ];
            }
            $this->db->insert_batch('kembalian', $datax);
        }
    }

    public function loadDataSantri()
    {
        $nama = $this->input->post('nama', true);
        $tipe = $this->session->userdata('tipe_user');

        $this->db->select('*');
        $this->db->from('data_santri');
        $this->db->where([
            'tipe_santri' => $tipe,
            'status_santri' => 1,
            'tingkat_diniyah !=' => 'Kuliah Syari\'ah'
        ]);
        if ($nama != '') {
            $this->db->like('nama_santri', $nama);
        }
        $this->db->order_by('id_santri', 'ASC');

        $data = $this->db->get()->result_object();
        //$total = $this->db->get()->num_rows();

        return $data;
    }


    public function printlagi()
    {
        $daerah = $this->input->post('filterDaerahLagi', true);
        $liburan = $this->getliburan();
        $user = $this->session->userdata('tipe_user');
        $periode = $this->baseModel->GetPeriode();

        $this->db->select('*')->from('kembalian')->join('data_santri', 'id_santri = santri_id');
        $this->db->where([
            'tipe_santri' => $user,
            'periode' => $periode,
            'liburan' => $liburan,
            'status <' => 3,
            'domisili_santri !=' => 'Rumah Orang Tua'
        ]);
        if ($daerah != '') {
            $this->db->where('domisili_santri', $daerah);
        }
        return [$this->db->order_by('domisili_santri ASC, nomor_kamar_santri ASC, status ASC')->get()->result_object(), $daerah];
    }

	public function printBanat()
	{
		$daerah = $this->input->post('domisili', true);

		$this->db->select('*')->from('kembalian_banat')->join('data_santri', 'id_santri = santri_id');
		$this->db->where([
			'status <' => 3,
			'domisili_santri !=' => 'Rumah Orang Tua'
		]);
		if ($daerah != '') {
			$this->db->where('domisili_santri', $daerah);
		}
		return [$this->db->order_by('domisili_santri ASC, nomor_kamar_santri ASC, status ASC')->get()->result_object(), $daerah];
	}
}
