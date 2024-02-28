<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Home extends CI_Controller
{
    public $M_home;
    var $template = 'tmpt_client/index';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_home');
    }
    function index()
    {
        $data['tittle']          = 'Wisdil.com';
        $data['event_data_ready']      = $this->M_home->data_event_ready();
        $data['banner']          = $this->M_home->data_banner();
        $data['content']         = 'client/home/home';
        $data['script']          = 'client/home/home_js';
        $this->load->view($this->template, $data);
    }
}