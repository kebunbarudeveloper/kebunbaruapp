<?php
defined('BASEPATH') or exit('No direct script access allowed');


class pengaturanModel extends CI_Model
{
    private $_batchImport;

    public function AturPeriode()
    {
        $periode = $this->input->post('tahunperiode', true);
        $cek = $this->CekPeriode($periode);

        if ($cek > 0) {
            $hasil = 0;
        } else {
            $this->db->empty_table('periode');
            $this->db->insert('periode', ['tahun_periode' => $periode]);

            //Nambah ke tabel list periode
            $this->db->insert('list_periode', ['list_periode' => $periode]);

            //Set induk terakhir periode sebelumnya
            $this->GetIndukAkhir();
            $hasil = 1;
        }

        return $hasil;
    }


    public function GetIndukAkhir()
    {
        $datal = $this->db->order_by('urut_santri', 'DESC')->get_where('data_santri', ['tipe_santri' => 1])->row_object();
        $datap = $this->db->order_by('urut_santri', 'DESC')->get_where('data_santri', ['tipe_santri' => 2])->row_object();

        $laki = $datal->urut_santri;
        $pr   = $datap->urut_santri;
        $data = [
            'indukakhir_putra' => $laki,
            'indukakhir_putri' => $pr
        ];

        $this->db->empty_table('data_indukakhir');

        $this->db->insert('data_indukakhir', $data);
    }


    public function CekPeriode($periode)
    {
        return $this->db->get_where('list_periode', ['list_periode' => $periode])->num_rows();
    }


    public function setBatchImport($batchImport)
    {
        $this->_batchImport = $batchImport;
    }

    // save data
    public function importData()
    {
        $data = $this->_batchImport;
        $this->db->insert_batch('kalender', $data);
    }
}