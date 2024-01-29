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
}
