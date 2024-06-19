<?php

use Illuminate\Support\Arr;

defined('BASEPATH') or exit('No direct script access allowed');

class M_buynow extends CI_Model
{

    function m_cek_stock()
    {
        $this->db->select('*');
        $this->db->from('price');
        // $this->db->where('id_price', );
        $query = $this->db->get();
        $q['result'] = $query->result();
        $q['num_rows'] = $query->num_rows();
        return $q;
    }

    public function save_tiket($data)
    {
        $this->db->insert_batch('tiket', $data);
        return $this->db->affected_rows();
    }
    function update_customer($id_customer, $email, $nama, $tgl_lahir, $gender, $kontak, $no_identitas, $kota)
    {
        $update = $this->db->set('nm_customer', $nama)
            ->set('email', $email)
            ->set('tgl_lahir', $tgl_lahir)
            ->set('gender', $gender)
            ->set('kontak', $kontak)
            ->set('no_identitas', $no_identitas)
            ->set('kota', $kota)
            ->where('id_customer', $id_customer)
            ->update('customer');
        return $update;
    }
    function insert_transaksi($data_transaksi)
    {
        $this->db->insert('transaksi', $data_transaksi);
        if ($this->db->affected_rows() > 0) {
            redirect(base_url('Callback/event_free_tiket/') . $data_transaksi['code_bayar']);
        } else {
            return false;
        }
    }

    function insert_transaksi_free($saldo) {
        return $this->db->insert('saldo', $saldo);
    }

    function update_stok_tiket($id_price, $stock_tiket)
    {
        $update = $this->db->set('stock_tiket', $stock_tiket)
            ->where('id_price', $id_price)
            ->update('price');
        return $update;
    }
}