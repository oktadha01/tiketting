<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Prices_model extends CI_Model
{
    var $column_ordertrx = array(null, 'event.nm_event', 'kategori_price', 'harga', 'stock_tiket');
    var $column_searchtrx = array('event.nm_event', 'kategori_price', 'harga', 'stock_tiket');
    var $ordertrx = array('price.id_price' => 'asc');

    private function _get_datatables_trx($privilage, $id_user, $id_event)
    {

        if ($privilage == 'Admin') {

            $this->db->select('*');
            $this->db->from('price');
            $this->db->join('event', 'event.id_event = price.id_event');
            $this->db->where('price.id_event', $id_event);
            $this->db->order_by('id_price', 'DESC');

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
            $this->db->from('price');
            $this->db->join('event', 'event.id_event = price.id_event');
            $this->db->where('event.id_user', $id_user);
            $this->db->where('price.id_event', $id_event);
            $this->db->order_by('price.id_price', 'DESC');

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

    function get_datatablest($privilage, $id_user, $id_event)
    {
        $this->_get_datatables_trx($privilage, $id_user, $id_event);
        if (@$_POST['length'] != -1)
            $this->db->limit(@$_POST['length'], @$_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    function count_filtereds($privilage, $id_user, $id_event)
    {
        $this->_get_datatables_trx($privilage, $id_user, $id_event);
        $query = $this->db->get();
        return $query->num_rows();
    }
    function count_all_trx($privilage, $id_user, $id_event)
    {
        $this->_get_datatables_trx($privilage, $id_user, $id_event);
        return $this->db->count_all_results();
    }

    function hapus_price($params = '')
    {
        $sql = "DELETE  FROM price WHERE id_price = ? ";
        return $this->db->query($sql, $params);
    }

    function save_price($data)
    {
        return $this->db->insert('price', $data);
    }

    public function update_data($table, $data, $id_price)
    {
        $this->db->where('id_price', $id_price);
        return $this->db->update($table, $data);
    }

    function get_event()
    {
        $this->db->select('*');
        $this->db->from('event');
        $query = $this->db->get();

        return $query->result();
    }

    function get_tiket($id_event, $privilage)
    {
        if ($privilage == 'Admin') {

            $this->db->select('*');
            $this->db->from('price');
            $this->db->where('price.status', 0);
            $this->db->where('price.beli', 1);
            $query = $this->db->get();

            return $query->result();
        } else if ($privilage == 'User') {

            $this->db->select('kategori_price, id_price, stock_tiket');
            $this->db->from('price');
            $this->db->join('event', 'event.id_event = price.id_event');
            $this->db->where('price.id_event', $id_event);
            $this->db->where('price.status', 0);
            $this->db->where('price.beli', 1);
            $query = $this->db->get();

            return $query->result();
        }
    }

    function get_idevent($id_user)
    {
        $this->db->select('*');
        $this->db->from('price');
        $this->db->join('event', 'event.id_event = price.id_event');
        $this->db->where('event.id_user', $id_user);
        $this->db->limit(1);
        $query = $this->db->get();

        return $query->result();
    }

    function save_bundle($data)
    {
        return $this->db->insert('price', $data);
    }

    public function get_event_menu($limit, $start, $id_user, $search = '', $privilage)
    {
        if ($privilage == 'Admin') {
            $this->db->select('event.*, user.id_user, user.agency');
            $this->db->from('event');
            $this->db->join('user', 'user.id_user = event.id_user');

            if (!empty($search)) {
                $this->db->like('nm_event', $search);
            }

            $this->db->order_by("id_event", "DESC");
            $this->db->limit($limit, $start);
            $query = $this->db->get();

            return $query;
        } else if ($privilage == 'User') {
            $this->db->select('event.*, user.id_user, user.agency');
            $this->db->from('event');
            $this->db->join('user', 'user.id_user = event.id_user');
            $this->db->where('event.id_user', $id_user);

            if (!empty($search)) {
                $this->db->like('nm_event', $search);
            }

            $this->db->order_by("id_event", "DESC");
            $this->db->limit($limit, $start);
            $query = $this->db->get();

            return $query;
        }
    }
}
