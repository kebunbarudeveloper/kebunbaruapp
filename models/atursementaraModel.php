<?php
defined('BASEPATH') or exit('No direct script access allowed');


class atursementaraModel extends CI_Model
{
    public function getData()
    {
        $user = $this->session->userdata('tipe_user');
        return $this->db->get_where('atur_sementara', ['tipe' => $user])->row_object();
    }

    public function simpan()
    {
        $user = $this->session->userdata('tipe_user');
        $periode = $this->input->post('tahunperiode', true);
        $tanggal = $this->input->post('tanggal', true);
        $bulan = $this->input->post('bulan', true);
        $tahun = $this->input->post('tahun', true);
        $jadi = $tahun . '-' . $bulan . '-' . $tanggal;

        $this->db->where('tipe', $user)->delete('atur_sementara');
        $data = [
            'periode' => $periode,
            'tanggal' => $jadi,
            'tipe' => $user
        ];
        $this->db->insert('atur_sementara', $data);
    }
}
