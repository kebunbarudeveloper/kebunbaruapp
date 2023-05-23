<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AturTarifModel extends CI_Model
{
    public function getpengaturan()
    {
        $periode = $this->baseModel->GetPeriode();
        $tipe = $this->session->userdata('tipe_user');
        return $this->db->get_where('tutup_pengaturan', [
            'tipe' => $tipe,
            'periode' => $periode
        ])->num_rows();
    }

    public function load()
    {
        $periode = $this->baseModel->GetPeriode();
        $tipe = $this->session->userdata('tipe_user');

        return $this->db->order_by('urut ASC, kelas ASC')->get_where('list_tarif', [
            'tipe' => $tipe, 'periode' => $periode
        ])->result_object();
    }

    public function tutuppengaturan()
    {
        $periode = $this->baseModel->GetPeriode();
        $tipe = $this->session->userdata('tipe_user');
        $cek = $this->getpengaturan();
        if ($cek <= 0) {
            $this->db->insert('tutup_pengaturan', [
                'tipe' => $tipe,
                'periode' => $periode
            ]);

            //DELETE LIST TARIF
            $this->db->where([
                'tipe' => $tipe,
                'periode' => $periode
            ])->delete('list_tarif');

            $this->setlisttarif($tipe, $periode);
            $this->setlistpengurangan($tipe, $periode);
        }
    }

    public function setlistpengurangan($tipe, $periode)
    {
        if ($tipe == 1) {
            //DELETE LIST PENGURANGAN
            $this->db->where('periode', $periode)->delete('list_diskon');

            //SELECT PENDAFTARAN MURID (P07)
            $qpendaftaranmurid = $this->db->get_where('tarif_pendaftaran', [
                'tipe' => 'LP2K', 'periode' => $periode
            ])->row_object();
            $pendaftaranmurid = $qpendaftaranmurid->nominal;
            //OPSI 1 => MUTASI DOMISILI
            $this->db->insert('list_diskon', [
                'opsi' => 1,
                'tipe' => 'LP2K',
                'kode' => $qpendaftaranmurid->kode,
                'nominal' => $pendaftaranmurid,
                'periode' => $periode
            ]);

            //SELECT INFAQ SELAIN P19
            $queryinfaq = "SELECT * FROM tarif_infaq WHERE periode = '$periode' AND kode = 'P08' OR kode = 'P11'";
            $qinfaq = $this->db->query($queryinfaq)->result_object();
            //OPSI 2 => SAUDARA SEJENIS
            $datainfaq = [];
            foreach ($qinfaq as $d) {
                $datainfaq[] = [
                    'opsi' => 2,
                    'tipe' => $d->tipe,
                    'kode' => $d->kode,
                    'nominal' => $d->nominal,
                    'periode' => $periode
                ];
            }
            $this->db->insert_batch('list_diskon', $datainfaq);

            //SELECT INFAQ P02 DAN P03
            $queryopsi3 = "SELECT * FROM tarif_infaq WHERE periode = '$periode' AND kode = 'P02' OR kode = 'P03'";
            $qopsi3 = $this->db->query($queryopsi3)->result_object();
            //OPSI 3 => SAUDARA TIDAK SEJENIS
            $dataopsi3 = [];
            foreach ($qopsi3 as $d) {
                $dataopsi3[] = [
                    'opsi' => 3,
                    'tipe' => $d->tipe,
                    'kode' => $d->kode,
                    'nominal' => $d->nominal,
                    'periode' => $periode
                ];
            }
            $this->db->insert_batch('list_diskon', $dataopsi3);

            //SELECT SERAGAM (P18)
            $qseragam = $this->db->get_where('tarif_madrasah', [
                'kode' => 'P18', 'periode' => $periode
            ])->row_object();
            //OPSI 4 => SERAGAM
            $this->db->insert('list_diskon', [
                'opsi' => 4,
                'tipe' => 'UMUM',
                'kode' => 'P18',
                'nominal' => $qseragam->nominal,
                'periode' => $periode
            ]);
        }
    }

    public function setlisttarif($tipe, $periode)
    {
        //TARIF PENDAFTARAN SANTRI
        $qpendaftaransantri = $this->db->select_sum('nominal')->from('tarif_pendaftaran')
            ->where('periode', $periode)->get()->row_object();

        //TARIF PENDAFTARAN MURID
        $qpendaftaranmurid = $this->db->get_where('tarif_pendaftaran', [
            'tipe' => 'LP2K', 'periode' => $periode
        ])->row_object();

        //TARIF INFAQ WALI SANTRI
        $qinfaqsantri = $this->db->get_where('tarif_infaq', [
            'tipe' => 'P2K', 'periode' => $periode
        ])->row_object();

        //TARIF INFAQ WALI MURID
        $qinfaqmurid = $this->db->get_where('tarif_infaq', [
            'tipe' => 'LP2K', 'periode' => $periode
        ])->row_object();

        //TARIF INFAQ UMUM
        $qinfaq = $this->db->select_sum('nominal')->from('tarif_infaq')
            ->where(['tipe' => 'UMUM', 'periode' => $periode])
            ->get()->row_object();

        //TARIF PESANTREN
        $qpesantren = $this->db->select_sum('nominal')->from('tarif_pesantren')
            ->where('periode', $periode)->get()->row_object();

        //TARIF MADRASAH
        $this->db->select('kelas, tingkat, SUM(nominal) AS total')->from('tarif_madrasah');
        $this->db->where(['tipe' => $tipe, 'periode' => $periode])->group_by(['kelas', 'tingkat']);
        $qtarifmadrasah = $this->db->get()->result_object();
        $data = [];
        foreach ($qtarifmadrasah as $d) {
            $santriBaru = $qpendaftaransantri->nominal + $qinfaqsantri->nominal + $qinfaq->nominal + $qpesantren->nominal;
            $santriLama = $qinfaqsantri->nominal + $qinfaq->nominal + $qpesantren->nominal;
            $muridBaru = $qpendaftaranmurid->nominal + $qinfaqmurid->nominal + $qinfaq->nominal;
            $muridLama = $qinfaqmurid->nominal + $qinfaq->nominal;
            $total = $d->total;
            $data[] = [
                'kelas' => $d->kelas,
                'tingkat' => $d->tingkat,
                'tipe' => $tipe,
                'santri_baru' => $total + $santriBaru,
                'santri_lama' => $total + $santriLama,
                'murid_baru' => $total + $muridBaru,
                'murid_lama' => $total + $muridLama,
                'periode' => $periode
            ];
        }
        $this->db->insert_batch('list_tarif', $data);
    }

    public function setPendaftaran()
    {
        $periode = $this->baseModel->GetPeriode();
        $kode = $this->input->post('kode', true);
        $tipe = $this->input->post('tipe', true);
        $nominal = str_replace('.', '', $this->input->post('nominal', true));

        $cek = $this->db->get_where('tarif_pendaftaran', ['periode' => $periode])->num_rows();
        if ($cek <= 0) {
            $data = [];
            foreach ($kode as $key => $value) {
                $data[] = [
                    'kode' => $kode[$key],
                    'tipe' => $tipe[$key],
                    'nominal' => $nominal[$key],
                    'periode' => $periode
                ];
            }

            $this->db->insert_batch('tarif_pendaftaran', $data);
            return $this->db->affected_rows();
        } else {
            return 400;
        }
    }

    public function setInfaq()
    {
        $periode = $this->baseModel->GetPeriode();
        $kode = $this->input->post('kode', true);
        $tipe = $this->input->post('tipe', true);
        $nominal = str_replace('.', '', $this->input->post('nominal', true));

        $cek = $this->db->get_where('tarif_infaq', ['periode' => $periode])->num_rows();
        if ($cek <= 0) {
            $data = [];
            foreach ($kode as $key => $value) {
                $data[] = [
                    'kode' => $kode[$key],
                    'tipe' => $tipe[$key],
                    'nominal' => $nominal[$key],
                    'periode' => $periode
                ];
            }

            $this->db->insert_batch('tarif_infaq', $data);
            return $this->db->affected_rows();
        } else {
            return 400;
        }
    }

    public function setPesantren()
    {
        $periode = $this->baseModel->GetPeriode();
        $kode = $this->input->post('kode', true);
        $nominal = str_replace('.', '', $this->input->post('nominal', true));

        $cek = $this->db->get_where('tarif_pesantren', ['periode' => $periode])->num_rows();
        if ($cek <= 0) {
            $data = [];
            foreach ($kode as $key => $value) {
                $data[] = [
                    'kode' => $kode[$key],
                    'nominal' => $nominal[$key],
                    'periode' => $periode
                ];
            }

            $this->db->insert_batch('tarif_pesantren', $data);
            return $this->db->affected_rows();
        } else {
            return 400;
        }
    }


    public function setmadrasah()
    {
        $tipe = $this->session->userdata('tipe_user');
        $periode = $this->baseModel->GetPeriode();
        $kelas = $this->input->post('kelas', true);
        $tingkat = $this->input->post('tingkat', true);
        $kode = $this->input->post('kode', true);
        $nominal = str_replace('.', '', $this->input->post('nominal', true));

        $cek = $this->db->get_where('tarif_madrasah', [
            'tipe' => $tipe,
            'kelas' => $kelas,
            'tingkat' => $tingkat,
            'periode' => $periode
        ])->num_rows();

        if ($cek <= 0) {
            $data = [];
            foreach ($kode as $key => $value) {
                $data[] = [
                    'kode' => $kode[$key],
                    'tipe' => $tipe,
                    'kelas' => $kelas,
                    'tingkat' => $tingkat,
                    'nominal' => $nominal[$key],
                    'periode' => $periode
                ];
            }

            $this->db->insert_batch('tarif_madrasah', $data);
            $hasil = $this->db->affected_rows();
            if ($hasil > 0) {
                $this->db->where([
                    'kelas' => $kelas,
                    'tingkat' => $tingkat,
                    'periode' => $periode,
                    'nominal' => 0,
                    'nominal' => '',
                    'tipe' => $tipe
                ])->delete('tarif_madrasah');
            }
            return $hasil;
        } else {
            return 400;
        }
    }

    public function resetdata()
    {
        $tipe = $this->session->userdata('tipe_user');
        $periode = $this->baseModel->GetPeriode();
        $kelas = $this->input->post('kelas', true);
        $tingkat = $this->input->post('tingkat', true);
        $this->db->where([
            'kelas' => $kelas,
            'tingkat' => $tingkat,
            'periode' => $periode,
            'tipe' => $tipe
        ])->delete('tarif_madrasah');
        return $this->db->affected_rows();
    }

    public function getfilterumum($table)
    {
        $periode = $this->baseModel->GetPeriode();

        $this->db->select('*')->from($table)->join('akun_keuangan', 'id_akunkeuangan = kode');
        $this->db->where('periode', $periode)->order_by('kode', 'ASC');
        return $this->db->get()->result_object();
    }

    public function getfilterpesantren()
    {
        $periode = $this->baseModel->GetPeriode();

        $this->db->select('*')->from('tarif_pesantren')->join('akun_keuangan', 'id_akunkeuangan = kode');
        $this->db->where('periode', $periode)->order_by('kode', 'ASC');
        return $this->db->get()->result_object();
    }

    public function setfiltermadrasah()
    {
        $tipe = $this->session->userdata('tipe_user');
        $periode = $this->baseModel->GetPeriode();
        $kelas = $this->input->post('kelas', true);
        $tingkat = $this->input->post('tingkat', true);

        $this->db->select('*')->from('tarif_madrasah')->join('akun_keuangan', 'id_akunkeuangan = kode');
        $this->db->where([
            'periode' => $periode,
            'tipe' => $tipe,
            'kelas' => $kelas,
            'tingkat' => $tingkat
        ])->order_by('kode', 'ASC');
        return $this->db->get()->result_object();
    }

    public function editumum()
    {
        $id = $this->input->post('idedit', true);
        $table = $this->input->post('urlaksi', true);
        $nominal = str_replace('.', '', $this->input->post('nominaledit', true));

        $this->db->where('id', $id)->update($table, ['nominal' => $nominal]);
        return $this->db->affected_rows();
    }
}
