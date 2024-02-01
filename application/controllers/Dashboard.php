<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends AUTH_Controller
{
    var $template = 'tmpt_admin/index';

    public $userdata;
    public $M_client;
    public $M_dashboard;
    public $session;
    public $input;
    public $output;
    public $upload;
    public $db;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Dashboard_model');

    }

    public function index()
    {
        $data['userdata']        = $this->userdata;
        $data['tittle']          = 'Dashboard';
        $data['content']         = 'page_admin/dashboard/dashboard_v';
        $data['script']          = 'page_admin/dashboard/dashboard_js';

        // saldo Xendit
        xendit_loaded();
        $getBalance = \Xendit\Balance::getBalance('CASH');
        $balance = $getBalance['balance'];
        $Rp_saldo_xendit = 'Rp. ' . number_format($balance, 0, ',', '.');
        $data['xendit'] = $Rp_saldo_xendit;
        // akhir saldo Xendit

        $id_user         = $this->session->userdata('userdata')->id_user;
        $balance         = $this->Dashboard_model->get_total_nominal($id_user);
        $tiket           = $this->Dashboard_model->get_total_tiket($id_user);
        $terjual         = $this->Dashboard_model->get_tiket_terjual($id_user);

        $Rp_saldo        = 'Rp. ' . number_format($balance, 0, ',', '.');
        $tiket_format    = number_format($tiket, 0, ',', '.');
        $terjual_format    = number_format($terjual, 0, ',', '.');

        $data['saldo'] = $Rp_saldo;
        $data['total_tiket'] = $tiket_format;
        $data['terjual_tiket'] = $terjual_format;

        $this->load->view($this->template, $data);
    }

}