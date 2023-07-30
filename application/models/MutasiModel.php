<?php
defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class MutasiModel extends CI_Model
{
    public function getDaerah($tipe)
    {
        return $this->db->get_where('data_kamar', ['tipe_kamar' => $tipe])->result_object();
    }

    public function getDaerahKe($tipe)
    {
        return $this->db->get_where('data_kamar', ['tipe_kamar' => $tipe, 'nama_kamar !=' => ''])->result_object();
    }

    public function load($daerah, $kamar)
    {
        $tipe = $this->session->userdata('tipe_user');

        $this->db->select('id_santri, nama_santri, desa_santri, kabupaten_santri, induk_santri, domisili_santri, nomor_kamar_santri');
        $this->db->from('data_santri');
        $this->db->where(['status_santri' => 1, 'tipe_santri' => $tipe]);
        if ($daerah && $daerah != 111) {
            $this->db->where('domisili_santri', $daerah);
        }

        if ($kamar && $kamar != 111) {
            $this->db->where('nomor_kamar_santri', $kamar);
        }

        $data = $this->db->get()->result_object();

        $this->db->select('COUNT(id_santri) AS total');
        $this->db->from('data_santri');
        $this->db->where(['status_santri' => 1, 'tipe_santri' => $tipe]);
        if ($daerah && $daerah != 111) {
            $this->db->where('domisili_santri', $daerah);
        }
        if ($kamar && $kamar != 111) {
            $this->db->where('nomor_kamar_santri', $kamar);
        }
        $total = $this->db->get()->row_object();
        return [$data, $total->total];
    }

    public function simpan()
    {
        $id = $this->input->post('id', true);
        $daerah = $this->input->post('daerahfiks', true);
        $kamar = $this->input->post('kamarfiks', true);

        $data = [];
        foreach ($id as $key => $value) {
            $data[] = [
                'id_santri' => $id[$key],
                'domisili_santri' => $daerah,
                'nomor_kamar_santri' => $kamar
            ];
        }
        $this->db->update_batch('data_santri', $data, 'id_santri');
        return $this->db->affected_rows();
    }

    public function dataPerdomisili($daerah, $kamar)
    {
        $this->db->select('*')->from('data_santri')->join('data_walisantri', 'wali_santri = nik_walisantri');
        $this->db->where(['domisili_santri' => $daerah, 'nomor_kamar_santri' => $kamar, 'status_santri' => 1, 'status_santri' => 1, 'tipe_santri' => $this->session->userdata('tipe_user')]);
        return $this->db->get()->result_object();
    }
}
