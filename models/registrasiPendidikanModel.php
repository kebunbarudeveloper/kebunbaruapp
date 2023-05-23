<?php
defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class registrasiPendidikanModel extends CI_Model
{
    public function getdata($tipe)
    {
        $periode = $this->baseModel->GetPeriode();
        $platform = $this->input->post('platform', true);

        if ($platform == '' || $platform == 0) {
            return [
                $this->db->select('COUNT(id) as total, tingkat')->from('registrasi_pendidikan')->where([
                    'tipe' => 1, 'periode' => $periode, 'tipe_santri' => $tipe
                ])->group_by('tingkat')->get()->result_object(),
                $this->db->select('COUNT(id) as total, tingkat')->from('registrasi_pendidikan')->where([
                    'tipe' => 2, 'periode' => $periode, 'tipe_santri' => $tipe
                ])->group_by('tingkat')->get()->result_object()
            ];
        } else {
            $this->db->select('a.*, b.kelas, b.tingkat')->from('registrasi_pendidikan as b');
            $this->db->join('data_santri as a', 'b.santri_id = a.id_santri');
            $this->db->where(['b.tipe' => $platform, 'b.tipe_santri' => $tipe, 'b.periode' => $periode]);
            $data = $this->db->get();
            return [
                $data->result_object(),
                $data->num_rows(),
            ];
        }
    }

    public function getPendidikan($tipe, $akses)
    {
        $query = "SELECT * FROM data_pendidikan WHERE tipe_datapendidikan = $tipe AND akses_datapendidikan IN(3, $akses) ORDER BY urut_datapendidikan ASC";
        return $this->db->query($query)->result_object();
    }

    public function simpan()
    {
        $idd = $this->input->post('idd', true);
        $tingkat = $this->input->post('tingkatd', true);
        $tipe = $this->session->userdata('tipe_user');
        $kelas = $this->input->post('kelasd', true);
        $periode = $this->baseModel->GetPeriode();

        if ($idd == '' || $tingkat == '' || $kelas == '') {
            return [
                'status' => 400,
                'message' => 'Pastikan semua bidang inputan telah diisi'
            ];
        }

        $cek = $this->db->get_where('data_santri', [
            'id_santri' => $idd, 'status_santri' => 1
        ])->num_rows();

        if ($cek <= 0) {
            return [
                'status' => 400,
                'message' => 'ID Santri tidak valid'
            ];
        }

        $cekreg = $this->db->get_where('registrasi_pendidikan', [
            'santri_id' => $idd, 'tipe' => 1, 'periode' => $periode
        ])->num_rows();
        if ($cekreg > 0) {
            return [
                'status' => 400,
                'message' => 'Data sudah ada'
            ];
        }

        $data = [
            'santri_id' => $idd,
            'tipe_santri' => $tipe,
            'tipe' => 1,
            'tingkat' => $tingkat,
            'kelas' => $kelas,
            'tanggal' => $this->baseModel->GetHijriSekarang(),
            'created_at' => date('Y-m-d'),
            'periode' => $periode
        ];

        $this->db->insert('registrasi_pendidikan', $data);
        if ($this->db->affected_rows() <= 0) {
            return [
                'status' => 400,
                'message' => 'Server gagal menyimpan'
            ];
        }

        return [
            'status' => 200,
            'message' => 'Sukses'
        ];
    }

    public function simpanf()
    {
        $idf = $this->input->post('idf', true);
        $tingkatf = $this->input->post('tingkatf', true);
        $tipe = $this->session->userdata('tipe_user');
        $kelasf = $this->input->post('kelasf', true);
        $periode = $this->baseModel->GetPeriode();

        if ($idf == '' || $tingkatf == '' || $kelasf == '') {
            return [
                'status' => 400,
                'message' => 'Pastikan semua bidang inputan telah diisi'
            ];
        }

        $cek = $this->db->get_where('data_santri', [
            'id_santri' => $idf, 'status_santri' => 1
        ])->num_rows();

        if ($cek <= 0) {
            return [
                'status' => 400,
                'message' => 'ID Santri tidak valid'
            ];
        }

        $cekreg = $this->db->get_where('registrasi_pendidikan', [
            'santri_id' => $idf, 'tipe' => 2, 'periode' => $periode
        ])->num_rows();
        if ($cekreg > 0) {
            return [
                'status' => 400,
                'message' => 'Data sudah ada'
            ];
        }

        $data = [
            'santri_id' => $idf,
            'tipe_santri' => $tipe,
            'tipe' => 2,
            'tingkat' => $tingkatf,
            'kelas' => $kelasf,
            'tanggal' => $this->baseModel->GetHijriSekarang(),
            'created_at' => date('Y-m-d'),
            'periode' => $periode
        ];

        $this->db->insert('registrasi_pendidikan', $data);
        if ($this->db->affected_rows() <= 0) {
            return [
                'status' => 400,
                'message' => 'Server gagal menyimpan'
            ];
        }

        return [
            'status' => 200,
            'message' => 'Sukses'
        ];
    }

    public function DataExport($level)
    {
        $tipe = $this->session->userdata('tipe_user');
        $periode = $this->baseModel->GetPeriode();

        $this->db->select('a.tingkat, a.kelas, b.*, c.*')->from('registrasi_pendidikan as a');
        $this->db->join('data_santri as b', 'a.santri_id = b.id_santri');
        $this->db->join('data_walisantri as c', 'b.wali_santri = c.nik_walisantri');
        $this->db->where(['a.tipe_santri' => $tipe, 'a.tipe' => $level, 'a.periode' => $periode]);
        return $this->db->get()->result_object();
    }
}
