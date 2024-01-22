<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Xendit_model extends CI_Model
{
    var $column_ordertrx = array(null, 'name', 'value', 'akun', 'status');
    var $column_searchtrx = array('name','value', 'akun', 'status');
    var $ordertrx = array('user.id' => 'asc');

    private function _get_datatables()
    {
            $this->db->select('*');
            $this->db->from('pengaturan');
            $this->db->order_by('id', 'DESC');

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
        $this->_get_datatables();
        if(@$_POST['length'] != -1)
        $this->db->limit(@$_POST['length'], @$_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    function count_filtereds() {
        $this->_get_datatables();
        $query = $this->db->get();
        return $query->num_rows();
    }
    function count_all() {
        $this->db->from('pengaturan');
        return $this->db->count_all_results();
    }

    function hapus($params ='')
    {
        $sql = "DELETE  FROM pengaturan WHERE id = ? ";
        return $this->db->query($sql, $params);
    }

    public function update_data($table, $data, $id) {
        $this->db->where('id', $id);
        return $this->db->update($table, $data);
    }

}