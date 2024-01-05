<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Home extends CI_Controller
{
    public $M_home;
    var $template = 'tmpt_client/index';

    public function __construct()
    {
        parent::__construct();
        // $this->load->model('M_dashboard');
    }
    function index()
    {
        $data['tittle']          = 'Dashboard';
        // $data['absen']        = $this->M_dashboard->m_absen();
        // $data['izin']        = $this->M_dashboard->m_izin();
        $data['content']         = 'client/home/home';
        $data['script']         = 'client/home/home_js';
        $this->load->view($this->template, $data);
    }
}
