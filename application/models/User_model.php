<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{
    var $column_ordertrx = array(null, 'agency', 'nm_user', 'email', 'kontak');
    var $column_searchtrx = array('agency', 'nm_user','alamat', 'email', 'kontak');
    var $ordertrx = array('user.id_user' => 'asc');

    private function _get_datatables_trx()
    {
            $this->db->select('*');
            $this->db->from('user');
            $this->db->order_by('id_user', 'DESC');

            $i = 0;
            foreach ($this->column_searchtrx as $trx) {
                if(@$_POST['search']['value']) {
                    if($i===0) {
                        $this->db->group_start();
                        $this->db->like($trx, $_POST['search']['value']);
                    } else {
                        $this->db->or_like($trx, $_POST['search']['value']);
                    }
                    if(count($this->column_searchtrx) - 1 == $i)
                        $this->db->group_end();
                }
                $i++;
            }

            if(isset($_POST['order'])) {
                $this->db->order_by($this->column_ordertrx[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            }  else if(isset($this->order)) {
                $order = $this->order;
                $this->db->order_by(key($order), $order[key($order)]);
            }
        }

    function get_datatablest() {
        $this->_get_datatables_trx();
        if(@$_POST['length'] != -1)
        $this->db->limit(@$_POST['length'], @$_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    function count_filtereds() {
        $this->_get_datatables_trx();
        $query = $this->db->get();
        return $query->num_rows();
    }
    function count_all_trx() {
        $this->db->from('user');
        return $this->db->count_all_results();
    }

    function hapus_user($params ='')
    {
        $sql = "DELETE  FROM user WHERE id_user = ? ";
        return $this->db->query($sql, $params);
    }

    function save_user($data) {
        return $this->db->insert('user', $data);
    }

    public function update_data($table, $data, $id) {
        $this->db->where('id_user', $id);
        return $this->db->update($table, $data);
    }

    public function update_pass($data, $id)
	{
		$this->db->where("id_user", $id);
		$this->db->set($data);
		$this->db->update("user", $data);
		return $this->db->affected_rows();
	}

    public function select($id = '')
	{
		if ($id != '') {
			$this->db->where('id_user', $id);
		}

		$data = $this->db->get('user');

		return $data->row();
	}

}