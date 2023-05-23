<?php
defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class jabatanumumModel extends CI_Model
{
    private $_client;

    public function __construct()
    {
        parent::__construct();
        $this->_client = new Client([
            'base_uri' => getURLAPI()
        ]);
    }


    public function getKategoriJabatan()
    {
        // return $this->db->get('kategori_pengguna')->result_object();
        try {
            $response = $this->_client->request('GET', 'aturjabatan/getKategoriUmum', [
                'query' => [
                    'KEBUNBARU-KEY' => 'f7f3d294cb068555257017c1dfb0f2'
                ]
            ]);

            $hasil = json_decode($response->getBody()->getContents(), false);
            return $hasil->data;
        } catch (ClientException $e) {
            return '';
        }
    }


    public function getDataJabatan()
    {
        $periode = $this->baseModel->GetPeriode();
        $query = "SELECT a.`nama_jabatan`, b.`nama_kategori`, c.`induk_pengurus`, c.`nama_pengurus`, d.`id_jabatanpengurus`, d.`bagian_jabatanpengurus`
        FROM data_jabatan a, data_kategori b, data_pengurus c, jabatan_pengurus d
        WHERE a.`id_jabatan` = d.`jabatan_jabatanpengurus` AND b.`id_kategori` = d.`kategori_jabatanpengurus`
        AND c.`induk_pengurus` = d.`induk_jabatanpengurus` AND a.`akses_jabatan` = 1 AND d.`periode_jabatanpengurus` = '$periode' AND d.`status_jabatanpengurus` = 1 ORDER BY d.`kategori_jabatanpengurus` ASC";
        return $this->db->query($query)->result_object();
    }



    public function getJabatan($id)
    {
        $periode = $this->baseModel->GetPeriode();
        if ($id == 5) {

            $akses = $this->input->post('akses', true);

            $query = "SELECT * FROM data_jabatan WHERE kategori_jabatan = '$id' AND akses_jabatan = 1
            AND id_jabatan NOT IN(SELECT jabatan_jabatanpengurus FROM jabatan_pengurus WHERE periode_jabatanpengurus = '$periode'
            AND status_jabatanpengurus = 1 AND bagian_jabatanpengurus = '$akses') ORDER BY urut_jabatan ASC";
        } else {
            $query = "SELECT * FROM data_jabatan WHERE kategori_jabatan = '$id' AND akses_jabatan = 1
            AND id_jabatan NOT IN(SELECT jabatan_jabatanpengurus FROM jabatan_pengurus WHERE periode_jabatanpengurus = '$periode'
            AND status_jabatanpengurus = 1) ORDER BY urut_jabatan ASC";
        }

        return $this->db->query($query)->result_object();
    }


    public function getDetailJabatan($id)
    {
        $this->db->select('*')
            ->from('jabatan_pengurus')
            ->join('data_pengurus', 'induk_pengurus = induk_jabatanpengurus')
            ->where('id_jabatanpengurus', $id);
        return $this->db->get()->row_object();
    }


    public function GetPengurus($title)
    {
        $this->db->select('induk_pengurus, nama_pengurus')
            ->from('data_pengurus')
            ->where('status_pengurus', 1)
            ->like('nama_pengurus', $title, 'both')
            ->order_by('id_pengurus', 'ASC')
            ->limit(10);
        return $this->db->get()->result();
    }


    public function tambahJabatanUmum()
    {
        $periode = $this->baseModel->GetPeriode();
        $kategori = $this->input->post('idkategori', true);
        $jabatan = $this->input->post('jabatan', true);
        $tipe = $this->input->post('tipejabatan', true);
        $nama = $this->input->post('namapengurus', true);

        if ($kategori == 5) {
            $akses = $tipe;
        } else {
            $akses = 3;
        }

        $cek = $this->CekPengurus($jabatan, $periode, $akses);
        if ($cek > 0) {
            return ['hasil' => 0];
        } else {
            $data = [
                'kategori_jabatanpengurus' => $kategori,
                'jabatan_jabatanpengurus' => $jabatan,
                'bagian_jabatanpengurus' => $akses,
                'instansi_jabatanpengurus' => 'Umum',
                'tanggal_jabatanpengurus' => '1441-10-14',
                'induk_jabatanpengurus' => $this->input->post('indukpengurus', true),
                'periode_jabatanpengurus' => $periode,
                'status_jabatanpengurus' => 1
            ];
            $this->db->insert('jabatan_pengurus', $data);


            $id  = bin2hex(random_bytes(15));
            $key = bin2hex(random_bytes(30));

            $datax = [
                'idpengguna' => $id,
                'tipepengguna' => $akses,
                'namapengguna' => $nama,
                'username' => rand(100, 10000),
                'password' => password_hash('12345', PASSWORD_DEFAULT),
                'statuspengguna' => 2,
                'keypengguna' => $key,
                'tanggalpengguna' => date('Y-m-d H:i:s'),
                'kategoripengguna' => $kategori,
                'jabatanpengguna' => $jabatan,
                'instansipengguna' => 'Umum',
                'gambarpengguna' => 'user.png',
                'KEBUNBARU-KEY' => 'f7f3d294cb068555257017c1dfb0f2'
            ];

            $response = $this->_client->request('POST', 'aturpengguna', [
                'form_params' => $datax
            ]);

            json_decode($response->getBody()->getContents(), false);

            $getTerbaru = $this->db->order_by('urut_pengguna', 'DESC')->get('data_pengguna')->row_object();

            return ['hasil' => 1, 'data' => $getTerbaru];
        }
    }


    public function CekPengurus($jabatan, $periode, $akses)
    {
        return $this->db->get_where('jabatan_pengurus', [
            'jabatan_jabatanpengurus' => $jabatan,
            'periode_jabatanpengurus' => $periode,
            'bagian_jabatanpengurus' => $akses,
            'status_jabatanpengurus' => 1
        ])->num_rows();
    }


    public function nonAktif($id)
    {
        $this->db->where('id_jabatanpengurus', $id)->update('jabatan_pengurus', ['status_jabatanpengurus' => 0]);
    }
}