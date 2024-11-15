<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_histori_withdrawal extends CI_Model
{
    var $column_ordertrx = array(null, 'transaksi_sales.no_wd', 'transaksi_sales.tgl_pengajuan', 'transaksi_sales.nominal_transaksi', 'transaksi_sales.biaya_transaksi', 'transaksi_sales.total_transaksi', 'transaksi_sales.tgl_pembayaran', null);
    var $column_searchtrx = array('transaksi_sales.no_wd');
    var $ordertrx = array('transaksi_sales.id_transaksi_sales' => 'asc');

    private function _get_datatables_trx()
    {
        $id_sales = $this->userdata->id_sales;
        $this->db->select('transaksi_sales.*');
        $this->db->from('transaksi_sales');
        $this->db->where('transaksi_sales.sales_id', $id_sales);
        $this->db->where('transaksi_sales.tgl_pembayaran !=', '');
        // $this->db->group_by('event.id_event');
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

    function get_event_withdrawal($event_id){
        $this->db->select('event.*, COUNT(*) as count');
        $this->db->from('event');
        $this->db->join('transaksi', 'transaksi.id_event = event.id_event');
        $this->db->where_in('transaksi.id_event', $event_id);
        $query = $this->db->get();
        return $query->result();

    }
}
