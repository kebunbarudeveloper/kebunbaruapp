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
        return $this->db->get('data_kategori')->result_object();
    }


    public function getDataPengguna()
    {
        $id = $this->input->post('id', true);

        $this->db->select('*')
            ->from('data_pengguna')
            ->join('kategori_pengguna', 'id_kategoripengguna = kategori_pengguna')
            ->join('data_jabatan', 'id_jabatan = jabatan_pengguna')
            ->where('kategori_pengguna', $id)
            ->order_by('urut_jabatan', 'ASC');
        return $this->db->get()->result_object();
    }


    public function getJabatan()
    {
        $id = $this->input->post('id', true);
        return $this->db->order_by('urut_jabatan', 'ASC')->get_where('data_jabatan', ['kategori_jabatan' => $id])->result_object();
    }


    public function TambahPengguna()
    {
        $id       = bin2hex(random_bytes(15));
        $kategori = $this->input->post('idkategori', true);
        $jabatan  = $this->input->post('jabatanpengguna', true);
        $tipe     = $this->input->post('tipepengguna', true);
        $nama     = $this->input->post('namapengguna', true);

        $data = [
            'id_pengguna' => $id,
            'tipe_pengguna' => $tipe,
            'nama_pengguna' => strtoupper($nama),
            'username' => rand(100, 1000),
            'password' => password_hash('12345', PASSWORD_DEFAULT),
            'status_pengguna' => 1,
            'key_pengguna' => 'f7f3d294cb068555257017c1dfb0f2',
            'tanggal_pengguna' => date('Y-m-d H:i:s'),
            'kategori_pengguna' => $kategori,
            'jabatan_pengguna' => $jabatan,
            'instansi_pengguna' => '',
            'gambarpengguna' => 'user.png'
        ];

        $this->db->insert('data_pengguna', $data);
        return $this->db->affected_rows();
    }


    public function getKeyPengguna($id)
    {
        return $this->db->get_where('data_pengguna', ['id_pengguna' => $id])->row_object();
    }

    public function AksiPengguna()
    {
        $id = $this->input->post('id', true);
        $status = $this->input->post('status', true);

        $this->db->where('id_pengguna', $id)->update('data_pengguna', ['status_pengguna' => $status]);
        return $this->db->affected_rows();
    }


    public function reset()
    {
        $this->db->empty_table('kembalian');
        $this->db->empty_table('set_date');
        $this->db->empty_table('set_zone');
    }
}
