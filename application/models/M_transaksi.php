<?php

use Illuminate\Support\Arr;

defined('BASEPATH') or exit('No direct script access allowed');

class M_transaksi extends CI_Model
{
    function m_data_transaksi($email, $code_bayar)
    {
        // $bulan = '10';
        $this->db->select('*');
        $this->db->from('customer');
        $this->db->join('transaksi', 'transaksi.id_customer = transaksi.id_customer');
        $this->db->where('customer.email', $email);
        $this->db->where('transaksi.code_bayar', $code_bayar);
        $query = $this->db->get();
        return $query->result();
    }
}
