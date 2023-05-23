<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Chat extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('baseModel');
        $this->load->model('berandaModel', 'bm');

        CekLoginAkses();
    }

    public function index()
    {
        $data = [
            'title' => 'Chatting'
        ];
        $this->load->view('layout/header', $data);
        $this->load->view('chat/chat');
        $this->load->view('layout/footer');
        $this->load->view('chat/javachat');
    }

    public function load()
    {
        $data = $this->db->select('*')->from('chat')->order_by('created', 'ASC')->get()->result_object();
        $datax = [
            'data' => $data
        ];

        $this->load->view('chat/ajax-chat', $datax);
    }

    public function save()
    {
        $message = $this->input->post('message', true);

        $user = $this->session->userdata('username_user');
        if ($user == 'fitri') {
            $to = 'erfaruq';
        } else {
            $to = 'fitri';
        }

        $data = [
            'id' => '',
            'user_from' => $user,
            'user_to' => $to,
            'message' => $message,
            'created' => date('Y-m-d H:i:s')
        ];
        if ($message != '') {
            # code...
            $this->db->insert('chat', $data);
        }
    }

    public function d()
    {
        $this->db->empty_table('chat');

        redirect('chat');
    }
}
