<?php
defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class verifikasiBerkasModel extends CI_Model
{
    public function getdata($tipe)
    {
        $platform = $this->input->post('platform', true);
        if ($platform != '') {
            $conditions = ['tipe' => $tipe, 'platform' => $platform];
        } else {
            $conditions = ['tipe' => $tipe];
        }

        return [
            $this->db->order_by('status ASC, urut DESC')->get_where('verifikasi', $conditions)->result_object(),
            $this->db->get_where('verifikasi', $conditions)->num_rows(),
        ];
    }

    public function getKamar($tipe)
    {
        return $this->db->get_where('data_kamar', ['tipe_kamar' => $tipe])->result_object();
    }

    public function getPendidikan($tipe, $akses)
    {
        $query = "SELECT * FROM data_pendidikan WHERE tipe_datapendidikan = $tipe AND akses_datapendidikan IN(3, $akses) ORDER BY urut_datapendidikan ASC";
        return $this->db->query($query)->result_object();
    }

    public function ceknik($nik)
    {
        $ceksantri = $this->db->get_where('data_santri', ['nik_santri' => $nik])->num_rows();
        $cekverfikasi = $this->db->get_where('verifikasi', ['nik' => $nik])->num_rows();

        if ($ceksantri > 0 || $cekverfikasi > 0) {
            return ['hasil' => 200];
        } else {
            return ['hasil' => 400];
        }
    }

    public function ceknikwali($nik)
    {
        $cek = $this->db->get_where('data_walisantri', ['nik_walisantri' => $nik])->num_rows();

        if ($cek > 0) {
            return ['hasil' => 200, 'data' => $this->db->get_where('data_walisantri', ['nik_walisantri' => $nik])->row_array()];
        } else {
            return ['hasil' => 400, 'data' => []];
        }
    }

    public function simpan()
    {
        $nik = $this->input->post('nik', true);
        $nope   = str_replace('-', '', $this->input->post('hp', true));
        $nowa   = str_replace('-', '', $this->input->post('wa', true));
        $domisili = $this->input->post('domisili', true);
        $tipe = $this->session->userdata('tipe_user');
        $id = $this->input->post('id', true);
        $niklama = $this->input->post('niklama', true);


        if ($domisili == 'P2K') {
            if ($tipe == 1) {
                $kamar = 1;
                $daerah = 'Bahasa Indonesia';
            } else {
                $kamar = $this->input->post('kamar', true);
                $daerah = $this->input->post('daerah', true);
            }
        } else {
            $kamar = 0;
            $daerah = 'Rumah Orang Tua';
        }


        $data = [
            'id' => '1391' . mt_rand(1001, 9999),
            'nik' => $nik,
            'nama' => strtoupper($this->input->post('nama', true)),
            'domisili' => $domisili,
            'kamar' => $kamar,
            'daerah' => $daerah,
            'kelas' => $this->input->post('kelasd', true),
            'tingkat' => $this->input->post('tingkatd', true),
            'kelasf' => $this->input->post('kelasf', true),
            'tingkatf' => $this->input->post('tingkatf', true),
            'nikw' => $this->input->post('nikw', true),
            'namaw' => strtoupper($this->input->post('namaw', true)),
            'hp' => $nope,
            'wa' => $nowa,
            'pendidikan' => $this->input->post('pendidikan', true),
            'hubungan' => $this->input->post('hubungan', true),
            'status' => 0, //0 => Pending | 1 => Selesai
            'tipe' => $tipe,
            'platform' => 1,
            'input' => 0
        ];


        if ($id == 0) {
            if ($this->ceknik($nik)['hasil'] == 400) {
                $this->db->insert('verifikasi', $data);
                if ($this->db->affected_rows() > 0) {
                    return 1;
                } else {
                    return 0;
                }
            } else {
                return 3;
            }
        } else {
            array_shift($data);
            if ($nik != $niklama) {
                if ($this->ceknik($nik)['hasil'] == 400) {
                    $this->db->where('id', $id)->update('verifikasi', $data);
                    if ($this->db->affected_rows() > 0) {
                        return 2;
                    } else {
                        return 0;
                    }
                } else {
                    return 3;
                }
            } else {
                $this->db->where('id', $id)->update('verifikasi', $data);
                if ($this->db->affected_rows() > 0) {
                    return 2;
                } else {
                    return 0;
                }
            }
        }
    }

    public function getid($id)
    {
        $cek = $this->db->get_where('verifikasi', ['id' => $id])->num_rows();
        if ($cek > 0) {
            return ['status' => 200, 'data' => $this->db->get_where('verifikasi', ['id' => $id])->row_array()];
        } else {
            return ['status' => 400, 'data' => []];
        }
    }

    public function ceknoreg($noreg)
    {
        return $this->db->get_where('santri_online', [
            'id_santri' => $noreg,
            'jenis' => $this->session->userdata('tipe_user'),
            'status' => 0
        ])->num_rows();
    }

    public function loaddatareg($noreg)
    {
        $this->db->select('*')->from('santri_online')->join('wali_online', 'id_santri = santri');
        $this->db->where('id_santri', $noreg);
        return $this->db->get()->row_object();
    }

    public function setreg($noreg)
    {
        $tipe = $this->session->userdata('tipe_user');
        $result = $this->loaddatareg($noreg);
        $data = [
            'id' => '1391' . mt_rand(1001, 9999),
            'nik' => $result->nik,
            'nama' => $result->nama,
            'domisili' => $result->domisili,
            'kamar' => $result->nomor,
            'daerah' => $result->daerah,
            'kelas' => $result->kelasd,
            'tingkat' => $result->diniyah,
            'kelasf' => $result->kelasf,
            'tingkatf' => $result->formal,
            'nikw' => $result->nikw,
            'namaw' => $result->namaw,
            'hp' => $result->hp,
            'wa' => $result->wa,
            'pendidikan' => $result->pendidikanw,
            'hubungan' => $result->hubungan,
            'status' => 0, //0 => Pending | 1 => Selesai
            'tipe' => $tipe,
            'platform' => 2,
            'input' => 0,
            'kk' => $result->kk,
            'pendidikans' => $result->pendidikan,
            'tempat' => $result->tempat,
            'tanggal' => $result->tanggal,
            'dusun' => $result->dusun,
            'rt' => $result->rt,
            'rw' => $result->rw,
            'desa' => $result->desa,
            'kecamatan' => $result->kecamatan,
            'kabupaten' => $result->kabupaten,
            'provinsi' => $result->provinsi,
            'pos' => $result->pos,
            'ayah' => $result->ayah,
            'ibu' => $result->ibu,
            'dusunw' => $result->dusunw,
            'rtw' => $result->rtw,
            'rww' => $result->rww,
            'desaw' => $result->desaw,
            'kecamatanw' => $result->kecamatanw,
            'kabupatenw' => $result->kabupatenw,
            'provinsiw' => $result->provinsiw,
            'posw' => $result->posw,
            'pekerjaan' => $result->pekerjaan
        ];

        $cek = $this->ceknoreg($noreg);
        if ($cek <= 0) {
            return 0;
        } else {
            $this->db->where('id_santri', $noreg)->update('santri_online', ['status' => 200]);
            $this->db->insert('verifikasi', $data);
            return $this->db->affected_rows();
        }
    }
}
