<?php
defined('BASEPATH') or exit('No direct script access allowed');


class PesertaModel extends CI_Model
{
    public function getData()
    {
        return $this->db->limit(5, 25)->get('bm')->result_object();
    }

    public function getdataall()
    {
        return $this->db->get('bm')->result_object();
    }
}
