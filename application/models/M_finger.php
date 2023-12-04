<?php

use Illuminate\Support\Arr;

defined('BASEPATH') or exit('No direct script access allowed');

class M_finger extends CI_Model
{
    function m_simpan_absen($data)
    { 
        $result = $this->db->insert('tb_absen', $data);
        return $result;
    }
}
