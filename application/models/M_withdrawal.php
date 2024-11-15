<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_withdrawal extends CI_Model
{
    // var $column_ordertrx = array(null, 'event.nm_event', 'event.tgl_event', 'count', 'count', null);
    // var $column_searchtrx = array('event.nm_event');
    // var $ordertrx = array('event.id_event' => 'asc');

    // $date = '2024-11-02'; // Use the date in Y-m-d format for comparison


    function _get_datatables_trx($id_sales)
    {
        // Set the date for comparison
        $date = date('Y-m-d', strtotime('-3 days'));
        // $date = '2024-10-30'; // Use the date in Y-m-d format for comparison

        // Build the query using CodeIgniter's Query Builder
        $this->db->select('event.id_event, event.nm_event, event.tgl_event, event.status_profit, COUNT(*) as count');
        $this->db->from('transaksi');
        $this->db->join('event', 'event.id_event = transaksi.id_event');
        $this->db->join('sales', 'event.id_sales_event = sales.id_sales');
        $this->db->where('sales.id_sales', $id_sales);
        $this->db->where('event.status_profit', 0);

        // Ensure the tgl_event is in the correct format and check against the specified date
        $this->db->where('event.tgl_event REGEXP', '^[0-9]{2}/[0-9]{2}/[0-9]{4}$');
        $this->db->where('STR_TO_DATE(event.tgl_event, "%d/%m/%Y") <=', $date);

        // Group by id_event
        $this->db->group_by('event.id_event');

        // Execute the query
        $query = $this->db->get();

        // Return the result set
        return $query->result();
    }

    function m_data_transaksi_proses($id_sales)
    {
        $this->db->select('*');
        $this->db->from('transaksi_sales');
        $this->db->where('transaksi_sales.sales_id', $id_sales);
        $this->db->where('transaksi_sales.tgl_pembayaran', '');
        // Execute the query
        $query = $this->db->get();

        // Return the result set
        return $query->result();
    }
    function m_insert_pengajuan($data)
    {
        return $this->db->insert('transaksi_sales', $data);
    }

    function m_update_status_profit($event_id)
    {
        $update = $this->db->set('status_profit', 1)
            ->where('id_event', $event_id)
            ->update('event');
        return $update;
    }
}
