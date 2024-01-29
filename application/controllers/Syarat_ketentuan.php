<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Syarat_ketentuan extends CI_Controller
{
    var $template = 'tmpt_client/index';
    public function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $data['tittle']          = 'Syarat $ Ketentuan';
        // $data['absen']        = $this->M_dashboard->m_absen();
        // $data['izin']        = $this->M_dashboard->m_izin();
        $data['content']         = 'client/syarat_ketentuan/syarat_ketentuan';
        $data['script']         = 'client/syarat_ketentuan/syarat_ketentuan_js';
        $this->load->view($this->template, $data);
    }
}
