<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_transaksi_event_sales extends CI_Model
{
    var $column_ordertrx = array(null, 'event.nm_event', 'event.tgl_event', 'count', 'count', null);
    var $column_searchtrx = array('event.nm_event');
    var $ordertrx = array('event.id_event' => 'asc');

    private function _get_datatables_trx()
    {
        $this->db->select('event.id_event, event.nm_event,event.tgl_event,event.status_profit, COUNT(*) as count');
        $this->db->from('transaksi');
        $this->db->join('event', 'event.id_event = transaksi.id_event');
        $this->db->join('sales', 'event.id_sales_event = sales.id_sales');
        $this->db->where('sales.id_sales', 1);
        $this->db->group_by('event.id_event');
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



    function get_datatablest()
    {
        $this->_get_datatables_trx();
        if (@$_POST['length'] != -1)
            $this->db->limit(@$_POST['length'], @$_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    function count_filtereds()
    {
        $this->_get_datatables_trx();
        $query = $this->db->get();
        return $query->num_rows();
    }
    function count_all_trx()
    {
        $this->_get_datatables_trx();
        return $this->db->count_all_results();
    }
}
