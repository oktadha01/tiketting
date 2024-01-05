<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Transaction extends CI_Controller
{
    public $M_transaksi;
    public $db;
    public $uri;
    public $session;
    public $input;
    var $template = 'tmpt_client/index';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_transaksi');
    }
    function CB()
    {
        $email = $this->input->cookie('session');
        $code_bayar = $this->uri->segment(3);
        $data['tittle']          = 'Detail Event';
        $data['script1']          = 'Detail Event';
        $data['transaksi']        = $this->M_transaksi->m_data_transaksi($email, $code_bayar);
        $data['content']         = 'client/transaction/transaction';
        $data['script']         = 'client/transaction/transaction_js';
        $this->load->view($this->template, $data);
    }
}
