<?php

use Illuminate\Support\Arr;

defined('BASEPATH') or exit('No direct script access allowed');

class M_izin extends CI_Model
{
    function m_data_karyawan()
    {
        $this->db->select('*');
        $this->db->from('karyawan');

        // $this->db->group_by('dept');
        $query = $this->db->get();
        return $query->result();
    }
    function m_data_izin($bulan)
    {
        $this->db->select('*');
        $this->db->from('karyawan');
        $this->db->join('tb_izin', 'tb_izin.code_karyawan = karyawan.code_karyawan');
        $this->db->where('MONTH(STR_TO_DATE(tb_izin.tgl_izin, "%d-%m-%Y")) =' . $bulan);
        $this->db->order_by('tgl_izin', 'desc');
        $this->db->order_by('id_izin', 'desc');
        $query = $this->db->get();
        return $query->result();
    }
    function m_simpan_izin($data)
    {
        $result = $this->db->insert('tb_izin', $data);
        return $result;
    }
    function m_hapus_izin($id_izin)
	{
		$delete = $this->db->where('id_izin', $id_izin)
			->delete('tb_izin');
		return $delete;
	}
    function m_ubah_hari_kerja($code_karyawan, $hari_kerja)
    {
        $update = $this->db->set('hari_kerja', $hari_kerja)
            ->where('code_karyawan', $code_karyawan)
            ->update('karyawan');
        return $update;
    }
}
