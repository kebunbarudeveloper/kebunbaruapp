<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Payment extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('baseModel');
        $this->load->model('PaymentModel', 'pm');

        CekLoginAkses();
    }

    public function index()
    {
        $data = [
            'title' => 'Pembayaran Biaya Tahunan',
            'pengaturan' => $this->pm->getpengaturan(),
            'bulan' => $this->baseModel->GetBulanHijri()
        ];

        $this->load->view('layout/header', $data);
        $this->load->view('payment/payment');
        $this->load->view('layout/footer');
        $this->load->view('payment/java-payment');
    }

    public function load()
    {
        $data = [
            'datax' => $this->pm->getdata()[0],
            'total' => $this->pm->getdata()[1],
            'grand' => $this->pm->getdata()[2]
        ];
        $this->load->view('payment/ajax-load', $data);
    }

    public function cekdata()
    {
        $hasil = $this->pm->cekdata();

        echo json_encode($hasil);
    }

    public function cekdetaildiskon()
    {
        $hasil = $this->pm->cekdetaildiskon();

        echo json_encode($hasil);
    }

    public function getdatasantri()
    {
        $id = $this->input->post('id', true);
        $data = [
            'data' => $this->pm->getdatasantri($id)
        ];
        $this->load->view('payment/ajax-data', $data);
    }

    public function editkelas()
    {
        $this->pm->editkelas();
    }

    public function pay()
    {
        $hasil = $this->pm->pay();

        echo json_encode(['status' => $hasil]);
    }

    public function getdiskon()
    {
        $hasil = $this->pm->getdiskon();
        echo json_encode(['hasil' => $hasil]);
    }

    public function print()
    {
        $id = $this->input->post('invoice', true);
        redirect('payment/printout/' . encrypt_url($id));
    }

    public function printout($id)
    {
        $idfixed = decrypt_url($id);
        $data = [
            'title' => 'Print Out Invoice',
            'data' => $this->pm->getdataprint($idfixed)
        ];
        $this->load->view('print/invoice', $data);
    }


    public function deletepayment()
    {
        $id = $this->input->post('id', true);
        $hasil = $this->pm->deletepayment($id);

        echo json_encode($hasil);
    }

    public function getpenambahan()
    {
        $hasil = $this->pm->getpenambahan();

        echo json_encode($hasil);
    }

    public function loaddetail()
    {
        $id = $this->input->post('id', true);
        $data = [
            'data' => $this->pm->getdataprint($id)
        ];
        $this->load->view('payment/ajax-detail', $data);
    }
}
