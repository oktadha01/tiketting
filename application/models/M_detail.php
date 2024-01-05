<?php

use Illuminate\Support\Arr;

defined('BASEPATH') or exit('No direct script access allowed');

class M_detail extends CI_Model
{

    function m_perform($nm_event)
    {
        $this->db->select('*');
        $this->db->from('perform');
        $this->db->Join('event', 'event.id_event = perform.id_event');
        $this->db->where('nm_event', $nm_event);
        $query = $this->db->get();
        return $query->result();
    }
    function m_event($nm_event)
    {
        $this->db->select('user.agency,user.id_user, event.*');
        $this->db->from('user');
        $this->db->Join('event', 'event.id_user = user.id_user');
        $this->db->where('nm_event', $nm_event);
        $query = $this->db->get();
        return $query->result();
    }
    function m_tiket($nm_event)
    {
        $this->db->select('*');
        $this->db->from('price');
        $this->db->Join('event', 'event.id_event = price.id_event');
        $this->db->where('nm_event', $nm_event);
        $query = $this->db->get();
        return $query->result();
    }
    function m_reg_email($email)
    {
        $this->db->select('*');
        $this->db->from('customer');
        $this->db->where('email', $email);
        // $this->db->where_not_in('password', '');
        $query = $this->db->get();
        $q['result'] = $query->result();
        $q['num_rows'] = $query->num_rows();
        return $q;
    }
    function m_save_customer($data_customer)
    {
        $result = $this->db->insert('customer', $data_customer);
        return $result;
    }
    function m_customer($email)
    {
        $this->db->select('*');
        $this->db->from('customer');
        $this->db->where('email', $email);
        $query = $this->db->get();
        return $query->result();
    }
}
