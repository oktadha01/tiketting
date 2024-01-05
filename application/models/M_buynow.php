<?php

use Illuminate\Support\Arr;

defined('BASEPATH') or exit('No direct script access allowed');

class M_buynow extends CI_Model
{
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
        return $this->db->affected_rows();
    }
}
