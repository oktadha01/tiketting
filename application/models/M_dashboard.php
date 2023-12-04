<?php

use Illuminate\Support\Arr;

defined('BASEPATH') or exit('No direct script access allowed');

class M_dashboard extends CI_Model
{
    function m_karyawan()
    {
        $this->db->select('*');
        $this->db->from('karyawan');
        // $this->db->join('tb_absen', 'tb_absen.tgl_izin = karyawan.code_karyawan');
        // $this->db->where('id_perum', '1');

        // $this->db->group_by('nm_perum');
        // $this->db->order_by('tgl_event', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    function m_dept()
    {
        $this->db->select('*');
        $this->db->from('karyawan');
        $this->db->group_by('dept');
        $query = $this->db->get();
        return $query->result();
    }
    function m_absen($bulan)
    {
        // $bulan = '10';
        $this->db->select('tb_absen.*,tb_absen.code_karyawan as code_kar, tb_izin.*, karyawan.hari_kerja');
        $this->db->from('tb_absen');
        $this->db->join('tb_izin', 'tb_izin.code_karyawan = tb_absen.code_karyawan AND tb_izin.tgl_izin = tb_absen.tgl_absen', 'left');
        $this->db->join('karyawan', 'karyawan.code_karyawan = tb_absen.code_karyawan');
        $this->db->where('MONTH(STR_TO_DATE(tb_absen.tgl_absen, "%d-%m-%Y")) =' . $bulan);
        $query = $this->db->get();
        return $query->result();
    }
    function m_izin($bulan)
    {
        $this->db->select('*');
        $this->db->from('tb_absen');
        $this->db->join('tb_izin', 'tb_absen.code_karyawan = tb_izin.code_karyawan AND tb_izin.tgl_izin = tb_absen.tgl_absen', 'full');
        $this->db->where('MONTH(STR_TO_DATE(tb_absen.tgl_absen, "%d-%m-%Y")) =' . $bulan);
        $query = $this->db->get();
        return $query->result();
        
    }
    function m_update_status_absen($id_absen,$status_absen){
        $update = $this->db->set('status_absen', $status_absen)
        ->where('id_absen', $id_absen)
        ->update('tb_absen');
    return $update;
    }
}
