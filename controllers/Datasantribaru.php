<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Datasantribaru extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('datasantribaruModel');
        $this->load->model('baseModel');

        // Load pagination library 
        $this->load->library('ajax_pagination');

        // Per page limit 
        $this->perPage = 10;


        CekLoginAkses();
    }

    public function Index()
    {
        $data = [
            'title' => 'Data Santri Baru'
        ];

        $this->load->view('layout/header', $data);
        $this->load->view('datasantribaru/datasantribaru');
        $this->load->view('layout/footer');
        $this->load->view('datasantribaru/javadatasantribaru');
    }



    public function LoadData()
    {
        $data = array();
        $periode = $this->baseModel->GetPeriode();

        // Get record count 
        $conditions['returnType'] = 'count';
        $totalRec = $this->datasantribaruModel->getRows($conditions);

        // Pagination configuration 
        $config['target']      = '#dataList';
        $config['base_url']    = base_url('datasantribaru/ajaxPaginationData');
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';

        // Initialize pagination library 
        $this->ajax_pagination->initialize($config);

        // Get records 
        $conditions = array(
            'limit' => $this->perPage
        );


        $data = [
            'posts' => $this->datasantribaruModel->getRows($conditions),
            'datapendidikan' => $this->datasantribaruModel->DataPendidikan($periode)
        ];

        $this->load->view('datasantribaru/ajax-view', $data, false);
    }



    public function ajaxPaginationData()
    {

        // Define offset 
        $page = $this->input->post('page');
        if (!$page) {
            $offset = 0;
        } else {
            $offset = $page;
        }

        // Set conditions for search and filter 
        $keywords = $this->input->post('keywords');
        $pendidikan = $this->input->post('pendidikan');

        if (!empty($keywords)) {
            $conditions['search']['keywords'] = $keywords;
        }
        if (!empty($pendidikan)) {
            $conditions['where']['tingkat_diniyah'] = $pendidikan;
        }


        // Get record count 
        $conditions['returnType'] = 'count';
        $totalRec = $this->datasantribaruModel->getRows($conditions);

        // Pagination configuration 
        $config['target']      = '#dataList';
        $config['base_url']    = base_url('datasantribaru/ajaxPaginationData');
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';

        // Initialize pagination library 
        $this->ajax_pagination->initialize($config);

        // Get records 
        $conditions['start'] = $offset;
        $conditions['limit'] = $this->perPage;
        unset($conditions['returnType']);
        $data['posts'] = $this->datasantribaruModel->getRows($conditions);

        // Load the data list view 
        $this->load->view('datasantribaru/ajax-datasantribaru', $data, false);
    }



    public function DetailSantri()
    {
        $id   = $this->input->post('id', true);
        $tipe = $this->session->userdata('tipe_user');

        $get = $this->datasantribaruModel->GetDetailSantri($id, $tipe);

        $data = [
            'dataentri' => $get
        ];
        $this->load->view('datasantribaru/ajax-detail', $data, false);
    }
}