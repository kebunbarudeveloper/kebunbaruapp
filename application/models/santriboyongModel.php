<?php
defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class santriboyongModel extends CI_Model
{
    public function getDataSantriBoyong($tipe)
    {
        $nama = $this->input->post('nama', true);
        $status = $this->input->post('status', true);
        $bulan = $this->input->post('bulan', true);
        $periode = $this->input->post('periode', true);

        $this->db->select('*')
            ->from('data_santriboyong')
            ->join('data_santri', 'id_santri = id_santriboyong')
            ->where('tipe_santriboyong', $tipe);
        if (!empty($status)) {
            $this->db->where('status_angket', $status);
        }
        if (!empty($nama)) {
            $this->db->like('nama_santri', $nama);
        }
        if (!empty($periode)) {
            $this->db->where('periode_boyong', $periode);
        }
        if (!empty($bulan)) {
            $this->db->where('SUBSTRING(tanggal_angket, 6, 2) =', $bulan);
        }
        $this->db->order_by('status_angket ASC, id_datasantriboyong DESC');
        $data = $this->db->get()->result_object();

        $this->db->select('*')
            ->from('data_santriboyong')
            ->join('data_santri', 'id_santri = id_santriboyong')
            ->where('tipe_santriboyong', $tipe);
        if (!empty($status)) {
            $this->db->where('status_angket', $status);
        }
        if (!empty($nama)) {
            $this->db->like('nama_santri', $nama);
        }
        if (!empty($bulan)) {
            $this->db->where('SUBSTRING(tanggal_angket, 6, 2) =', $bulan);
        }
        if (!empty($periode)) {
            $this->db->where('periode_boyong', $periode);
        }
        $this->db->order_by('id_datasantriboyong', 'DESC');
        $total = $this->db->get()->num_rows();

        return [$data, $total];
    }



    public function cekIDSantri($id)
    {
        return $this->db->get_where('data_santri', [
            'id_santri' => $id
        ])->row_object();
    }

    public function cekIDBoyong($id)
    {
        return $this->db->get_where('data_santriboyong', [
            'id_santriboyong' => $id,
            'status_angket' => 0
        ])->row_object();
    }


    public function setNomor($periode)
    {
        $cek = $this->db->order_by('id_datasantriboyong', 'DESC')->get_where('data_santriboyong', ['periode_boyong' => $periode])->row_object();
        if ($cek) {
            $nomor = $cek->urut_datasantriboyong;
            $hasil = $nomor + 1;
        } else {
            $hasil = 1;
        }

        return $hasil;
    }


    public function getSantri($id)
    {
        $this->db->select('*')
            ->from('data_santri')
            ->join('data_walisantri', 'nik_walisantri = wali_santri')
            ->where('id_santri', $id);
        return $this->db->get()->row_object();
    }


    public function setNomorSurat($nomor, $tanggal)
    {
        $pecah = explode('-', $tanggal);
        $bulan = (int)$pecah[1];
        $romawi = [1 => 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VII', 'IX', 'X', 'XI', 'XII'];

        return sprintf('%03d', $nomor) . '/SAB.P2K/' . $romawi[$bulan] . '/' . $pecah[0];
    }

    public function setNomorSuratBoyong($tanggal)
    {
        $periode = $this->baseModel->GetPeriode();
        $pecah = explode('-', $tanggal);
        $bulan = (int)$pecah[1];
        $romawi = [1 => 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VII', 'IX', 'X', 'XI', 'XII'];

        //Cek table set_surat
        $data = $this->db->get_where('set_surat', ['periode' => $periode])->num_rows();
        if ($data <= 0) {
            $this->db->truncate('set_surat');
        }
        //Insert to table set_surat
        $this->db->insert('set_surat', ['periode' => $periode]);

        //Get data set_surat
        $getData = $this->db->order_by('id', 'DESC')->get_where('set_surat')->row_object();
        $surat = $getData->id;

        return sprintf('%03d', $surat) . '/SKB.P2K/' . $romawi[$bulan] . '/' . $pecah[0];
    }


    public function tambahBoyong($id)
    {
        $periode = $this->baseModel->GetPeriode();
        $nomor = $this->setNomor($periode);
        $dataSantri = $this->getSantri($id);
        $tanggal = $this->baseModel->GetHijriSekarang();
        $surat = $this->setNomorSurat($nomor, $tanggal);


        if ($dataSantri) {
            $data = [
                'urut_datasantriboyong' => $nomor,
                'nomor_surat' => $surat,
                'id_santriboyong' => $dataSantri->id_santri,
                'tipe_santriboyong' => $dataSantri->tipe_santri,
                'periode_boyong' => $periode,
                'tanggal_angket' => $tanggal,
                'tanggal_boyong' => 0,
                'status_wali' => 1,
                'nama_wali' => $dataSantri->nama_walisantri,
                'desa_wali' => $dataSantri->desa_walisantri,
                'kec_wali' => $dataSantri->kecamatan_walisantri,
                'kab_wali' => $dataSantri->kabupaten_walisantri,
                'pro_wali' => $dataSantri->provinsi_walisantri,
                'pos_wali' => $dataSantri->kode_pos_walisantri,
                'pekerjaan_wali' => $dataSantri->pekerjaan_walisantri,
                'status_angket' => 0
            ];

            $this->db->insert('data_santriboyong', $data);

            //AMBIL TERAKHIR
            $getakhir = $this->db->order_by('id_datasantriboyong', 'DESC')->get_where('data_santriboyong', [
                'periode_boyong' => $periode, 'tipe_santriboyong' => $dataSantri->tipe_santri
            ])->row_object();
            $hasil = $getakhir->id_datasantriboyong;
        } else {
            $hasil = 'gagal';
        }

        return $hasil;
    }


    public function getDataBoyong($id)
    {
        $this->db->select('*')
            ->from('data_santriboyong')
            ->join('data_santri', 'id_santri = id_santriboyong')
            ->where('id_datasantriboyong', $id);
        return $this->db->get()->row_object();
    }


    public function batalkanProses($id)
    {
        $this->db->where('id_datasantriboyong', $id)->delete('data_santriboyong');
    }


    public function ubahDataWali()
    {
        $id = $this->input->post('idsantriboyong', true);
        $periode = $this->baseModel->GetPeriode();
        $data = [
            'status_wali' => 2,
            'nama_wali' => strtoupper($this->input->post('namawakilwali', true)),
            'desa_wali' => $this->input->post('desawakilwali', true),
            'kec_wali' => $this->input->post('kecwakilwali', true),
            'kab_wali' => $this->input->post('kabwakilwali', true),
            'pro_wali' => $this->input->post('prowakilwali', true),
            'pos_wali' => $this->input->post('poswakilwali', true),
            'pekerjaan_wali' => $this->input->post('pekerjaanwakilwali', true)
        ];
        $this->db->where([
            'id_datasantriboyong' => $id,
            'periode_boyong' => $periode
        ])->update('data_santriboyong', $data);
        return $this->db->affected_rows();
    }


    public function simpanBoyong($id, $alasan)
    {
        $this->db->where('id_datasantriboyong', $id)->update('data_santriboyong', ['alasan_boyong' => ucfirst($alasan)]);
        return $this->db->affected_rows();
    }



    public function updateDataSantri($id)
    {
        $this->db->where('id_santri', $id)->update('data_santri', ['status_santri' => 0]);
    }

    public function getiddatasantriboyong($id)
    {
        return $this->db->get_where('data_santriboyong', ['id_datasantriboyong' => $id])->row_object();
    }


    public function selesaikanProses($id)
    {
        $tanggal = $this->baseModel->GetHijriSekarang();
        $surat = $this->setNomorSuratBoyong($tanggal);

        $get = $this->getiddatasantriboyong($id);
        $idSantri = $get->id_santriboyong;
        $this->updateDataSantri($idSantri);

        $this->db->where('id_datasantriboyong', $id)->update('data_santriboyong', [
            'surat_boyong' => $surat,
            'status_angket' => 1,
            'tanggal_boyong' => $tanggal
        ]);
        return $this->db->affected_rows();
    }


    public function getNamaPengurus($induk)
    {
        $data = $this->db->get_where('data_pengurus', ['induk_pengurus' => $induk])->row_object();
        if ($data) {
            $hasil = $data->nama_pengurus;
        } else {
            $hasil = 'TIDAK ADA';
        }

        return $hasil;
    }


    public function getKepalaPendidikan($periode, $tipe, $madrasah)
    {
        $data = $this->db->get_where('jabatan_pengurus', [
            'jabatan_jabatanpengurus' => 26,
            'bagian_jabatanpengurus' => $tipe,
            'instansi_jabatanpengurus' => $madrasah,
            'periode_jabatanpengurus' => $periode,
            'status_jabatanpengurus' => 1
        ])->row_object();
        if ($data) {
            $id = $data->induk_jabatanpengurus;
            $hasil = $this->getNamaPengurus($id);
        } else {
            $hasil = 'TIDAK ADA';
        }

        return $hasil;
    }


    public function getKetua($periode, $tipe, $jabatan)
    {
        if ($jabatan == 20) {
            $tipex = $tipe;
        } else {
            $tipex = 3;
        }

        $data = $this->db->get_where('jabatan_pengurus', [
            'jabatan_jabatanpengurus' => $jabatan,
            'bagian_jabatanpengurus' => $tipex,
            'periode_jabatanpengurus' => $periode,
            'status_jabatanpengurus' => 1
        ])->row_object();
        if ($data) {
            $id = $data->induk_jabatanpengurus;
            $hasil = $this->getNamaPengurus($id);
        } else {
            $hasil = 'TIDAK ADA';
        }

        return $hasil;
    }
}
