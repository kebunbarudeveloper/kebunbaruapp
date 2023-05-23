<?php
defined('BASEPATH') or exit('No direct script access allowed');


class datasantribaruModel extends CI_Model
{

    public function DataPendidikan($periode)
    {
        $tipe = $this->session->userdata('tipe_user');
        $query = "SELECT tingkat_diniyah FROM data_santri WHERE tipe_santri = '$tipe' AND periode_masuk = '$periode' GROUP BY tingkat_diniyah";
        return $this->db->query($query)->result_object();
    }



    public function getRows($params = array())
    {
        $periode = $this->baseModel->GetPeriode();
        $tipe = $this->session->userdata('tipe_user');

        $this->db->select('*');
        $this->db->from('data_santri');
        $this->db->join('data_walisantri', 'nik_walisantri = wali_santri');
        $this->db->where(['tipe_santri' => $tipe, 'periode_masuk' => $periode]);


        if (array_key_exists("where", $params)) {
            foreach ($params['where'] as $key => $val) {
                $this->db->where($key, $val);
            }
        }

        if (array_key_exists("search", $params)) {
            // Filter data by searched keywords 
            if (!empty($params['search']['keywords'])) {
                $this->db->like('nama_santri', $params['search']['keywords']);
            }
        }

        // Sort data by ascending or desceding order 

        $this->db->order_by('urut_santri', 'ASC');


        if (array_key_exists("returnType", $params) && $params['returnType'] == 'count') {
            $result = $this->db->count_all_results();
        } else {
            if (array_key_exists("urut_santri", $params) || (array_key_exists("returnType", $params) && $params['returnType'] == 'single')) {
                if (!empty($params['urut_santri'])) {
                    $this->db->where('urut_santri', $params['urut_santri']);
                }
                $query = $this->db->get();
                $result = $query->row_array();
            } else {
                $this->db->order_by('urut_santri', 'desc');
                if (array_key_exists("start", $params) && array_key_exists("limit", $params)) {
                    $this->db->limit($params['limit'], $params['start']);
                } elseif (!array_key_exists("start", $params) && array_key_exists("limit", $params)) {
                    $this->db->limit($params['limit']);
                }

                $query = $this->db->get();
                $result = ($query->num_rows() > 0) ? $query->result_array() : FALSE;
            }
        }

        // Return fetched data 
        return $result;
    }


    public function GetDetailSantri($id, $tipe)
    {
        $this->db->select('*')
            ->from('data_santri')
            ->join('data_walisantri', 'nik_walisantri = wali_santri')
            ->where(['id_santri' => $id, 'tipe_santri' => $tipe]);
        return $this->db->get()->row_object();
    }
}