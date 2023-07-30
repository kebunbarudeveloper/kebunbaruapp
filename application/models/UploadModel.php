<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UploadModel extends CI_Model
{
    public function getdata()
    {
        $this->db->select('*')->from('foto_santri')->join('data_santri', 'id_santri = santri_id');
        return $this->db->get()->result_object();
    }

    public function cekdata($id)
    {
        $tipeUser = $this->session->userdata('tipe_user');
        $cek = $this->db->get_where('data_santri', [
            'id_santri' => $id
        ])->row_object();
        if (!$cek) {
            return [
                'status' => 500, 'message' => 'Data tidak ditemukan'
            ];
        }
        $status = $cek->status_santri;
        $tipe = $cek->tipe_santri;
        if ($status != 1) {
            return [
                'status' => 500, 'message' => 'Santri sudah tidak aktif'
            ];
        }

        if ($tipe != $tipeUser) {
            return [
                'status' => 500, 'message' => 'Akses anda dicegah'
            ];
        }

        $cekfoto = $this->db->get_where('foto_santri', ['santri_id' => $id])->num_rows();
        if ($cekfoto > 0) {
            return [
                'status' => 500, 'message' => 'Foto sudah diupload sebelumnya'
            ];
        }

        $query = "SELECT a.nama_santri, a.domisili_santri, a.nomor_kamar_santri, a.status_domisili_santri, a.desa_santri, a.kabupaten_santri, b.nama_walisantri, b.nomor_hp_walisantri FROM data_santri a, data_walisantri b WHERE a.wali_santri = b.nik_walisantri AND a.id_santri = '$id'";
        $data = $this->db->query($query)->row_object();
        if (!$data) {
            return [
                'status' => 500, 'message' => 'Ada kesalahan saat mengambil data'
            ];
        }

        return [
            'status' => 200,
            'message' => 'Data berhasil ditemukan',
            'nama' => $data->nama_santri,
            'domisili' => $data->status_domisili_santri . ', ' . $data->domisili_santri . ' - ' . $data->nomor_kamar_santri,
            'desa' => $data->desa_santri,
            'kabupaten' => str_replace(['Kabupaten', 'Kota '], '', $data->kabupaten_santri),
            'wali' => $data->nama_walisantri,
            'nomor' => $data->nomor_hp_walisantri
        ];
    }

    public function simpan($id)
    {
        $this->db->insert('foto_santri', [
            'santri_id' => $id, 'status' => 0
        ]);
        if ($this->db->affected_rows() > 0) {
            return ['status' => 200];
        } else {
            return ['status' => 500];
        }
    }

    public function hapus($id)
    {
        $this->db->where('santri_id', $id)->delete('foto_santri');
        if ($this->db->affected_rows() > 0) {
            return ['status' => 200];
        } else {
            return ['status' => 500];
        }
    }
}
