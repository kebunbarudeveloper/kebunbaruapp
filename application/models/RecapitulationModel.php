<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RecapitulationModel extends CI_Model
{
    public function loadfooter()
    {
        $periode = $this->baseModel->GetPeriode();
        $bulan = $this->input->post('bulan', true);
        $tipe = $this->session->userdata('tipe_user');

        //UMUM
        $this->db->select('SUM(nominal) AS total')->from('payment_detail');
        $this->db->where(['tipe' => $tipe, 'periode' => $periode, 'instansi' => 'Umum']);
        if (!empty($bulan)) {
            $this->db->where('SUBSTRING(tanggal, 6, 2) =', $bulan);
        }
        $qumum = $this->db->get()->row_object();

        //PESANTREN
        $this->db->select('SUM(nominal) AS total')->from('payment_detail');
        $this->db->where(['tipe' => $tipe, 'periode' => $periode, 'instansi' => 'Kabid I']);
        if (!empty($bulan)) {
            $this->db->where('SUBSTRING(tanggal, 6, 2) =', $bulan);
        }
        $qpesantren = $this->db->get()->row_object();

        //KABID IV
        $this->db->select('SUM(nominal) AS total')->from('payment_detail');
        $this->db->where(['tipe' => $tipe, 'periode' => $periode, 'instansi' => 'Kabid IV']);
        if (!empty($bulan)) {
            $this->db->where('SUBSTRING(tanggal, 6, 2) =', $bulan);
        }
        $qKabid4 = $this->db->get()->row_object();

        //KABID V
        $this->db->select('SUM(nominal) AS total')->from('payment_detail');
        $this->db->where(['tipe' => $tipe, 'periode' => $periode, 'instansi' => 'Kabid V']);
        if (!empty($bulan)) {
            $this->db->where('SUBSTRING(tanggal, 6, 2) =', $bulan);
        }
        $qKabid5 = $this->db->get()->row_object();

        //MADRASAH
        $this->db->select('SUM(nominal) AS total')->from('payment_detail');
        $this->db->where(['tipe' => $tipe, 'periode' => $periode]);
        $this->db->where_not_in('instansi', ['Umum', 'Pesantren']);
        if (!empty($bulan)) {
            $this->db->where('SUBSTRING(tanggal, 6, 2) =', $bulan);
        }
        $qmadrasah = $this->db->get()->row_object();

        $umum = $qumum->total;
        $pesantren = $qpesantren->total;
        $pembangunan = $qKabid4->total;
        $humas = $qKabid5->total;
        $madrasah = $qmadrasah->total;
        $total = $umum + $pesantren + $madrasah;

        return [$umum, $pesantren, $pembangunan, $humas, $madrasah, $total];
    }

    public function loadall()
    {
        $periode = $this->baseModel->GetPeriode();
        $bulan = $this->input->post('bulan', true);
        $tipe = $this->session->userdata('tipe_user');

        //UMUM
        $this->db->select('nama_akunkeuangan, COUNT(kode) AS qty, SUM(nominal) AS total')->from('payment_detail');
        $this->db->join('akun_keuangan', 'kode = id_akunkeuangan');
        $this->db->where(['tipe' => $tipe, 'periode' => $periode, 'instansi' => 'Umum']);
        if (!empty($bulan)) {
            $this->db->where('SUBSTRING(tanggal, 6, 2) =', $bulan);
        }
        $this->db->group_by('kode')->order_by('kode', 'ASC');
        $qumum = $this->db->get()->result_object();

        //PESANTREN
        $this->db->select('nama_akunkeuangan, COUNT(kode) AS qty, SUM(nominal) AS total')->from('payment_detail');
        $this->db->join('akun_keuangan', 'kode = id_akunkeuangan');
        $this->db->where(['tipe' => $tipe, 'periode' => $periode, 'instansi' => 'Kabid I']);
        if (!empty($bulan)) {
            $this->db->where('SUBSTRING(tanggal, 6, 2) =', $bulan);
        }
        $this->db->group_by('kode')->order_by('kode', 'ASC');
        $qpesantren = $this->db->get()->result_object();

        //PEMBANGUNAN
        $this->db->select('nama_akunkeuangan, COUNT(kode) AS qty, SUM(nominal) AS total')->from('payment_detail');
        $this->db->join('akun_keuangan', 'kode = id_akunkeuangan');
        $this->db->where(['tipe' => $tipe, 'periode' => $periode, 'instansi' => 'Kabid IV']);
        if (!empty($bulan)) {
            $this->db->where('SUBSTRING(tanggal, 6, 2) =', $bulan);
        }
        $this->db->group_by('kode')->order_by('kode', 'ASC');
        $qpembangunan = $this->db->get()->result_object();

        //HUMAS
        $this->db->select('nama_akunkeuangan, COUNT(kode) AS qty, SUM(nominal) AS total')->from('payment_detail');
        $this->db->join('akun_keuangan', 'kode = id_akunkeuangan');
        $this->db->where(['tipe' => $tipe, 'periode' => $periode, 'instansi' => 'Kabid V']);
        if (!empty($bulan)) {
            $this->db->where('SUBSTRING(tanggal, 6, 2) =', $bulan);
        }
        $this->db->group_by('kode')->order_by('kode', 'ASC');
        $qhumas = $this->db->get()->result_object();

        //MADRASAH
        $this->db->select('nama_akunkeuangan, COUNT(kode) AS qty, SUM(nominal) AS total')->from('payment_detail');
        $this->db->join('akun_keuangan', 'kode = id_akunkeuangan');
        $this->db->where(['tipe' => $tipe, 'periode' => $periode]);
        $this->db->where_not_in('instansi', ['Umum', 'Kabid I', 'Kabid IV', 'Kabid V']);
        if (!empty($bulan)) {
            $this->db->where('SUBSTRING(tanggal, 6, 2) =', $bulan);
        }
        $this->db->group_by('kode')->order_by('kode', 'ASC');
        $qmadrasah = $this->db->get()->result_object();

        //KESIMPULAN UMUM
        $this->db->select('COUNT(DISTINCT payment_id) AS transaksi, COUNT(kode) AS item, SUM(nominal) AS total');
        $this->db->from('payment_detail');
        $this->db->where(['tipe' => $tipe, 'periode' => $periode, 'instansi' => 'Umum']);
        if (!empty($bulan)) {
            $this->db->where('SUBSTRING(tanggal, 6, 2) =', $bulan);
        }
        $qkesimpulanumum = $this->db->get()->row_object();

        //KESIMPULAN PESANTREN
        $this->db->select('COUNT(DISTINCT payment_id) AS transaksi, COUNT(kode) AS item, SUM(nominal) AS total');
        $this->db->from('payment_detail');
        $this->db->where(['tipe' => $tipe, 'periode' => $periode, 'instansi' => 'Kabid I']);
        if (!empty($bulan)) {
            $this->db->where('SUBSTRING(tanggal, 6, 2) =', $bulan);
        }
        $qkesimpulanpesantren = $this->db->get()->row_object();

        //KESIMPULAN PEMBANGUNAN
        $this->db->select('COUNT(DISTINCT payment_id) AS transaksi, COUNT(kode) AS item, SUM(nominal) AS total');
        $this->db->from('payment_detail');
        $this->db->where(['tipe' => $tipe, 'periode' => $periode, 'instansi' => 'Kabid IV']);
        if (!empty($bulan)) {
            $this->db->where('SUBSTRING(tanggal, 6, 2) =', $bulan);
        }
        $qkesimpulanpembangunan = $this->db->get()->row_object();

        //KESIMPULAN HUMAS
        $this->db->select('COUNT(DISTINCT payment_id) AS transaksi, COUNT(kode) AS item, SUM(nominal) AS total');
        $this->db->from('payment_detail');
        $this->db->where(['tipe' => $tipe, 'periode' => $periode, 'instansi' => 'Kabid V']);
        if (!empty($bulan)) {
            $this->db->where('SUBSTRING(tanggal, 6, 2) =', $bulan);
        }
        $qkesimpulanhumas = $this->db->get()->row_object();

        //KESIMPULAN MADRASAH
        $this->db->select('COUNT(DISTINCT payment_id) AS transaksi, COUNT(kode) AS item, SUM(nominal) AS total');
        $this->db->from('payment_detail');
        $this->db->where(['tipe' => $tipe, 'periode' => $periode]);
        $this->db->where_not_in('instansi', ['Umum', 'Kabid I', 'Kabid IV', 'Kabid V']);
        if (!empty($bulan)) {
            $this->db->where('SUBSTRING(tanggal, 6, 2) =', $bulan);
        }
        $qkesimpulanmadrasah = $this->db->get()->row_object();

        return [
            $qumum,
            $qpesantren,
            $qpembangunan,
            $qhumas,
            $qmadrasah,
            $qkesimpulanumum,
            $qkesimpulanpesantren,
            $qkesimpulanpembangunan,
            $qkesimpulanhumas,
            $qkesimpulanmadrasah
        ];
    }

    public function laporan($instansi)
    {
        $tipe = $this->session->userdata('tipe_user');
        $periode = $this->baseModel->GetPeriode();
        $bulan = $this->getdate();

        $this->db->select('nama_akunkeuangan, SUM(nominal) AS total')->from('payment_detail');
        $this->db->join('akun_keuangan', 'id_akunkeuangan = kode');
        $this->db->where([
            'periode' => $periode,
            'tipe' => $tipe,
            'instansi' => $instansi
        ]);
        if ($bulan != 0) {
            $this->db->where('SUBSTRING(tanggal, 6, 2) =', $bulan);
        }
        $data = $this->db->group_by('kode')->order_by('kode', 'ASC')->get()->result_object();
        $result = [];
        if ($data) {
            foreach ($data as $d) {
                $result[] = [
                    'kode' => $d->nama_akunkeuangan,
                    'nominal' => $d->total
                ];
            }
        } else {
            $result = 0;
        }

        $this->db->select_sum('nominal')->from('payment_detail');
        if ($bulan != 0) {
            $this->db->where('SUBSTRING(tanggal, 6, 2) =', $bulan);
        }
        $total = $this->db->where([
            'periode' => $periode,
            'tipe' => $tipe,
            'instansi' => $instansi
        ])->get()->row_object();

        return [
            $result,
            $total->nominal
        ];
    }

    public function kesimpulan()
    {
        $tipe = $this->session->userdata('tipe_user');
        $periode = $this->baseModel->GetPeriode();
        $bulan = $this->getdate();
        $this->db->select('SUM(nominal) AS total, instansi')->from('payment_detail');
        if ($bulan != 0) {
            $this->db->where('SUBSTRING(tanggal, 6, 2) =', $bulan);
        }
        $kesimpulan = $this->db->where([
            'periode' => $periode,
            'tipe' => $tipe
        ])->group_by('instansi')->get()->result_object();

        $this->db->select('SUM(nominal) AS total')->from('payment_detail');
        if ($bulan != 0) {
            $this->db->where('SUBSTRING(tanggal, 6, 2) =', $bulan);
        }
        $tot = $this->db->where([
            'periode' => $periode,
            'tipe' => $tipe
        ])->get()->row_object();

        return [$kesimpulan, $tot];
    }

    public function setdate()
    {
        $tipe = $this->session->userdata('tipe_user');
        $this->db->where('tipe', $tipe)->delete('bulan_laporan');

        $bulan = $this->input->post('bulan', true);
        if ($bulan != '') {
            $bulan = $bulan;
        } else {
            $bulan = 0;
        }

        $this->db->insert('bulan_laporan', [
            'tipe' => $tipe,
            'bulan' => $bulan
        ]);
    }

    public function getdate()
    {
        $tipe = $this->session->userdata('tipe_user');
        $data = $this->db->get_where('bulan_laporan', ['tipe' => $tipe])->row_object();

        if ($data) {
            return $data->bulan;
        } else {
            return 0;
        }
    }
}
