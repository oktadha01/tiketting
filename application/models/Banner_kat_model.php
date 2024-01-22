<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Banner_kat_model extends CI_Model
{
    var $column_ordertrx = array(null, 'id_banner', 'header');
    var $column_searchtrx = array('id_banner', 'header');
    var $ordertrx = array('id_banner' => 'asc');

    private function _get_datatables_trx()
    {
            $this->db->select('*');
            $this->db->from('banner');
            $this->db->order_by('id_banner', 'DESC');

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
        $this->_get_datatables_trx();
        return $this->db->count_all_results();
    }

    public function update_data($table, $data, $id_banner) {
        $this->db->where('id_banner', $id_banner);
        return $this->db->update($table, $data);
    }

    function save_banner($data) {
        return $this->db->insert('banner', $data);
    }

    public function delete_banner($banner_id) {
        $this->db->where('id_banner', $banner_id);
        $this->db->delete('banner');
    }

    public function get_banner_data($banner_id) {
        $query = $this->db->get_where('banner', array('id_banner' => $banner_id));
        return $query->row_array();
    }

}