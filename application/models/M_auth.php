<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_auth extends CI_Model
{
	public function login($email, $password)
	{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('email', $email);
		$this->db->where(
			'password',
			md5($password)
		);

		$data = $this->db->get();

		if ($data->num_rows() == 1) {
			return $data->row();
		} else {
			return false;
		}
	}
	function login_customer($post_email, $post_pass)
	{
		$this->db->select('*');
		$this->db->from('customer');
		$this->db->where('email', $post_email);
		$this->db->where(
			'password',
			md5($post_pass)
		);

		$data = $this->db->get();

		if ($data->num_rows() == 1) {
			return $data->row();
		} else {
			return false;
		}
	}
	function m_insert_password($password, $email)
	{
		$update = $this->db->set('password', md5($password))
			->where('email', $email)
			->update('customer');
		return $update;
	}
	function m_insert_regist($data)
	{
		$this->db->insert('customer', $data);
		return $this->db->affected_rows();
	}
}

/* End of file M_auth.php */
/* Location: ./application/models/M_auth.php */