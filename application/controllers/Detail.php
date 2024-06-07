<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Detail extends CI_Controller
{
    public $M_detail;
    public $M_auth;
    public $db;
    public $uri;
    public $session;
    public $input;
    var $template = 'tmpt_client/index';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_detail');
        $this->load->model('M_auth');
    }
    function event()
    {
        $nm_event             = preg_replace("![^a-z0-9]+!i", " ", $this->uri->segment(3));
        $this->db->select("*");
        $this->db->where("nm_event", $nm_event);
        $query_ = $this->db->get('event');
        if ($query_->num_rows() > 0) {
            foreach ($query_->result() as $event) {
                $desc_event = substr($event->desc_event, 0, 160);
                // $img = resize_image('/path/to/some/image.jpg', 200, 200);
            }
        }

        $data['tittle']          = $nm_event;
        $data['description']     = $desc_event;
        $data['script1']         = 'Detail Event';
        $data['content']         = 'client/page_detail/page_detail';
        $data['script']          = 'client/page_detail/page_detail_js';
        $this->load->view($this->template, $data);
    }
    function resize_image($file, $w, $h, $crop=FALSE) {
        list($width, $height) = getimagesize($file);
        $r = $width / $height;
        if ($crop) {
            if ($width > $height) {
                $width = ceil($width-($width*abs($r-$w/$h)));
            } else {
                $height = ceil($height-($height*abs($r-$w/$h)));
            }
            $newwidth = $w;
            $newheight = $h;
        } else {
            if ($w/$h > $r) {
                $newwidth = $h*$r;
                $newheight = $h;
            } else {
                $newheight = $w/$r;
                $newwidth = $w;
            }
        }
        $src = imagecreatefromjpeg($file);
        $dst = imagecreatetruecolor($newwidth, $newheight);
        imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
    
        return $dst;
    }
    function detail()
    {

        $nm_event             = preg_replace("![^a-z0-9]+!i", " ", $this->uri->segment(3));
        $data['event']        = $this->M_detail->m_event($nm_event);
        $data['perform']      = $this->M_detail->m_perform($nm_event);
        $data['tiket']        = $this->M_detail->m_tiket($nm_event);
        $this->load->view('client/detail/detail', $data);
        $this->load->view('client/detail/detail_js');
    }

    function cek_transaksi()
    {
        $email = $this->input->cookie('session');
        $this->db->select("*");
        $this->db->where("email", $email);

        $query_ = $this->db->get('customer');
        if ($query_->num_rows() <> 0) {
            $data_ = $query_->row();
            $id_customer = $data_->id_customer;
        }
        $nm_event = preg_replace("![^a-z0-9]+!i", " ", $this->input->post('event'));
        $cek_transaki        = $this->M_detail->m_cek_transaksi($nm_event, $id_customer);
        if ($cek_transaki['num_rows'] > 0) {
            echo 'no';
        } else {
            echo 'buy';
        }
    }
    function buynow()
    {
        $nm_event = preg_replace("![^a-z0-9]+!i", " ", $this->uri->segment(3));
        if ($this->input->cookie('session') == '') {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $action = '';
            if ($password == '') {
                $this->reg_email($email, $action);
            } else {
                $this->login($email, $password);
            }
        } else {
            // echo'ya';
            $email = $this->input->cookie('session');
            $nm_event = preg_replace("![^a-z0-9]+!i", " ", $this->uri->segment(3));
            $this->to_page_buynow($nm_event, $email);
        }
    }


    function login($email, $password)
    {
        $post_email = trim($email);
        $post_pass = trim($password);
        // echo $post_email, $post_pass;

        $data = $this->M_auth->login_customer($post_email, $post_pass);
        $action = $data;
        if ($data == false) {
            echo 'gagal-login';
            // $this->session->set_flashdata('result_login', '<br>Email atau Password yang anda masukkan salah.');
            // redirect('Auth');
        } else {
            // echo 'login-berhasil ';
            if ($_POST) {
                $id_customer = $data->email;
            } else {
                if (isset($_COOKIE['id-customer'])) {
                    $data->email = $id_customer  = $_COOKIE['id-customer'];
                }
            }
            // Set Cookie 7  hari
            if (isset($_POST['remember'])) {
                setcookie('session', $data->email, strtotime('+7 days'), '/');
                $msg = 'Data cookie berhasil disimpan';
            }
            $this->reg_email($email, $action, $id_customer);
        }
        // redirect('Dashboard');
    }
    function reg_email($email, $action)
    {
        $reg_email        = $this->M_detail->m_reg_email($email);
        if ($reg_email['num_rows'] > 0) {
            // echo 'show';
            foreach ($reg_email['result'] as $customer) {
                if ($customer->password == '') {
                    // echo 'show-not-pass';
                    $nm_event = preg_replace("![^a-z0-9]+!i", " ", $this->uri->segment(3));
                    $this->to_page_buynow($nm_event, $email);
                } else {
                    if ($action == true) {
                        // echo 'berhasil';
                        $nm_event = preg_replace("![^a-z0-9]+!i", " ", $this->uri->segment(3));
                        $this->to_page_buynow($nm_event, $email);
                    } else {

                        echo 'show';
                    }
                }
            }
        } else {
            // echo 'hide';
            $data_customer = [
                'email' => $email
            ];

            $this->M_detail->m_save_customer($data_customer);
            $nm_event = preg_replace("![^a-z0-9]+!i", " ", $this->uri->segment(3));
            $this->to_page_buynow($nm_event, $email);
        }
    }

    function to_page_buynow($nm_event, $email)
    {
        $data['data_kategori'] = $_POST['kategori_tiket'];
        $data['data_count'] = $_POST['count_tiket'];
        $data['event']        = $this->M_detail->m_event($nm_event);
        $data['customer']        = $this->M_detail->m_customer($email);
        $this->load->view('client/buynow/buynow', $data);
        $this->load->view('client/buynow/buynow_js');
    }
}
