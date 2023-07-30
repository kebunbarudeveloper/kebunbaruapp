<?php
defined('BASEPATH') or exit('No direct script access allowed');

class bmModel extends CI_Model
{
    public function data($id)
    {
        $this->db->select('*')->from('bm');
        if ($id !== 0) {
            $cekNum = is_numeric($id);
            if ($cekNum == 1) {
                $this->db->like('id', $id, 'after');
            } else {
                $this->db->like('nama', $id, 'both');
            }
        }

        $data = $this->db->get()->result_object();
        if ($data) {
            return $data;
        } else {
            return 0;
        }
    }

    public function load()
    {
        $data = $this->db->get('bm')->result_object();
        if ($data) {
            return $data;
        } else {
            return 0;
        }
    }

    public function save($id, $wa)
    {
        $this->db->where('id', $id)->update('bm', ['checkin' => 1, 'wa' => $wa]);
        $data = $this->db->affected_rows();

        if ($data > 0) {
            $hasil = ['hasil' => 1];
        } else {
            $hasil = ['hasil' => 0];
        }

        return $hasil;
    }
}
