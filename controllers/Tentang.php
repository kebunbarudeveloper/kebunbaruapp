<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Tentang extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('baseModel');

        // CekLogin();
    }

    public function Index()
    {
        $data = [
            'title' => 'Tentang Kami',
            'aktiftentang' => 'active'
        ];

        $this->load->view('layout/header', $data);
        $this->load->view('tentang/tentang');
        $this->load->view('layout/footer');
        $this->load->view('tentang/javatentang');
    }


    public function coba()
    {
        $now = \GeniusTS\HijriDate\Date::now();
        $today = \GeniusTS\HijriDate\Date::today();
        $tomorrow = \GeniusTS\HijriDate\Date::tomorrow();
        $yesterday = \GeniusTS\HijriDate\Date::yesterday();

        $date = \GeniusTS\HijriDate\Hijri::convertToHijri('2016-12-01');

        echo $today;
    }


    public function Lirik_lagu()
    {
        //Title => At My Worst

        echo 'I need somebody who can love me at my worst';
        //Aku butuh seseorang yang bisa mencintaiku pada saat terburukku

        echo 'Know I\'m not perfect, but I hope you see my worth';
        //Ketahuilah bahwa aku tidak sempurna, tapi aku harap Anda melihat nilaiku

        echo '\'Cause it\'s only you, nobody new, I put you first';
        //Karena hanya kamu, tidak ada yang baru, aku mengutamakanmu

        echo 'And for you, girl, I swear I\'ll do the worst';
        //Dan untukmu, Sayang, aku bersumpah, aku akan melakukan yang terburuk

    }
}
