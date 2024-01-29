<?php

use Illuminate\Support\Arr;

defined('BASEPATH') or exit('No direct script access allowed');

class M_userprofil extends CI_Model
{
    function m_customer($email)
    {
        $this->db->select('*');
        $this->db->from('customer');
        $this->db->where('email', $email);
        $query = $this->db->get();
        return $query->result();
    }
}
