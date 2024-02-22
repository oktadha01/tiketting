<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Custom_tiket extends AUTH_Controller
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
        $this->load->model('');

    }

    public function index()
    {
        $data['userdata']        = $this->userdata;
        $data['tittle']          = 'Custom tiket';
        $data['bread']           = 'Custom Tiket';
        $data['content']         = 'page_admin/custom_tiket/tiket';
        $data['script']          = 'page_admin/custom_tiket/tiket_js';
        $this->load->view($this->template, $data);
    }

    function upload_backround()
    {
        $config['upload_path'] = "./upload/backround_tiket";
        $config['allowed_types'] = 'gif|jpg|png';
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('header')) {
            $upload_data = $this->upload->data();
            $header = $upload_data['file_name'];
        } else {
            $header = '';
        }

        $data = array(
            'header'         => $header
        );

        $result = $this->Banner_kat_model->save_banner($data);

        if ($result) {
            $response = array('status' => 'success', 'message' => 'Data berhasil disimpan.');
        } else {
            $response = array('status' => 'error', 'message' => 'Gagal menyimpan data.');
        }

        echo json_encode($response);
    }

}