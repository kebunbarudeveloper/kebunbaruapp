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
        return $this->db->get_where('data_pengguna', ['username' => $user])->row_object();
    }

    public function cekUser($userbaru)
    {
        return $this->db->get_where('data_pengguna', ['username' => $userbaru])->num_rows();
    }

    public function ubahUser($userlama, $userbaru)
    {
        $this->db->where('username', $userlama)->update('data_pengguna', ['username' => $userbaru]);
        return $this->db->affected_rows();
    }


    public function cekPasswordLagi($id)
    {
        return $this->db->get_where('data_pengguna', ['id_pengguna' => $id])->row_object();
    }


    public function ubahPassword($id, $password)
    {
        $this->db->where('id_pengguna', $id)->update('data_pengguna', ['password' => $password]);
        return $this->db->affected_rows();
    }


    public function ubahGambar($id, $nama)
    {
        $this->db->where('id_pengguna', $id)->update('data_pengguna', ['gambar_pengguna' => $nama]);
        return $this->db->affected_rows();
    }
}
