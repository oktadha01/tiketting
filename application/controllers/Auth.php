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
			$this->load->view('office/login/login');
		} else {
			redirect('Dashboard');
		}
	}

	public function login()
	{
		$this->form_validation->set_rules('username', 'Username', 'required|min_length[4]|max_length[15]');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() == TRUE) {
			$username = trim($_POST['username']);
			$password = trim($_POST['password']);

			$data = $this->M_auth->login($username, $password);

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
}


/* End of file Login.php */
/* Location: ./application/controllers/Login.php */