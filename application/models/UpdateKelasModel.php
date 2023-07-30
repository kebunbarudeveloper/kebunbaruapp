<?php
defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class UpdateKelasModel extends CI_Model
{
    public function getDaerah($tipe)
    {
        return $this->db->get_where('data_kamar', ['tipe_kamar' => $tipe])->result_object();
    }

    public function getDaerahKe($tipe)
    {
        return $this->db->get_where('data_kamar', ['tipe_kamar' => $tipe, 'nama_kamar !=' => ''])->result_object();
    }

    public function load($kelas, $tingkat)
    {
        $tipe = $this->session->userdata('tipe_user');

        $this->db->select('id_santri, nama_santri, desa_santri, kelas_diniyah, tingkat_diniyah, kabupaten_santri, induk_santri, domisili_santri, nomor_kamar_santri');
        $this->db->from('data_santri');
        $this->db->where(['status_santri' => 1, 'tipe_santri' => $tipe]);
        if ($kelas && $kelas != 111) {
            $this->db->where('kelas_diniyah', $kelas);
        }

        if ($tingkat && $tingkat != 111) {
            $this->db->where('tingkat_diniyah', $tingkat);
        }

        $data = $this->db->get()->result_object();

        $this->db->select('COUNT(id_santri) AS total');
        $this->db->from('data_santri');
        $this->db->where(['status_santri' => 1, 'tipe_santri' => $tipe]);
        if ($kelas && $kelas != 111) {
            $this->db->where('kelas_diniyah', $kelas);
        }
        if ($tingkat && $tingkat != 111) {
            $this->db->where('tingkat_diniyah', $tingkat);
        }
        $total = $this->db->get()->row_object();
        return [$data, $total->total];
    }

    public function simpan()
    {
        $id = $this->input->post('id', true);
        $kelas = $this->input->post('kelasfiks', true);
        $tingkat = $this->input->post('tingkatfiks', true);

        $data = [];
        foreach ($id as $key => $value) {
            $data[] = [
                'id_santri' => $id[$key],
                'kelas_diniyah' => $kelas,
                'tingkat_diniyah' => $tingkat
            ];
        }
        $this->db->update_batch('data_santri', $data, 'id_santri');
        return $this->db->affected_rows();
    }

    public function dataPerdomisili($kelas, $tingkat)
    {
        $this->db->select('*')->from('data_santri')->join('data_walisantri', 'wali_santri = nik_walisantri');
        $this->db->where(['kelas_diniyah' => $kelas, 'tingkat_diniyah' => $tingkat, 'status_santri' => 1, 'status_santri' => 1, 'tipe_santri' => $this->session->userdata('tipe_user')]);
        return $this->db->get()->result_object();
    }
}
