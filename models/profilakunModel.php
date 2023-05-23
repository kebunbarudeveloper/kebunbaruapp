<?php
defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class profilakunModel extends CI_Model
{
    private $_client;

    public function __construct()
    {
        parent::__construct();
        $this->_client = new Client([
            'base_uri' => getURLAPI()
        ]);
    }

    public function cekPassword($user)
    {
        // return $this->db->get_where('data_pengguna', ['username' => $user])->row_object();

        try {
            $response = $this->_client->request('GET', 'profilakun', [
                'query' => [
                    'KEBUNBARU-KEY' => 'f7f3d294cb068555257017c1dfb0f2',
                    'id' => $user
                ]
            ]);

            $hasil = json_decode($response->getBody()->getContents(), false);
            return $hasil->data;
        } catch (ClientException $e) {
            return '';
        }
    }

    public function cekUser($userbaru)
    {
        // return $this->db->get_where('data_pengguna', ['username' => $userbaru])->num_rows();
        try {
            $response = $this->_client->request('GET', 'profilakun/cekuser', [
                'query' => [
                    'KEBUNBARU-KEY' => 'f7f3d294cb068555257017c1dfb0f2',
                    'id' => $userbaru
                ]
            ]);

            $hasil = json_decode($response->getBody()->getContents(), false);
            return $hasil->data;
        } catch (ClientException $e) {
            return '';
        }
    }

    public function ubahUser($userlama, $userbaru)
    {
        // $this->db->where('username', $userlama)->update('data_pengguna', ['username' => $userbaru]);
        // return $this->db->affected_rows();

        $data = [
            'userlama' => $userlama,
            'userbaru' => $userbaru,
            'KEBUNBARU-KEY' => 'f7f3d294cb068555257017c1dfb0f2'
        ];

        $response = $this->_client->request('PUT', 'profilakun', [
            'form_params' => $data
        ]);

        $hasil = json_decode($response->getBody()->getContents(), false);
        return $hasil->message;
    }


    public function cekPasswordLagi($id)
    {
        // return $this->db->get_where('data_pengguna', ['id_pengguna' => $id])->row_object();
        try {
            $response = $this->_client->request('GET', 'profilakun/cekpasswordlagi', [
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


    public function ubahPassword($id, $password)
    {
        // $this->db->where('id_pengguna', $id)->update('data_pengguna', ['password' => $password]);
        // return $this->db->affected_rows();

        $data = [
            'id' => $id,
            'password' => $password,
            'KEBUNBARU-KEY' => 'f7f3d294cb068555257017c1dfb0f2'
        ];

        $response = $this->_client->request('PUT', 'profilakun/ubahpassword', [
            'form_params' => $data
        ]);

        $hasil = json_decode($response->getBody()->getContents(), false);
        return $hasil->message;
    }


    public function ubahGambar($id, $nama)
    {
        // $this->db->where('id_pengguna', $id)->update('data_pengguna', ['gambar_pengguna' => $nama]);
        // return $this->db->affected_rows();

        $data = [
            'id' => $id,
            'nama' => $nama,
            'KEBUNBARU-KEY' => 'f7f3d294cb068555257017c1dfb0f2'
        ];

        $response = $this->_client->request('PUT', 'profilakun/ubahgambar', [
            'form_params' => $data
        ]);

        $hasil = json_decode($response->getBody()->getContents(), false);
        return $hasil->message;
    }
}