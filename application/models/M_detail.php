<?php

use Illuminate\Support\Arr;

defined('BASEPATH') or exit('No direct script access allowed');

class M_detail extends CI_Model
{

    function m_cek_transaksi($nm_event, $id_customer)
    {
        $this->db->select('transaksi.id_event, transaksi.id_customer');
        $this->db->from('transaksi');
        $this->db->Join('event', 'event.id_event = transaksi.id_event');
        $this->db->where('event.nm_event', $nm_event);
        $this->db->where('transaksi.id_customer', $id_customer);
        $this->db->where('transaksi.status_transaksi', 'PENDING');
        // $this->db->where_not_in('password', '');
        $query = $this->db->get();
        $q['result'] = $query->result();
        $q['num_rows'] = $query->num_rows();
        return $q;
    }

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
        $this->db->select('event.*, wilayah_kabupaten.id,wilayah_kabupaten.nama, user.id_user, user.agency, user.alamat');
        $this->db->from('event');
        $this->db->join('wilayah_kabupaten', 'wilayah_kabupaten.id = event.kota');
        $this->db->Join('user', 'user.id_user = event.id_user');
        $this->db->where('event.nm_event', $nm_event);
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