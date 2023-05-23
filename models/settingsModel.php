<?php
defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class settingsModel extends CI_Model
{
    public function setoran()
    {
        $data = $this->db->get('list_setoran')->result_object();
        $last = $this->db->order_by('id', 'DESC')->get_where('list_setoran', ['status' => 1])->row_object();

        return [$data, $last];
    }

    public function setsetoran()
    {
        $setoran = $this->input->post('setoran', true);
        $batas = $this->input->post('batas', true);
        $periode = $this->baseModel->GetPeriode();

        $stringDate = strtotime($batas);
        $newBatas = date('Y-m-d', $stringDate);

        $last = $this->db->order_by('id', 'DESC')->get_where('list_setoran', ['status' => 1])->row_object();
        if ($last) {
            $lastx = $last->list;
            $new = $setoran - $lastx;
            if ($setoran <= $lastx) {
                $result = ['hasil' => 0, 'pesan' => 'Anda memilih setoran yang sudah disetting sebelumnya'];
            } elseif ($new > 1) {
                $result = ['hasil' => 0, 'pesan' => 'Setoran yang Anda masukka tidak valid'];
            } else {
                //Insert data to tabel setoran
                $id = mt_rand(111111, 999999);
                $data = [
                    'id' => $id,
                    'part' => $setoran,
                    'periode' => $periode,
                    'batas' => $newBatas
                ];

                //Cek exist or no
                $cekSetoran = $this->db->get_where('setoran', ['part' => $setoran, 'periode' => $periode])->num_rows();
                if ($cekSetoran <= 0) {
                    $this->db->insert('setoran', $data);
                } else {
                    $this->db->where(['part' => $setoran, 'periode' => $periode])->update('setoran', ['batas' => $newBatas]);
                }

                //Update list setoran
                $this->db->where('list', $setoran)->update('list_setoran', ['status' => 1, 'batas' => $newBatas]);
                $cek = $this->db->affected_rows();
                if ($cek > 0) {
                    $result = ['hasil' => 200, 'pesan' => 'Setoran berhasil disetting'];
                } else {
                    $result = ['hasil' => 0, 'pesan' => 'Kesalahan server'];
                }
            }
        } else {
            //Insert data to tabel setoran
            $id = mt_rand(111111, 999999);
            $data = [
                'id' => $id,
                'part' => $setoran,
                'periode' => $periode,
                'batas' => $newBatas
            ];
            $cekSetoran = $this->db->get_where('setoran', ['part' => $setoran, 'periode' => $periode])->num_rows();
            if ($cekSetoran <= 0) {
                $this->db->insert('setoran', $data);
            } else {
                $this->db->where(['part' => $setoran, 'periode' => $periode])->update('setoran', ['batas' => $newBatas]);
            }

            //Update list setoran
            $this->db->where('list', $setoran)->update('list_setoran', ['status' => 1, 'batas' => $newBatas]);
            $cek1 = $this->db->affected_rows();
            if ($cek1 > 0) {
                $result = ['hasil' => 200, 'pesan' => 'Setoran berhasil disetting'];
            } else {
                $result = ['hasil' => 0, 'pesan' => 'Kesalahan server'];
            }
        }

        return $result;
    }

    public function resetsetoran()
    {
        $this->db->update('list_setoran', ['status' => 0]);
        if ($this->db->affected_rows() > 0) {
            return 200;
        } else {
            return 0;
        }
    }
}
