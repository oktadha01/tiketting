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

    function M_update_profil($email, $nama, $tgl_lahir, $gender, $nik, $kota, $kontak)
    {
        $update = $this->db->set('nm_customer', $nama)
            ->set('tgl_lahir', $tgl_lahir)
            ->set('gender', $gender)
            ->set('no_identitas', $nik)
            ->set('kota', $kota)
            ->set('kontak', $kontak)
            ->where('email', $email)
            ->update('customer');
        return $update;
    }

    function m_cek_email($email)
    {

        $this->db->select('*');
        $this->db->from('customer');
        $this->db->where('email', $email);
        $query = $this->db->get();
        $q['result'] = $query->result();
        $q['num_rows'] = $query->num_rows();
        return $q;
    }
    function m_validasi_pass($email_lama, $password)
    {
        $this->db->select('*');
        $this->db->from('customer');
        $this->db->where('email', $email_lama);
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
    function m_update_email($email_lama, $email)
    {
        $update = $this->db->set('email', $email)
            ->where('email', $email_lama)
            ->update('customer');

        setcookie('session', $email, strtotime('+7 days'), '/');
        return $update;
    }
    function m_update_password($email_lama, $pass_baru)
    {
        $update = $this->db->set('password', md5($pass_baru))
            ->where('email', $email_lama)
            ->update('customer');
        return $update;
    }
}
