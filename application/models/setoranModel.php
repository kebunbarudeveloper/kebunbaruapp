<?php
defined('BASEPATH') or exit('No direct script access allowed');

class setoranModel extends CI_Model
{
    public function getsetoran()
    {
        $periode = $this->baseModel->GetPeriode();
        $resultList = $this->db->order_by('list', 'DESC')->limit(1)->get_where('list_setoran', ['status' => 1])->row_object();
        if ($resultList) {
            $list = $resultList->list;
            $data = $this->db->get_where('setoran', ['part' => $list, 'periode' => $periode])->row_object();

            $hasil = 200;
            $part = $data->part;
            $code = $data->id;
            $batas = $data->batas;
        } else {
            $hasil = 0;
            $part = 0;
            $code = 0;
            $batas = 0;
        }

        return [
            'hasil' => $hasil,
            'data' => [
                'id' => $code,
                'part' => $part,
                'batas' => $batas
            ]
        ];
    }

    public function getid()
    {
        $id = $this->input->post('id', true);
        return $this->db->get_where('data_santri', ['id_santri' => $id])->row_object();
    }

    public function cekid($id)
    {
        $user = $this->session->userdata('tipe_user');
        if ($id != '') {
            $data = $this->db->get_where('data_santri', ['id_santri' => $id, 'status_santri' => 1, 'tipe_santri' => $user])->row_object();
            if ($data) {
                $result = ['result' => 200, 'message' => $id];
            } else {
                $result = ['result' => 0, 'message' => 'ID Santri tidak ditemukan'];
            }
        } else {
            $result = ['result' => 0, 'message' => 'Pastikan ID Santri sudah terisi'];
        }

        return $result;
    }
}
