<?php
defined('BASEPATH') or exit('No direct script access allowed');


class exportModel extends CI_Model
{
    public function dataSantriAll($tipe)
    {
        $query = "SELECT a.*, b.*, TIMESTAMPDIFF(YEAR, a.`tanggal_lahir_santri`, CURDATE()) AS umur FROM data_santri a, data_walisantri b WHERE a.`wali_santri` = b.`nik_walisantri` AND a.`tipe_santri` = '$tipe' AND a.`status_santri` = 1";
        return $this->db->query($query)->result_object();
    }

    public function dataSantriBoyong($tipe)
    {
        $periode = $this->baseModel->GetPeriode();

        $this->db->select('*')->from('data_santriboyong')->join('data_santri', 'id_santri = id_santriboyong');
        $this->db->where('tipe_santri', $tipe)->order_by('id_datasantriboyong', 'ASC');
        // $this->db->where(['tipe_santri' => $tipe, 'periode_boyong' => $periode])->order_by('id_datasantriboyong', 'ASC');
        return $this->db->get()->result_object();
    }

    public function datamutasi($tipe)
    {
        $this->db->select('*')->from('data_santri')->join('riwayat_kamar', 'id_santri = santri_id');
        $this->db->where(['tipe_santri' => $tipe, 'status_santri' => 1]);
        return $this->db->get()->result_object();
    }

    public function datapayment($tipe)
    {
        $periode = $this->baseModel->GetPeriode();

        $this->db->select('*')->from('payment')->join('data_santri', 'id_santri = santri');
        $this->db->where(['periode' => $periode, 'tipe' => $tipe])->order_by('urut', 'DESC');
        return $this->db->get()->result_object();
    }
}
