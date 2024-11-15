<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Perform_model extends CI_Model
{
    var $column_ordertrx = array(null, 'event.nm_event', 'nama_artis');
    var $column_searchtrx = array('event.nm_event', 'nama_artis');
    var $ordertrx = array('perform.id_perform' => 'asc');

    private function _get_datatables_trx($privilage, $id_user)
    {

        if ($privilage == 'Admin') {

            $this->db->select('*');
            $this->db->from('perform');
            $this->db->join('event', 'event.id_event = perform.id_event');
            $this->db->order_by('id_perform', 'DESC');

            $i = 0;
            foreach ($this->column_searchtrx as $trx) {
                if (@$_POST['search']['value']) {
                    if ($i === 0) {
                        $this->db->group_start();
                        $this->db->like($trx, $_POST['search']['value']);
                    } else {
                        $this->db->or_like($trx, $_POST['search']['value']);
                    }
                    if (count($this->column_searchtrx) - 1 == $i)
                        $this->db->group_end();
                }
                $i++;
            }

            if (isset($_POST['order'])) {
                $this->db->order_by($this->column_ordertrx[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            } else if (isset($this->order)) {
                $order = $this->order;
                $this->db->order_by(key($order), $order[key($order)]);
            }
        } else if ($privilage == 'User') {

            $this->db->select('*');
            $this->db->from('perform');
            $this->db->join('event', 'event.id_event = perform.id_event');
            $this->db->where('event.id_user', $id_user);
            $this->db->order_by('id_perform', 'DESC');

            $i = 0;
            foreach ($this->column_searchtrx as $trx) {
                if (@$_POST['search']['value']) {
                    if ($i === 0) {
                        $this->db->group_start();
                        $this->db->like($trx, $_POST['search']['value']);
                    } else {
                        $this->db->or_like($trx, $_POST['search']['value']);
                    }
                    if (count($this->column_searchtrx) - 1 == $i)
                        $this->db->group_end();
                }
                $i++;
            }

            if (isset($_POST['order'])) {
                $this->db->order_by($this->column_ordertrx[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            } else if (isset($this->order)) {
                $order = $this->order;
                $this->db->order_by(key($order), $order[key($order)]);
            }
        }
    }



    function get_datatablest($privilage, $id_user)
    {
        $this->_get_datatables_trx($privilage, $id_user);
        if (@$_POST['length'] != -1)
            $this->db->limit(@$_POST['length'], @$_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    function count_filtereds($privilage, $id_user)
    {
        $this->_get_datatables_trx($privilage, $id_user);
        $query = $this->db->get();
        return $query->num_rows();
    }
    function count_all_trx($privilage, $id_user)
    {
        $this->_get_datatables_trx($privilage, $id_user);
        return $this->db->count_all_results();
    }

    function hapus_perform($params = '')
    {
        $sql = "DELETE  FROM perform WHERE id_perform = ? ";
        return $this->db->query($sql, $params);
    }

    function save_perform($data)
    {
        return $this->db->insert('perform', $data);
    }

    public function update_data($table, $data, $id_perform)
    {
        $this->db->where('id_perform', $id_perform);
        return $this->db->update($table, $data);
    }

    function get_event($privilage, $id_user)
    {
        if ($privilage == 'Admin') {

            $this->db->select('*');
            $this->db->from('event');
            $query = $this->db->get();

            return $query->result();
        } else if ($privilage == 'User') {

            $this->db->select('*');
            $this->db->from('event');
            $this->db->where('event.id_user', $id_user);
            $query = $this->db->get();

            return $query->result();
        }
    }
}
