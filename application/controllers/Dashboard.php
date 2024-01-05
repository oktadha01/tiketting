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

    public function virtual_account()
    {
        try {

        $extId = $this->input->post('ext_id');
        $bankCode = $this->input->post('bank_code');
        $name = $this->input->post('name_va');

        xendit_loaded();
        $this->db->trans_begin();

        $params = [
            "external_id" => $extId,
            "bank_code" => $bankCode,
            "name" => $name
        ];

            $createVA = \Xendit\VirtualAccounts::create($params);
            // var_dump($createVA);

            $id = $createVA['id'];

            // $getVABanks = \Xendit\VirtualAccounts::getVABanks($id);
            // var_dump($getVABanks);

            $getVA = \Xendit\VirtualAccounts::retrieve($id);
            var_dump($getVA);



        } catch (\Xendit\Exceptions\ApiException $e) {
            echo 'ApiException: ' . $e->getMessage();
        } catch (\Xendit\Exceptions\XenditException $e) {
            echo 'XenditException: ' . $e->getMessage();
        } catch (Exception $e) {
            echo 'Exception: ' . $e->getMessage();
        }
    }


}