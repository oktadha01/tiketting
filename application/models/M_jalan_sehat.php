<?php

use Illuminate\Support\Arr;

defined('BASEPATH') or exit('No direct script access allowed');
class M_jalan_sehat extends CI_Model
{
    function m_save_customer($data)
    {
        $result = $this->db->insert_batch('jalan_sehat', $data);
        return $result;
    }
}
