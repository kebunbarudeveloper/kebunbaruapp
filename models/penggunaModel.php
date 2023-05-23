<?php
defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class penggunaModel extends CI_Model
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
            $response = $this->_client->request('GET', 'aturpengguna', [
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


    public function getDataPengguna()
    {
        $id = $this->input->post('id', true);

        // $this->db->select('*')
        //     ->from('data_pengguna')
        //     ->join('kategori_pengguna', 'id_kategoripengguna = kategori_pengguna')
        //     ->join('data_jabatan', 'id_jabatan = jabatan_pengguna')
        //     ->where('kategori_pengguna', $id)
        //     ->order_by('urut_jabatan', 'ASC');
        // return $this->db->get()->result_object();

        try {
            $response = $this->_client->request('GET', 'aturpengguna/getdatapengguna', [
                'query' => [
                    'KEBUNBARU-KEY' => 'f7f3d294cb068555257017c1dfb0f2',
                    'id' => $id
                ]
            ]);

            $hasil = json_decode($response->getBody()->getContents(), false);
            return $hasil->data;
        } catch (ClientException $e) {
            return '';
        }
    }


    public function getJabatan()
    {
        $id = $this->input->post('id', true);
        // return $this->db->order_by('urut_jabatan', 'ASC')->get_where('data_jabatan', ['kategori_jabatan' => $id])->result_object();

        try {
            $response = $this->_client->request('GET', 'aturpengguna/getjabatan', [
                'query' => [
                    'KEBUNBARU-KEY' => 'f7f3d294cb068555257017c1dfb0f2',
                    'id' => $id
                ]
            ]);

            $hasil = json_decode($response->getBody()->getContents(), false);
            return $hasil->data;
        } catch (ClientException $e) {
            return '';
        }
    }


    public function TambahPengguna()
    {
        $id       = bin2hex(random_bytes(15));
        $kategori = $this->input->post('idkategori', true);
        $jabatan  = $this->input->post('jabatanpengguna', true);
        $tipe     = $this->input->post('tipepengguna', true);
        $nama     = $this->input->post('namapengguna', true);

        $data = [
            'idpengguna' => $id,
            'tipepengguna' => $tipe,
            'namapengguna' => strtoupper($nama),
            'username' => rand(100, 1000),
            'password' => password_hash('12345', PASSWORD_DEFAULT),
            'statuspengguna' => 1,
            'keypengguna' => 'f7f3d294cb068555257017c1dfb0f2',
            'tanggalpengguna' => date('Y-m-d H:i:s'),
            'kategoripengguna' => $kategori,
            'jabatanpengguna' => $jabatan,
            'gambarpengguna' => 'user.png',
            'KEBUNBARU-KEY' => 'f7f3d294cb068555257017c1dfb0f2'
        ];

        $response = $this->_client->request('POST', 'aturpengguna', [
            'form_params' => $data
        ]);

        $hasil = json_decode($response->getBody()->getContents(), false);
        return $hasil->message;
    }


    public function getKeyPengguna($id)
    {
        $data = [
            'id' => $id,
            'KEBUNBARU-KEY' => 'f7f3d294cb068555257017c1dfb0f2'
        ];

        $response = $this->_client->request('PUT', 'aturpengguna/getkeypengguna', [
            'form_params' => $data
        ]);

        $hasil = json_decode($response->getBody()->getContents(), false);
        return $hasil->message;
    }

    public function AksiPengguna()
    {
        $id = $this->input->post('id', true);
        $status = $this->input->post('status', true);


        //Jika status baru (belum diaktivasi). Maka, seluruh data ambil untuk disimpan di database lokal
        if ($status == 2) {
            $dataPengguna = $this->getKeyPengguna($id);
        }


        $data = [
            'id' => $id,
            'aksi' => $this->input->post('aksi', true),
            'status' => $status,
            'KEBUNBARU-KEY' => 'f7f3d294cb068555257017c1dfb0f2'
        ];

        $response = $this->_client->request('PUT', 'aturpengguna', [
            'form_params' => $data
        ]);

        $hasil = json_decode($response->getBody()->getContents(), false);
        return $hasil->message;
    }


    public function reset()
    {
        $this->db->empty_table('kembalian');
        $this->db->empty_table('set_date');
        $this->db->empty_table('set_zone');
    }
}
