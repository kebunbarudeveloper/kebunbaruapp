<?php
defined('BASEPATH') or exit('No direct script access allowed');

class akunkeuanganModel extends CI_Model
{
    public function GetData()
    {
        $satu = $this->db->order_by('id_akunkeuangan', 'ASC')->get_where('akun_keuangan', ['tipe_akunkeuangan' => 1])->result_object();
        $dua  = $this->db->order_by('id_akunkeuangan', 'ASC')->get_where('akun_keuangan', ['tipe_akunkeuangan' => 2])->result_object();

        return [$satu, $dua];
    }


    public function GetKode($tipe)
    {
        $data = $this->db->order_by('urut_akunkeuangan', 'DESC')->get_where('akun_keuangan', ['tipe_akunkeuangan' => $tipe])->row_object();

        $awal = [1 => 'P', 'B'];

        if ($data) {
            $id = $data->id_akunkeuangan;
            $no = substr($id, 1, 2);
            $nox = (int)$no;

            $hasil = $awal[$tipe] . sprintf('%02d', $nox + 1);
        } else {
            $hasil = $awal[$tipe] . '01';
        }

        return $hasil;
    }


    public function TambahAkun()
    {
        $tipe = $this->input->post('tipeakun', true);
        $nama = $this->input->post('namaakun', true);
        $aksi = $this->input->post('tipeaksi', true);

        if ($aksi == 'tambah') {
            $kode = $this->GetKode($tipe);

            $data = [
                'urut_akunkeuangan' => '',
                'id_akunkeuangan' => $kode,
                'nama_akunkeuangan' => ucwords($nama),
                'tipe_akunkeuangan' => $tipe
            ];
            $this->db->insert('akun_keuangan', $data);

            $hasil = ['hasil' => 1];
        } elseif ($aksi == 'edit') {
            $kode = $this->input->post('idedit', true);
            $this->db->where([
                'id_akunkeuangan' => $kode,
                'tipe_akunkeuangan' => $tipe
            ])->update('akun_keuangan', ['nama_akunkeuangan' => $nama]);

            $hasil = ['hasil' => 2];
        }

        return $hasil;
    }
}