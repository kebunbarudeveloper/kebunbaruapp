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
        return $this->db->get_where('data_kategori', ['id_kategori' => $kategoriUser])->row_object();
    }

    public function getKategoriJabatan()
    {
        return $this->db->get('data_kategori')->result_object();
    }


    public function getMenu($jabatan)
    {
        return $this->db->order_by('urut_datamenu', 'ASC')->get_where('data_menu', ['jabatan_datamenu' => $jabatan, 'status_menu' => 1])->result_object();
    }


    public function getJabatan($idkategori)
    {
        return $this->db->order_by('urut_jabatan', 'ASC')->get_where('data_jabatan', ['kategori_jabatan' => $idkategori])->result_object();
    }


    public function TambahMenu($data)
    {
        $this->db->insert('data_menu', $data);
    }


    public function getMenuID($data)
    {
        return $this->db->get_where('data_menu', $data)->num_rows();
    }


    public function getMenuJabatan($kategori)
    {
        return $this->db->order_by('urut_jabatan', 'ASC')->get_where('data_jabatan', ['kategori_jabatan' => $kategori])->result_object();
    }


    public function getMenuPerjabatan($kategori, $jabatan)
    {
        return $this->db->get_where('data_menu', ['kategori_datamenu' => $kategori, 'jabatan_datamenu' => $jabatan])->result_object();
    }


    public function ubahStatus($id, $status)
    {
        $this->db->where('id_datamenu', $id)->update('data_menu', ['status_menu' => $status]);
        return $this->db->affected_rows();
    }
}
