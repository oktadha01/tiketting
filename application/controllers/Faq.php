<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Faq extends CI_Controller
{
    var $template = 'tmpt_client/index';
    public function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $data['tittle']          = 'FAQ';
        $data['content']         = 'client/faq/faq';
        $data['script']         = 'client/faq/faq_js';
        $this->load->view($this->template, $data);
    }
}
