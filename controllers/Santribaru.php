<?php

use PhpOffice\PhpSpreadsheet\Reader\Xls\MD5;

defined('BASEPATH') or exit('No direct script access allowed');

class Santribaru extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('baseModel');
        $this->load->model('dataModel');
        $this->load->model('santribaruModel');
        $this->load->library('form_validation');

        CekLoginAkses();
    }

    public function Index()
    {
        $tipe = $this->session->userdata('tipe_user');
        $data = [
            'title' => 'Pendaftaran Santri Baru',
            'datakamar' => $this->santribaruModel->getKamar($tipe),
            'datapendidikanDiniyah' => $this->santribaruModel->getPendidikan(1, $tipe),
            'datapendidikanFormal' => $this->santribaruModel->getPendidikan(2, $tipe),
            'tipeUser' => $tipe
        ];

        $this->form_validation->set_rules('niksantri', 'NIK', 'required|numeric|exact_length[16]');
        $this->form_validation->set_rules('kksantri', 'KK', 'required|numeric|exact_length[16]');
        $this->form_validation->set_rules('tempatlahirsantri', 'Tempat Lahir', 'required|alpha');
        $this->form_validation->set_rules('namasantri', 'Nama Santri', 'required');
        $this->form_validation->set_rules('tanggallahirsantri', 'Tgl.', 'required');
        $this->form_validation->set_rules('bulanlahirsantri', 'Bln.', 'required');
        $this->form_validation->set_rules('tahunlahirsantri', 'Thn.', 'required');
        $this->form_validation->set_rules('provinsisantri', 'Provinsi', 'required');
        $this->form_validation->set_rules('kecamatansantri', 'Kecamatan', 'required');
        $this->form_validation->set_rules('dusunsantri', 'Dusun', 'required');
        $this->form_validation->set_rules('kabupatensantri', 'Kabupaten/Kota', 'required');
        $this->form_validation->set_rules('desasantri', 'Desa', 'required');
        $this->form_validation->set_rules('rtsantri', 'RT', 'required');
        $this->form_validation->set_rules('rwsantri', 'RW', 'required');
        $this->form_validation->set_rules('kodepossantri', 'Kode POS', 'required|numeric');
        $this->form_validation->set_rules('pendidikansantri', 'Pendidikan Akhir', 'required');
        $this->form_validation->set_rules('rencanadomisili', 'Domisili', 'required');
        $this->form_validation->set_rules('kelasdiniyahsantri', 'Kelas', 'required');
        $this->form_validation->set_rules('tingkatdiniyahsantri', 'Tingkat', 'required');
        $this->form_validation->set_rules('ayahsantri', 'Ayah', 'required');
        $this->form_validation->set_rules('kelasformalsantri', 'Kelas', 'required');
        $this->form_validation->set_rules('tingkatformalsantri', 'Tingkat', 'required');
        $this->form_validation->set_rules('ibusantri', 'Ibu', 'required');
        $this->form_validation->set_rules('nikwali', 'NIK Wali', 'required|numeric|exact_length[16]');
        $this->form_validation->set_rules('namawali', 'Nama Wali', 'required');
        $this->form_validation->set_rules('nomorhpwali', 'No. HP', 'required');
        $this->form_validation->set_rules('nomorwawali', 'No. WA', 'required');
        $this->form_validation->set_rules('provinsiwali', 'Provinsi', 'required');
        $this->form_validation->set_rules('kecamatanwali', 'Kecamatan', 'required');
        $this->form_validation->set_rules('dusunwali', 'Dusun', 'required');
        $this->form_validation->set_rules('kabupatenwali', 'Kabupaten/Kota', 'required');
        $this->form_validation->set_rules('desawali', 'Desa', 'required');
        $this->form_validation->set_rules('rtwali', 'RT', 'required');
        $this->form_validation->set_rules('rwwali', 'RW', 'required');
        $this->form_validation->set_rules('kodeposwali', 'Kode POS', 'required');
        $this->form_validation->set_rules('pendidikanwali', 'Pendidikan', 'required');
        $this->form_validation->set_rules('pekerjaanwali', 'Pendidikan', 'required');
        $this->form_validation->set_rules('hubunganwali', 'Pendidikan', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('santribaru/santribaru');
            $this->load->view('layout/footer');
            $this->load->view('santribaru/javasantribaru');
        } else {
            $nik = $this->input->post('niksantri', true);
            $cek = $this->santribaruModel->cekniksantri($nik);

            if ($cek > 0) {
                $this->session->set_flashdata('gagal', 'NIK yang Anda masukkan sudah terdaftar');
                redirect('santribaru');
            } else {
                //Proses Tambah Santri Baru
                $hasil = $this->santribaruModel->TambahSantriBaru();

                $this->session->set_flashdata('sukses', 'Satu data berhasil ditambhkan');

                $url = encrypt_url($hasil);

                redirect('santribaru/hasilentri/' . $url);
                // redirect('santribaru/hasilentri/' . $hasil);
            }
        }
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


    public function cekNIKWali()
    {
        $nik = $this->input->post('nik', true);
        $hasil = $this->santribaruModel->cekNIKWali($nik);
        if ($hasil) {
            $callback = ['hasil' => 1, $hasil];
        } else {
            $callback = ['hasil' => 0];
        }

        echo json_encode($callback);
    }


    public function HasilEntri($idx)
    {
        $id = decrypt_url($idx);
        // $id = 27101401;
        $tipe = $this->session->userdata('tipe_user');

        $ambil = $this->santribaruModel->GetEntriTerbaru($id);
        $nik = $ambil->nik_walisantri;

        $totalnik = $this->santribaruModel->cekNIKWaliSantriLain($nik, $id);

        $data = [
            'title' => 'Hasil Entri Santri Baru',
            'dataentri' => $ambil,
            'datapendidikanDiniyah' => $this->santribaruModel->getPendidikan(1, $tipe),
            'datapendidikanFormal' => $this->santribaruModel->getPendidikan(2, $tipe),
            'tipeUser' => $tipe,
            'total' => $totalnik
        ];

        $this->load->view('layout/header', $data);
        $this->load->view('santribaru/hasilsantribaru');
        $this->load->view('layout/footer');
        $this->load->view('santribaru/javahasilsantribaru');
    }


    public function EditDataSantri()
    {
        $hasil = $this->santribaruModel->EditDataSantri();

        $this->session->set_flashdata('suksesedit', 'Data ini berhasil diperbarui');

        redirect('santribaru/hasilentri/' . encrypt_url($hasil));
    }


    public function EditDataWali()
    {
        $hasil = $this->santribaruModel->EditDataWali();

        $this->session->set_flashdata('suksesedit', 'Data ini berhasil diperbarui');

        redirect('santribaru/hasilentri/' . encrypt_url($hasil[0]));
    }



    public function Print($idx)
    {
        $id = decrypt_url($idx);
        $ambil = $this->santribaruModel->GetEntriTerbaru($id);

        if ($ambil) {
            # code...
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

    public function cekniksantri()
    {
        $nik = $this->input->post('isi', true);
        $cek = $this->santribaruModel->cekniksantri($nik);

        if ($cek > 0) {
            $hasil = ['hasil' => 200];
        } else {
            $hasil = ['hasil' => 400];
        }

        echo json_encode($hasil);
    }
}
