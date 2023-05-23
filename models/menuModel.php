<?php
defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class menuModel extends CI_Model
{
    private $_client;

    public function __construct()
    {
        parent::__construct();
        $this->_client = new Client([
            'base_uri' => getURLAPI()
        ]);
    }

    public function GetKategoriPengguna($kategoriUser)
    {
        // return $this->db->get_where('kategori_pengguna', ['id_kategoripengguna' => $kategoriUser])->row_object();
        try {
            $response = $this->_client->request('GET', 'kelolamenu', [
                'query' => [
                    'KEBUNBARU-KEY' => 'f7f3d294cb068555257017c1dfb0f2',
                    'id' => $kategoriUser
                ]
            ]);

            $hasil = json_decode($response->getBody()->getContents(), false);
            return $hasil->data;
        } catch (ClientException $e) {
            return '';
        }
    }

    public function getKategoriJabatan()
    {
        // return $this->db->get('kategori_pengguna')->result_object();
        try {
            $response = $this->_client->request('GET', 'kelolamenu/kategorijabatan', [
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


    public function getMenu($jabatan)
    {
        // return $this->db->order_by('urut_datamenu', 'ASC')->get_where('data_menu', ['jabatan_datamenu' => $jabatan, 'status_menu' => 1])->result_object();
        try {
            $response = $this->_client->request('GET', 'kelolamenu/getmenu', [
                'query' => [
                    'KEBUNBARU-KEY' => 'f7f3d294cb068555257017c1dfb0f2',
                    'id' => $jabatan
                ]
            ]);

            $hasil = json_decode($response->getBody()->getContents(), false);
            return $hasil->data;
        } catch (ClientException $e) {
            return '';
        }
    }


    public function getJabatan($idkategori)
    {
        //return $this->db->order_by('urut_jabatan', 'ASC')->get_where('data_jabatan', ['kategori_jabatan' => $idkategori])->result_object();
        try {
            $response = $this->_client->request('GET', 'kelolamenu/getjabatan', [
                'query' => [
                    'KEBUNBARU-KEY' => 'f7f3d294cb068555257017c1dfb0f2',
                    'id' => $idkategori
                ]
            ]);

            $hasil = json_decode($response->getBody()->getContents(), false);
            return $hasil->data;
        } catch (ClientException $e) {
            return '';
        }
    }


    public function TambahMenu($data)
    {
        $this->db->insert('data_menu', $data);
    }


    public function getMenuID($data)
    {
        //return $this->db->get_where('data_menu', $data)->num_rows();
        try {
            $response = $this->_client->request('GET', 'kelolamenu/getmenuid', [
                'query' => $data
            ]);

            $hasil = json_decode($response->getBody()->getContents(), false);
            return $hasil->data;
        } catch (ClientException $e) {
            return '';
        }
    }


    public function getMenuJabatan($kategori)
    {
        // return $this->db->order_by('urut_jabatan', 'ASC')->get_where('data_jabatan', ['kategori_jabatan' => $kategori])->result_object();
        try {
            $response = $this->_client->request('GET', 'kelolamenu/getmenujabatan', [
                'query' => [
                    'KEBUNBARU-KEY' => 'f7f3d294cb068555257017c1dfb0f2',
                    'id' => $kategori
                ]
            ]);

            $hasil = json_decode($response->getBody()->getContents(), false);
            return $hasil->data;
        } catch (ClientException $e) {
            return '';
        }
    }


    public function getMenuPerjabatan($kategori, $jabatan)
    {
        // return $this->db->get_where('data_menu', ['kategori_datamenu' => $kategori, 'jabatan_datamenu' => $jabatan])->result_object();
        try {
            $response = $this->_client->request('GET', 'kelolamenu/getmenuperjabatan', [
                'query' => [
                    'KEBUNBARU-KEY' => 'f7f3d294cb068555257017c1dfb0f2',
                    'id' => $kategori,
                    'jabatan' => $jabatan
                ]
            ]);

            $hasil = json_decode($response->getBody()->getContents(), false);
            return $hasil->data;
        } catch (ClientException $e) {
            return '';
        }
    }


    public function ubahStatus($id, $status)
    {
        // $this->db->where('id_datamenu', $id)->update('data_menu', ['status_menu' => $status]);
        $data = [
            'id' => $id,
            'aksi' => $status,
            'KEBUNBARU-KEY' => 'f7f3d294cb068555257017c1dfb0f2'
        ];

        $response = $this->_client->request('PUT', 'kelolamenu', [
            'form_params' => $data
        ]);

        $hasil = json_decode($response->getBody()->getContents(), false);
        return $hasil->message;
    }
}