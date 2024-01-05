<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_auth extends CI_Model {
	public function login($post_email,$post_pass) {
		$this->db->select('*');
		$this->db->from('customer');
		$this->db->where('email', $post_email);
		$this->db->where('password', md5($post_pass)
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