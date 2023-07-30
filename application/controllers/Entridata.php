<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Entridata extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('baseModel');
        $this->load->model('datasantriModel');
        $this->load->model('dataModel');
        $this->load->model('entriModel', 'em');
        $this->load->library('form_validation');

        CekLoginAkses();
        // CekLogin();
    }

    public function index()
    {
        $data = [
            'title' => 'Entri Data Calon Santri'
        ];

        $this->load->view('layout/header', $data);
        $this->load->view('entri/entri');
        $this->load->view('layout/footer');
        $this->load->view('entri/javaentri');
    }

    public function loaddata()
    {
        $data = [
            'data' => $this->em->getdata()[0],
            'total' => $this->em->getdata()[1]
        ];
        $this->load->view('entri/ajax-index', $data);
    }

    public function ceknoreg()
    {
        $noreg = $this->input->post('noreg', true);
        echo json_encode($this->em->ceknoreg($noreg));
    }

    public function loadnoreg()
    {
        $noreg = $this->input->post('noreg', true);
        $data = [
            'data' => $this->em->loadnoreg($noreg)
        ];
        $this->load->view('entri/ajax-reg', $data);
    }

    public function embeddata()
    {
        $noreg = $this->input->post('noreg', true);
        echo json_encode($this->em->loadnoreg($noreg));
    }

    public function GetProvinsi()
    {
        if (isset($_GET['term'])) {
            $result = $this->dataModel->GetProvinsi($_GET['term']);
            if (count($result) > 0) {
                foreach ($result as $row)
                    $arr_result[] = array(
                        'label'         => $row->nama,
                        'description'   => $row->id,
                    );
                echo json_encode($arr_result);
            }
        }
    }

    public function GetKab($id)
    {
        if (isset($_GET['term'])) {
            $result = $this->dataModel->GetKab($id, $_GET['term']);
            if (count($result) > 0) {
                foreach ($result as $row)
                    $arr_result[] = array(
                        'label'         => $row->nama,
                        'description'   => $row->id,
                    );
                echo json_encode($arr_result);
            }
        }
    }


    public function GetKec($id)
    {
        if (isset($_GET['term'])) {
            $result = $this->dataModel->GetKec($id, $_GET['term']);
            if (count($result) > 0) {
                foreach ($result as $row)
                    $arr_result[] = array(
                        'label'         => $row->nama,
                        'description'   => $row->id,
                    );
                echo json_encode($arr_result);
            }
        }
    }


    public function GetDesa($id)
    {
        if (isset($_GET['term'])) {
            $result = $this->dataModel->GetDesa($id, $_GET['term']);
            if (count($result) > 0) {
                foreach ($result as $row)
                    $arr_result[] = array(
                        'label'         => $row->nama,
                        'description'   => $row->kode_pos
                    );
                echo json_encode($arr_result);
            }
        }
    }


    public function simpansantri()
    {
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('kk', 'KK', 'required|numeric|exact_length[16]');
        $this->form_validation->set_rules('pendidikan', 'Pendidikan', 'required');
        $this->form_validation->set_rules('tempat', 'Tempat', 'required');
        $this->form_validation->set_rules('tanggal', 'Tgl', 'required');
        $this->form_validation->set_rules('bulan', 'Bln', 'required');
        $this->form_validation->set_rules('tahun', 'Thn', 'required');
        $this->form_validation->set_rules('provinsi', 'Provinsi', 'required');
        $this->form_validation->set_rules('kabupaten', 'kabupaten', 'required');
        $this->form_validation->set_rules('kecamatan', 'kecamatan', 'required');
        $this->form_validation->set_rules('desa', 'desa', 'required');
        $this->form_validation->set_rules('dusun', 'dusun', 'required');
        $this->form_validation->set_rules('rt', 'rt', 'required');
        $this->form_validation->set_rules('rw', 'rw', 'required');
        $this->form_validation->set_rules('ayah', 'ayah', 'required');
        $this->form_validation->set_rules('ibu', 'ibu', 'required');

        if ($this->form_validation->run() == FALSE) {
            $result = [
                'message' => 400,
                'errors' => [
                    'kk' => form_error('kk'),
                    'pendidikan' => form_error('pendidikan'),
                    'tempat' => form_error('tempat'),
                    'tanggal' => form_error('tanggal'),
                    'bulan' => form_error('bulan'),
                    'tahun' => form_error('tahun'),
                    'provinsi' => form_error('provinsi'),
                    'kabupaten' => form_error('kabupaten'),
                    'kecamatan' => form_error('kecamatan'),
                    'desa' => form_error('desa'),
                    'dusun' => form_error('dusun'),
                    'rt' => form_error('rt'),
                    'rw' => form_error('rw'),
                    'ayah' => form_error('ayah'),
                    'ibu' => form_error('ibu'),
                ]
            ];
        } else {
            $simpan = $this->em->simpansantri();
            $result = [
                'message' => $simpan,
                'errors' => []
            ];
        }

        echo json_encode($result);
    }

    public function simpanwali()
    {
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('pekerjaan', 'pekerjaan', 'required');
        $this->form_validation->set_rules('provinsiw', 'Provinsi', 'required');
        $this->form_validation->set_rules('kabupatenw', 'Kabupaten', 'required');
        $this->form_validation->set_rules('kecamatanw', 'Kecamatan', 'required');
        $this->form_validation->set_rules('desaw', 'Desa', 'required');
        $this->form_validation->set_rules('dusunw', 'Dusun', 'required');
        $this->form_validation->set_rules('rtw', 'RT', 'required');
        $this->form_validation->set_rules('rww', 'RW', 'required');

        if ($this->form_validation->run() == FALSE) {
            $result = [
                'message' => 400,
                'errors' => [
                    'pekerjaan' => form_error('pekerjaan'),
                    'provinsiw' => form_error('provinsiw'),
                    'kabupatenw' => form_error('kabupatenw'),
                    'kecamatanw' => form_error('kecamatanw'),
                    'desaw' => form_error('desaw'),
                    'dusunw' => form_error('dusunw'),
                    'rtw' => form_error('rtw'),
                    'rww' => form_error('rww')
                ]
            ];
        } else {
            $simpan = $this->em->simpanwali();
            $result = [
                'message' => $simpan,
                'errors' => []
            ];
        }

        echo json_encode($result);
    }

    public function getalamat()
    {
        $noreg = $this->input->post('noreg', true);
        $hasil = $this->em->getalamat($noreg);

        echo json_encode($hasil);
    }

    public function setdata()
    {
        $id = $this->input->post('noreg', true);
        $data = $this->em->loadnoreg($id);
        if ($data) {
            //Cek NIK santri
            $nik = $data->nik;
            $nikw = $data->nikw;
            $cekniksantri = $this->em->cekniksantri($nik);
            if ($cekniksantri > 0) {
                $hasil = [
                    'status' => 201,
                    'id' => $id
                ];
            } else {

                $ceknikwali = $this->em->ceknikwali($nikw);
                if ($ceknikwali > 0) {
                    $idSantri = $this->em->setsantri($data);
                } else {
                    $idSantri = $this->em->setsantri($data);
                    $this->em->setwali($data);
                }

                $this->em->updatestatus($id, $idSantri);

                $hasil = [
                    'status' => 200,
                    'id' => $idSantri
                ];
            }
        } else {
            $hasil = [
                'status' => 400,
                'id' => $id
            ];
        }

        echo json_encode($hasil);
    }

    public function setprint()
    {
        $id = $this->input->post('idsantri', true);
        $idx = encrypt_url($id);

        redirect('entridata/print/' . $idx);
    }

    public function Print($idx)
    {
        $id = decrypt_url($idx);
        $ambil = $this->em->getentri($id);

        if ($ambil) {
            $noreg = $ambil->id_santri;

            $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
            $jadi =  $generator->getBarcode($noreg, $generator::TYPE_CODE_128, 2, 40);
        }

        $data = [
            'title' => 'Salinan Formulir Pendaftaran',
            'barcode' => @$jadi,
            'datanya' => $ambil
        ];

        $this->load->view('print/salinanformulir', $data);
    }
}
