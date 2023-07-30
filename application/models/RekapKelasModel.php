<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RekapKelasModel extends CI_Model
{
    public function setData()
    {
        $tipe = $this->session->userdata('tipe_user');
        $this->db->where('tipe', $tipe)->delete('rekap_kelas');

        $periode = $this->baseModel->GetPeriode();
        $this->db->select('id_santri, nama_santri, desa_santri, kabupaten_santri, status_domisili_santri, domisili_santri, nomor_kamar_santri, kelas_diniyah, tingkat_diniyah')->from('data_santri');
        $this->db->where([
            'kelas_diniyah !=' => 'Lulus', 'tingkat_diniyah !=' => 'RA',
            'status_santri' => 1, 'tipe_santri' => $tipe
        ]);
        $data = $this->db->get()->result_object();
        if ($data) {
            $datainsert = [];
            foreach ($data as $d) {
                $idSantri = $d->id_santri;
                $tingkat = $d->tingkat_diniyah;
                if ($tingkat == 'I\'dadiyah') {
                    $x = 0;
                } elseif ($tingkat == 'Ibtidaiyah') {
                    $x = 1;
                } elseif ($tingkat == 'Tsanawiyah') {
                    $x = 2;
                } elseif ($tingkat == 'Aliyah') {
                    $x = 3;
                }

                $check = $this->db->order_by('id', 'DESC')->get_where('payment', [
                    'santri' => $idSantri, 'periode' => $periode
                ])->row_object();
                if ($check) {
                    $tagihan = $check->tagihan;
                    $nominal = $check->nominal;
                    $status = $check->status;
                } else {
                    $tagihan = 0;
                    $nominal = 0;
                    $status = 'BELUM BAYAR';
                }
                $datainsert[] = [
                    'santri_id' => $idSantri,
                    'tipe' => $tipe,
                    'nama' => $d->nama_santri,
                    'desa' => $d->desa_santri,
                    'kab' => str_replace(['Kabupaten', 'Kota '], '', $d->kabupaten_santri),
                    'status_dom' => $d->status_domisili_santri,
                    'dom' => $d->domisili_santri,
                    'kamar' => $d->nomor_kamar_santri,
                    'kelas' => $d->kelas_diniyah,
                    'tingkat' => $x,
                    'tagihan' => $tagihan,
                    'nominal' => $nominal,
                    'status' => $status
                ];
            }
            $this->db->insert_batch('rekap_kelas', $datainsert);
        }
    }


    public function loaddata()
    {
        $tingkat = $this->input->post('tingkat', true);
        $kelas = $this->input->post('kelas', true);
        $status = $this->input->post('status', true);
        $tipe = $this->session->userdata('tipe_user');

        $this->db->select('*')->from('rekap_kelas');
        $this->db->where('tipe', $tipe);
        if ($tingkat != '') {
            $this->db->where('tingkat', $tingkat);
        }
        if ($kelas != '') {
            $this->db->where('kelas', $kelas);
        }
        if ($status != '') {
            $this->db->where('status', $status);
        }
        return $this->db->order_by('tingkat ASC, kelas ASC')->get()->result_object();
    }
}
