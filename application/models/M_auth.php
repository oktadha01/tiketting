<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
}

/* End of file M_auth.php */
/* Location: ./application/models/M_auth.php */