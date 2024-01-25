<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	var $template = 'templates/index';

	public $session;
	public $form_validation;
	public $M_auth;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_auth');
	}

	public function index()
	{
		$session = $this->session->userdata('status');

		if ($session == '') {
			$this->load->view('page_admin/login/login');
		} else {
			redirect('Dashboard');
		}
	}

	public function login_adm()
	{
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() == TRUE) {
			$email = trim($_POST['email']);
			$password = trim($_POST['password']);

			$data = $this->M_auth->login($email, $password);

			if ($data == false) {
				$this->session->set_flashdata('result_login', '<br>Email atau Password yang anda masukkan salah.');
				redirect('Auth');
			} else {
				$session = [
					'userdata' => $data,
					'status' => "Loged in"
				];
				$this->session->set_userdata($session);
				redirect('Dashboard');
			}
		} else {
			$this->session->set_flashdata('result_login', '<br>email Dan Password Harus Diisi.');
			redirect('Auth');
		}
	}
	function insert_password()
	{
		$password = $_POST['password'];
		$email = $_POST['email'];
		// $remember = $_POST['remember'];
		// $id_customer = $_POST['akun'];

		if ($_POST) {
			$email = $_POST['email'];
		} else {
			if (isset($_COOKIE['id-customer'])) {
				$_POST['email'] = $email  = $_COOKIE['id-customer'];
			}
		}
		// Set Cookie 7  hari 
		if (isset($_POST['remember'])) {
			setcookie('session', $_POST['email'], strtotime('+7 days'), '/');
			$msg = 'Data cookie berhasil disimpan';
			echo $msg . '--' . $email;
		}
		// $this->M_auth->m_insert_password($password, $email);
	}
	function login()
	{
		// $post_email = trim($email);
		// $post_pass = trim($password);
		// // echo $post_email, $post_pass;

		// $data = $this->M_auth->login_customer($post_email, $post_pass);
		// $action = $data;
		// if ($data == false) {
		// 	echo 'gagal-login';
		// 	$this->session->set_flashdata('result_login', '<br>Email atau Password yang anda masukkan salah.');
		// 	redirect('Auth');
		// } else {
		// 	// echo 'login-berhasil ';
		// 	if ($_POST) {
		// 		$id_customer = $data->email;
		// 	} else {
		// 		if (isset($_COOKIE['id-customer'])) {
		// 			$data->email = $id_customer  = $_COOKIE['id-customer'];
		// 		}
		// 	}
		// 	// Set Cookie 7  hari 
		// 	if (isset($_POST['remember'])) {
		// 		setcookie('session', $data->email, strtotime('+7 days'), '/');
		// 		$msg = 'Data cookie berhasil disimpan';
		// 	}
		// }
	}

	// function logout()
	// {
	// 	$this->session->sess_destroy();
	// 	$this->session->set_flashdata('sukses', 'Anda Telah Keluar dari Aplikasi');
	// 	redirect('home');
	// }
	function logout()
	{
		// if (isset($_POST['hapus_cookie'])) {
		setcookie('session', '', 1, '/');
		// }
	}
	function logout_adm()
	{
		$this->session->sess_destroy();
		$this->session->set_flashdata('sukses', 'Anda Telah Keluar dari Aplikasi');
		redirect('Auth');
	}
}


/* End of file Login.php */
/* Location: ./application/controllers/Login.php */