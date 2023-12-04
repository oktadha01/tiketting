<?php

use Illuminate\Support\Arr;

defined('BASEPATH') or exit('No direct script access allowed');

class M_kehadiran extends CI_Model
{
    function m_karyawan()
    {
        $this->db->select('*');
        $this->db->from('karyawan');
        $query = $this->db->get();
        return $query->result();
    }
    function m_absen()
    {
        $this->db->select('*');
        $this->db->from('tb_absen');
        $query = $this->db->get();
        return $query->result();
    }
    function m_hadir($bulan)
    {
        $this->db->select('COUNT(*) as jumlah, code_karyawan AS code_kar');
        $this->db->from('tb_absen');
        // $this->db->where_not_in('jam_masuk', '');
        $this->db->where('MONTH(STR_TO_DATE(tb_absen.tgl_absen, "%d-%m-%Y")) =' . $bulan);
        // $this->db->where_not_in('jam_keluar', '');

        $this->db->group_by('code_kar');
        $query = $this->db->get();
        $q['result'] = $query->result();
        $q['num_rows'] = $query->num_rows();
        return $q;
    }
    function m_luar_kota($bulan)
    {
        $this->db->select('COUNT(*) as jumlah, code_karyawan AS code_kar');
        $this->db->from('tb_izin');
        $this->db->where('status_izin', 'luar kota');
        $this->db->where('MONTH(STR_TO_DATE(tb_izin.tgl_izin, "%d-%m-%Y")) =' . $bulan);
        $this->db->group_by('code_kar');
        $query = $this->db->get();
        $q['result'] = $query->result();
        $q['num_rows'] = $query->num_rows();
        return $q;
    }
    function m_izin($bulan)
    {
        $this->db->select('COUNT(*) as jumlah, code_karyawan AS code_kar');
        $this->db->from('tb_izin');
        // $this->db->where_in('jam_keluar','');
        $this->db->where('status_izin', 'izin');
        $this->db->where('MONTH(STR_TO_DATE(tb_izin.tgl_izin, "%d-%m-%Y")) =' . $bulan);
        $this->db->group_by('code_kar');
        $query = $this->db->get();
        $q['result'] = $query->result();
        $q['num_rows'] = $query->num_rows();
        return $q;
    }
    function m_mangkir($bulan)
    {
        $this->db->select('COUNT(*) as jumlah, tb_absen.code_karyawan AS code_kar , status_izin');
        // $this->db->select('tb_absen.*,tb_absen.code_karyawan as code_kar, tb_izin.*');
        $this->db->from('tb_absen');
        $this->db->join('tb_izin', 'tb_izin.code_karyawan = tb_absen.code_karyawan AND tb_izin.tgl_izin = tb_absen.tgl_absen', 'left');
        $this->db->where('MONTH(STR_TO_DATE(tb_absen.tgl_absen, "%d-%m-%Y")) =' . $bulan );
        $this->db->where('jam_masuk','');
        $this->db->where('status_izin IS NULL');
        $this->db->where('status_absen', '');
        $this->db->group_by('code_kar');
        $query = $this->db->get();
        $q['result'] = $query->result();
        $q['num_rows'] = $query->num_rows();
        return $q;
    }
    function m_telat($bulan)
    {
        $this->db->select('*, tb_absen.code_karyawan as code_kar');
        $this->db->from('tb_absen');
        $this->db->join('tb_izin', 'tb_izin.code_karyawan = tb_absen.code_karyawan AND tb_izin.tgl_izin = tb_absen.tgl_absen', 'left');
        $this->db->where('MONTH(STR_TO_DATE(tb_absen.tgl_absen, "%d-%m-%Y")) =' . $bulan);
        $this->db->where('status_izin', null);
        $this->db->where('jam_masuk >=', '08:15');
        // $this->db->group_by('code_kar');
        $query = $this->db->get();
        $q['result'] = $query->result();
        $q['num_rows'] = $query->num_rows();
        return $q;
    }
    function m_izintelat()
    {
        $this->db->select('*');
        $this->db->from('tb_absen');
        // $this->db->where_not_in('jam_masuk','');
        // $this->db->where_not_in('jam_keluar','');
        // $this->db->group_by('code_kar');
        $query = $this->db->get();
        $q['result'] = $query->result();
        $q['num_rows'] = $query->num_rows();
        return $q;
    }
    function m_libur($bulan)
    {
        $this->db->select('COUNT(*) as jumlah, code_karyawan AS code_kar');
        $this->db->from('tb_absen');
        // $this->db->where_in('jam_keluar','');
        $this->db->where('status_absen', 'libur');
        $this->db->where('MONTH(STR_TO_DATE(tb_absen.tgl_absen, "%d-%m-%Y")) =' . $bulan);
        $this->db->group_by('code_kar');
        $query = $this->db->get();
        $q['result'] = $query->result();
        $q['num_rows'] = $query->num_rows();
        return $q;
    }
    function m_cuti($bulan)
    {
        $this->db->select('COUNT(*) as jumlah, code_karyawan AS code_kar');
        $this->db->from('tb_izin');
        // $this->db->where_in('jam_keluar','');
        $this->db->where('status_izin', 'cuti');
        $this->db->where('MONTH(STR_TO_DATE(tb_izin.tgl_izin, "%d-%m-%Y")) =' . $bulan);
        $this->db->group_by('code_kar');
        $query = $this->db->get();
        $q['result'] = $query->result();
        $q['num_rows'] = $query->num_rows();
        return $q;
    }
}