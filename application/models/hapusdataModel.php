<?php
defined('BASEPATH') or exit('No direct script access allowed');

class hapusdataModel extends CI_Model
{
    public function cekdata()
    {
        $id = $this->input->post('id', true);
        $user = $this->session->userdata('tipe_user');

        $data = $this->db->get_where('data_santri', ['id_santri' => $id])->row_object();
        if ($data) {
            $jenis = $data->tipe_santri;
            if ($jenis != $user) {
                return ['hasil' => 1];
            } else {
                return ['hasil' => $data];
            }
        } else {
            return ['hasil' => 0];
        }
    }

    public function simpan()
    {
        $id = $this->input->post('id', true);
        $this->db->where('id_santri', $id)->update('data_santri', ['status_santri' => 10]);
        $data = $this->db->affected_rows();
        return ['hasil' => $data];
    }
}
