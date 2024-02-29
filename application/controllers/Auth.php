<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	var $template = 'templates/index';

	public $session;
	public $form_validation;
	public $M_auth;
	public $input;
	public $db;
	public $email;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_auth');
	}

	public function index()
	{
		$cookies = $this->input->cookie('session');

		if ($cookies == '') {
			$this->load->view('client/login/login');
		} else {
			redirect('Home');
		}
	}

	public function login_client()
	{
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() == TRUE) {
			$post_email = trim($_POST['email']);
			$post_pass = trim($_POST['password']);
			$data = $this->M_auth->login_customer($post_email, $post_pass);

			if ($data == false) {
				$this->session->set_flashdata('result_login', '<br>Email atau Password yang anda masukkan salah.');

				redirect('Auth');
			} else {
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
					redirect('Home');
				}
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
			// $msg = 'Data cookie berhasil disimpan';
			// echo $msg . '--' . $email;
			$this->M_auth->m_insert_password($password, $email);
		}
	}
	function regist_akun()
	{
		$email = $_POST['email'];
		$this->db->select("email");
		$this->db->where("email", $email);
		$query_ = $this->db->get('customer');
		if ($query_->num_rows() == 0) {
			$data = [

				'email' => $_POST['email'],
				'nm_customer' => $_POST['nama'],
				'tgl_lahir' => $_POST['tgl_lahir'],
				'gender' => $_POST['gender'],
				'kontak' => $_POST['kontak'],
				'no_identitas' => $_POST['no_identitas'],
				'kota' => $_POST['kota'],
				'password' => md5($_POST['password']),
			];
			$this->M_auth->m_insert_regist($data);
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
				redirect('Home');
			}
		} else {
			$this->session->set_flashdata('result_login', '<br>Email sudah terdaftar');
			redirect('Auth');
		}
	}

	function login()
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
				redirect('Auth/login');
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
			redirect('Auth/login');
		}
	}
	function cek_email_rest_pass()
	{
		$email = $_POST['email'];
		$this->db->select("email");
		$this->db->where("email", $email);
		$query_ = $this->db->get('customer');
		if ($query_->num_rows() > 0) {
			echo $query_->num_rows();
		}
	}
	function ins_token_pass()
	{
		$email = 'oktadha01@gmail.com';
		// $email = $_POST['email'];
		$token = md5($email . date("dmYHis"));
		$this->M_auth->update_token_customer($email, $token);

		$data['token'] = base_url('ResetPassword/token/') . $token;
		$this->db->select("*");
		$this->db->where("email", $email);
		$query_ = $this->db->get('customer');
		$data_cust = $query_->result();
		foreach ($data_cust as $customer) {
			$data['nm_customer'] = $customer->nm_customer;
			$config = [
				'mailtype'  => 'html',
				'charset'   => 'utf-8',
				'protocol'  => 'smtp',
				'smtp_host' => 'mail.wisdil.com',
				'smtp_user' => 'tiket@wisdil.com',  // Email gmail
				'smtp_pass'   => 'tiket123!',  // Password gmail
				// 'smtp_host' => 'smtp.gmail.com',
				// 'smtp_user' => 'Oktadha01@gmail.com',  // Email gmail
				// 'smtp_pass'   => 'rvcw cvny ibav czbh',  // Password gmail
				'smtp_crypto' => 'ssl',
				'smtp_port'   => 465,
				'crlf'    => "\r\n",
				'newline' => "\r\n"
			];

			$email_to_user = $email;
			$this->load->library('email', $config);
			$this->email->from('tiket@wisdil.com', 'Wisdil.com');
			$this->email->to($email_to_user);
			$this->email->subject('Reset Password. Halo ' . $customer->nm_customer . ' Kami mendengar Anda memerlukan pengaturan ulang kata sandi. Klik tautan di bawah dan Anda akan diarahkan ke situs aman tempat Anda dapat menyetel password baru');

			$body = $this->load->view('client/email/temp_rest_pass.php', $data, true);

			$this->email->message($body);

			$this->email->send();
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
		redirect('Home');

		// }
	}
	function logout_adm()
	{
		$this->session->sess_destroy();
		$this->session->set_flashdata('sukses', 'Anda Telah Keluar dari Aplikasi');
		redirect('Auth/login');
	}
}


/* End of file Login.php */
/* Location: ./application/controllers/Login.php */