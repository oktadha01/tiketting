<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Userprofil extends CI_Controller
{
    var $template = 'tmpt_client/index';
    public $M_userprofil;
    public $input;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_userprofil');
    }

    function index()
    {
        $email = $this->input->cookie('session');

        $data['tittle']          = 'Profil';
        // $data['absen']        = $this->M_dashboard->m_absen();
        $data['customer']        = $this->M_userprofil->m_customer($email);
        $data['content']         = 'client/profil/profil';
        $data['script']         = 'client/profil/profil_js';
        $this->load->view($this->template, $data);
    }

    function update_profil()
    {
        $email = $this->input->cookie('session');
        $nama = $this->input->post('nama');
        $tgl_lahir = $this->input->post('tgl-lahir');
        $gender = $this->input->post('gender');
        $nik = $this->input->post('nik');
        $kota = $this->input->post('kota');
        $kontak = $this->input->post('kontak');
        $this->M_userprofil->m_update_profil($email, $nama, $tgl_lahir, $gender, $nik, $kota, $kontak);
    }
    function update_email()
    {
        $email_lama = $this->input->cookie('session');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        if ($this->input->cookie('session') == $this->input->post('email')) {
            echo 'Email berhasil diubah';
        } else {
            $cek_email = $this->M_userprofil->m_cek_email($email);
            $num_rows_mangkir = $cek_email['num_rows'];
            if ($num_rows_mangkir > 0) {
                echo 'Sorry !! Email sudah di gunakan..';
            } else {
                $data = $this->M_userprofil->m_validasi_pass($email_lama, $password);
                if ($data == false) {
                    echo 'Sorry !! Password akun salah';
                } else {
                    $this->M_userprofil->m_update_email($email_lama, $email);
                    echo 'Email berhasil diubah';
                }
            }
        }
    }
    function cek_password()
    {
        $email_lama = $this->input->cookie('session');
        $password = $this->input->post('password');

        $data = $this->M_userprofil->m_validasi_pass($email_lama, $password);
        if ($data == false) {
            echo 'invalid';
        } else {
            echo 'valid';
        }
    }

    function update_password()
    {
        $email_lama = $this->input->cookie('session');
        $password = $this->input->post('pass-lama');
        $pass_baru = $this->input->post('pass-baru');
        if ($password == $pass_baru) {
            echo 'Passswor tidak boleh sama dengan password sebelumnya!';
        } else {
            $data = $this->M_userprofil->m_validasi_pass($email_lama, $password);
            if ($data == false) {
                echo 'Validasi password salah!';
            } else {
                $this->M_userprofil->m_update_password($email_lama, $pass_baru);
                echo 'valid';
            }
        }
    }
}
