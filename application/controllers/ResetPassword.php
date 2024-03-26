<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ResetPassword extends CI_Controller
{
    var $template = 'tmpt_client/index';


    public $session;
    public $uri;
    public $db;

    public function __construct()
    {

        parent::__construct();
        // $this->load->model('M_auth');
    }
    function token()
    {
        if ($this->uri->segment(3) == '') {
            redirect();
        } else {
            $data['tittle']          = 'Wisdil.com';
            // $data['event_data_ready']      = $this->M_home->data_event_ready();
            // $data['banner']          = $this->M_home->data_banner();
            $data['content']         = 'client/resetpassword/resetpassword';
            $data['script']          = 'client/resetpassword/resetpassword_js';
            $this->load->view($this->template, $data);
        }
    }

    function cek_token()
    {
        $token_password = $_POST['token'];
        $this->db->select("token_password");
        $this->db->where("token_password", $token_password);
        $query_ = $this->db->get('customer');
        if ($query_->num_rows() > 0) {
            echo $query_->num_rows();
        }
    }

    function set_password()
    {
        $token_password = $_POST['token'];
        $password = $_POST['password'];

        $this->db->select("token_password");
        $this->db->where("token_password", $token_password);
        $query_ = $this->db->get('customer');
        if ($query_->num_rows() > 0) {
            echo 'success';
            $update = $this->db->set('password', md5($password))
                ->set('token_password', '')
                ->where('token_password', $token_password)
                ->update('customer');
            return $update;
        } else {
            echo 'invalid';
        }
    }
}
