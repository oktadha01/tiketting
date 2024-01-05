<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Event_model extends CI_Model
{
    var $column_ordertrx = array(null, 'id_user', 'nm_event', 'tgl_event', 'jam_event', 'batas_pesan', 'wilayah_kabupaten.nama', 'kota');
    var $column_searchtrx = array('agency', 'nm_event', 'tgl_event', 'jam_event', 'batas_pesan', 'lokasi', 'kota', 'mc_by');
    var $ordertrx = array('event.id_event' => 'asc');

    private function _get_datatables_trx($privilage, $id_user)
    {

        if ($privilage == 'Admin') {

            $this->db->select('event.*, user.id_user, user.agency, wilayah_kabupaten.*');
            $this->db->from('event');
            $this->db->join('user', 'user.id_user = event.id_user');
            $this->db->join('wilayah_kabupaten', 'wilayah_kabupaten.id = event.kota');
            $this->db->order_by('id_event', 'DESC');

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

        } else if ($privilage == 'User') {

            $this->db->select('event.*, user.id_user, user.agency, wilayah_kabupaten.*');
            $this->db->from('event');
            $this->db->join('user', 'user.id_user = event.id_user');
            $this->db->join('wilayah_kabupaten', 'wilayah_kabupaten.id = event.kota');
            $this->db->where('event.id_user', $id_user);
            $this->db->order_by('id_event', 'DESC');

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
    }

    function get_datatablest($privilage, $id_user) {
        $this->_get_datatables_trx($privilage, $id_user);
        if(@$_POST['length'] != -1)
        $this->db->limit(@$_POST['length'], @$_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    function count_filtereds($privilage, $id_user) {
        $this->_get_datatables_trx($privilage, $id_user);
        $query = $this->db->get();
        return $query->num_rows();
    }
    function count_all_trx($privilage, $id_user) {
        $this->_get_datatables_trx($privilage, $id_user);
        return $this->db->count_all_results();
    }

    public function update_data($table, $data, $id_event) {
        $this->db->where('id_event', $id_event);
        return $this->db->update($table, $data);
    }


    public function get_agency($privilage, $id_user)
    {
        if ($privilage == 'Admin') {

            $result = $this->db
            ->select('id_user, agency, nm_user')
            ->from('user')
            ->get()
            ->result();

        return $result;

        } else if ($privilage == 'User') {

            $result = $this->db
                ->select('id_user, agency, nm_user')
                ->from('user')
                ->where('user.id_user', $id_user)
                ->get()
                ->result();

            return $result;
        }
    }

    function get_kabupaten()
    {
        $this->db->select('*');
        $this->db->from('wilayah_kabupaten');
        $query = $this->db->get();

        return $query->result();
    }

    function save_event($data) {
        return $this->db->insert('event', $data);
    }

    public function delete_event($event_id) {
        $this->db->where('id_event', $event_id);
        $this->db->delete('event');
    }

    public function get_event_data($event_id) {
        $query = $this->db->get_where('event', array('id_event' => $event_id));
        return $query->row_array();
    }


}