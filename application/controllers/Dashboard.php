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
        // $this->load->model('M_dashboard');

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

        $this->load->view($this->template, $data);
    }


    public function showPaymentChannels()
    {
        $data['userdata']        = $this->userdata;
        $data['tittle']          = 'Dashboard';
        $data['content']         = 'page_admin/pay_chanel/chanel_payout';
        $data['script']          = 'page_admin/pay_chanel/chanel_payout_js';

        $this->load->view($this->template, $data);
    }


}