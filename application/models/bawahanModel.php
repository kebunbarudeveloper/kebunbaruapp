<?php
defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class bawahanModel extends CI_Model
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
        return $this->db->get_where('data_kategori', ['urut_kategori >' => 1])->result_object();
    }


    public function getJabatan()
    {
        // $this->db->select('*')
        //     ->from('data_jabatan')
        //     ->join('kategori_pengguna', 'id_kategoripengguna = kategori_jabatan')
        //     ->where('kategori_jabatan', 4)
        //     ->order_by('urut_jabatan', 'ASC');
        // return $this->db->get()->result_object();
        $id = $this->input->post('id', true);
        $tipe = $this->input->post('tipe', true);
        $periode  = $this->baseModel->GetPeriode();
        $this->db->select('*');
        $this->db->from('jabatan_pengurus');
        $this->db->join('data_pengurus', 'induk_pengurus = induk_jabatanpengurus');
        $this->db->join('data_jabatan', 'id_jabatan = jabatan_jabatanpengurus');
        $this->db->where('kategori_jabatanpengurus', $id);
        $this->db->where('periode_jabatanpengurus', $periode);
        $this->db->where('status_jabatanpengurus', 1);
        if ($id == 5) {
            $this->db->where('bagian_jabatanpengurus', $tipe);
        }
        $this->db->order_by('urut_jabatan', 'ASC');
        return $this->db->get()->result_object();
    }


    public function getJabatanPerkategori($kategori)
    {
        return $this->db->order_by('urut_jabatan', 'ASC')->get_where('data_jabatan', [
            'kategori_jabatan' => $kategori,
            'akses_jabatan' => 2
        ])->result_object();
    }


    public function getIDJabatan()
    {
        // $this->db->select('*')
        //     ->from('data_jabatan')
        //     ->join('kategori_pengguna', 'id_kategoripengguna = kategori_jabatan')
        //     ->where('kategori_jabatan', 4)
        //     ->order_by('urut_jabatan', 'ASC');
        // return $this->db->get()->result_object();
        $id = $this->input->post('id', true);
        $bagian = $this->input->post('bagian', true);
        $instansi = $this->input->post('instansi', true);
        $periode  = $this->baseModel->GetPeriode();

        $query = "SELECT id_jabatan, nama_jabatan FROM data_jabatan WHERE kategori_jabatan = '$id'
        AND id_jabatan NOT IN(SELECT jabatan_jabatanpengurus FROM jabatan_pengurus WHERE kategori_jabatanpengurus = '$id'
        AND periode_jabatanpengurus = '$periode' AND status_jabatanpengurus = 1 AND bagian_jabatanpengurus = '$bagian' AND instansi_jabatanpengurus = '$instansi') ORDER BY urut_jabatan ASC";
        return $this->db->query($query)->result_object();
    }


    public function TambahJabatan()
    {
        $data = [
            'urut_jabatan' => $this->input->post('urutjabatan', true),
            'kategori_jabatan' => $this->input->post('kategorijabatan', true),
            'nama_jabatan' => ucwords($this->input->post('namajabatan', true))
        ];
        // $this->db->insert('data_jabatan', $data);

        $this->db->insert('data_jabatan', $data);
        return $this->db->affected_rows();
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


    public function cekJabatan($jabatan, $periode, $bagian, $instansi)
    {
        return $this->db->get_where('jabatan_pengurus', [
            'jabatan_jabatanpengurus' => $jabatan,
            'periode_jabatanpengurus' => $periode,
            'bagian_jabatanpengurus' => $bagian,
            'instansi_jabatanpengurus' => $instansi,
            'status_jabatanpengurus' => 1
        ])->num_rows();
    }


    public function getNamaPengurus($induk)
    {
        $data = $this->db->get_where('data_pengurus', ['induk_pengurus' => $induk])->row_object();
        return $data->nama_pengurus;
    }


    public function tambahaturjabatan()
    {
        $kategori = $this->input->post('kategoriatur', true);
        $induk    = $this->input->post('indukpengurus', true);
        $jabatan  = $this->input->post('jabatanatur', true);
        $bagian   = $this->input->post('tipeatur', true);
        $periode  = $this->baseModel->GetPeriode();

        if ($kategori == 6) {
            $instansi = $this->input->post('instansijabatan', true);
        } else {
            $instansi = 'Umum';
        }

        $cek = $this->cekJabatan($jabatan, $periode, $bagian, $instansi);
        if ($cek <= 0) {

            $data = [
                'id_jabatanpengurus' => '',
                'kategori_jabatanpengurus' => $kategori,
                'jabatan_jabatanpengurus' => $jabatan,
                'bagian_jabatanpengurus' => $bagian,
                'instansi_jabatanpengurus' => $instansi,
                'tanggal_jabatanpengurus' => $this->baseModel->GetHijriSekarang(),
                'induk_jabatanpengurus' => $induk,
                'periode_jabatanpengurus' => $periode,
                'status_jabatanpengurus' => 1
            ];
            $this->db->insert('jabatan_pengurus', $data);

            //Nambah ke tabel penggguna
            $id       = bin2hex(random_bytes(15));

            $data = [
                'idpengguna' => $id,
                'tipepengguna' => $bagian,
                'namapengguna' => $this->getNamaPengurus($induk),
                'username' => rand(100, 10000),
                'password' => password_hash('12345', PASSWORD_DEFAULT),
                'statuspengguna' => 2,
                'tanggalpengguna' => date('Y-m-d H:i:s'),
                'kategoripengguna' => $kategori,
                'jabatanpengguna' => $jabatan,
                'instansipengguna' => $instansi,
                'gambarpengguna' => 'user.png',
                'KEBUNBARU-KEY' => 'f7f3d294cb068555257017c1dfb0f2'
            ];

            $response = $this->_client->request('POST', 'aturpengguna', [
                'form_params' => $data
            ]);

            json_decode($response->getBody()->getContents(), false);

            $hasil = ['hasil' => 1];
        } else {
            $hasil = ['hasil' => 0];
        }

        return $hasil;
    }



    public function getPendidikan($tipe, $akses)
    {
        $query = "SELECT * FROM data_pendidikan WHERE tipe_datapendidikan = $tipe AND akses_datapendidikan IN(3, $akses) ORDER BY urut_datapendidikan ASC";
        return $this->db->query($query)->result_object();
    }


    public function getDetail($induk)
    {
        $this->db->select('*')->from('data_pengurus')->join('jabatan_pengurus', 'induk_jabatanpengurus = induk_pengurus')->where('induk_pengurus', $induk);
        return $this->db->get()->row_object();
    }



    public function CekIDJabatan($id, $periode, $bagian, $instansi)
    {
        return $this->db->get_where('jabatan_pengurus', [
            'jabatan_jabatanpengurus' => $id,
            'bagian_jabatanpengurus' => $bagian,
            'instansi_jabatanpengurus' => $instansi,
            'periode_jabatanpengurus' => $periode,
            'status_jabatanpengurus' => 1
        ])->num_rows();
    }


    public function ubahStatus()
    {
        $id = $this->input->post('id', true);
        $aksi = $this->input->post('aksi', true);
        $jabatan = $this->input->post('jabatan', true);
        $bagian = $this->input->post('bagian', true);
        $instansi = $this->input->post('instansi', true);
        $periode  = $this->baseModel->GetPeriode();

        $cek = $this->CekIDJabatan($jabatan, $periode, $bagian, $instansi);
        if ($cek > 0) {
            return ['hasil' => 0];
        } else {
            $this->db->where([
                'id_jabatanpengurus' => $id,
                'periode_jabatanpengurus' => $periode
            ])->update('jabatan_pengurus', ['status_jabatanpengurus' => $aksi]);
            return ['hasil' => 1];
        }
    }
}
