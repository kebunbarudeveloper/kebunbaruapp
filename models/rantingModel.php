<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class rantingModel extends CI_Model
{
    public function DataRanting()
    {
        $id = $this->session->userdata('login_id');

        return $this->db->get_where('ranting', ['id_ranting' => $id])->row_object();
    }



    public function SimpanEditRanting()
    {
        $id   = $this->session->userdata('login_id');
        $no   = $this->input->post('noperanting', true);
        $nope = str_replace('-', '', $no);

        $data = [
            'rt_ranting' => $this->input->post('rtranting', true),
            'rw_ranting' => $this->input->post('rwranting', true),
            'dusun_ranting' => $this->input->post('dusunranting', true),
            'desa_ranting' => $this->input->post('desaranting', true),
            'kec_ranting' => $this->input->post('kecranting', true),
            'kab_ranting' => $this->input->post('kabranting', true),
            'pro_ranting' => $this->input->post('provinsiranting', true),
            'pos_ranting' => $this->input->post('posranting', true),
            'nope_ranting' => $nope,
            'tahun_berdiri' => $this->input->post('tahunberdiriranting', true),
            'no_statistik' => $this->input->post('nostatistik', true),
            'no_identitas' => $this->input->post('noidentitas', true),
            'nama_yayasan' => strtoupper($this->input->post('namayayasan', true)),
            'pengasuh_yayasan' => strtoupper($this->input->post('pengasuh', true)),
            'akte_yayasan' => $this->input->post('akteyayasan', true),
            'tahun_berdiri_yayasan' => $this->input->post('tahunberdiriyayasan', true),
            'email_ranting' => $this->input->post('emailranting', true)
        ];

        $this->db->where('id_ranting', $id)->update('ranting', $data);
    }


}
