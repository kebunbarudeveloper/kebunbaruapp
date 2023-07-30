<?php
defined('BASEPATH') or exit('No direct script access allowed');


class dataModel extends CI_Model
{
    public function GetProvinsi($title)
    {
        $this->db->like('nama', $title, 'both');
        $this->db->order_by('id', 'ASC');
        $this->db->limit(10);
        return $this->db->get('data_provinsi')->result();
    }


    public function GetKab($id, $title)
    {
        $this->db->like('nama', $title, 'both');
        $this->db->order_by('id', 'ASC');
        $this->db->limit(10);
        return $this->db->get_where('data_kabupaten', ['provinsi_id' => $id])->result();
    }


    public function GetKec($id, $title)
    {
        $this->db->like('nama', $title, 'both');
        $this->db->order_by('id', 'ASC');
        $this->db->limit(10);
        return $this->db->get_where('data_kecamatan', ['kabupaten_id' => $id])->result();
    }


    public function GetDesa($id, $title)
    {
        $this->db->like('nama', $title, 'both');
        $this->db->order_by('id', 'ASC');
        $this->db->limit(10);
        return $this->db->get_where('data_desa', ['kecamatan_id' => $id])->result();
    }


    public function dataPendidikan($tipe)
    {
        $this->db->select('tingkat_diniyah');
        $this->db->from('data_santri');
        if ($tipe != 3) {
            $this->db->where('tipe_santri', $tipe);
        }
        $this->db->group_by('tingkat_diniyah');
        return $this->db->get()->result_object();
    }


    public function dataDomisili($tipe)
    {
        $this->db->select('domisili_santri');
        $this->db->from('data_santri');
        if ($tipe != 3) {
            $this->db->where('tipe_santri', $tipe);
        }
        $this->db->group_by('domisili_santri');
        return $this->db->get()->result_object();
    }


    public function dataKabupaten($tipe)
    {
        $this->db->select('kabupaten_santri');
        $this->db->from('data_santri');
        if ($tipe != 3) {
            $this->db->where('tipe_santri', $tipe);
        }
        $this->db->group_by('kabupaten_santri');
        return $this->db->get()->result_object();
    }
}