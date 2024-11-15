<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dash_sales extends AUTH_Controller
{
    var $template = 'tmpt_admin/index';
    public $userdata;
    public $db;
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['userdata']        = $this->userdata;
        $data['tittle']          = 'Dashboard Sales';
        $data['bread']           = 'Dashboard';
        $data['total_event'] = $this->total_event();
        $data['total_transaksi'] = $this->total_transaksi();
        $data['total_profit'] = $this->total_profit();
        // $data['option']          = $this->Banner_kat_model->get_agency();
        $data['content']         = 'page_sales/dashboard/dashboard';
        $data['script']          = 'page_sales/dashboard/dashboard_js';
        $this->load->view($this->template, $data);
    }

    function total_event()
    {
        $id_sales = $this->userdata->id_sales;
        $this->db->select('COUNT(*) as count');
        $this->db->from('event');
        $this->db->join('sales', 'event.id_sales_event = sales.id_sales');
        $this->db->where('sales.id_sales', $id_sales);
        $this->db->where('event.status_profit', 0);
        
        $query = $this->db->get();
        $count = $query->row()->count;

        return $count; // Return the count instead of echoing it
    }
    function total_transaksi()
    {
        $id_sales = $this->userdata->id_sales;
        $this->db->select('COUNT(*) as count');
        $this->db->from('transaksi');
        $this->db->join('event', 'event.id_event = transaksi.id_event');
        $this->db->join('sales', 'event.id_sales_event = sales.id_sales');
        $this->db->where('sales.id_sales', $id_sales);
        $this->db->where('event.status_profit', 0);
        
        $query = $this->db->get();
        $count = $query->row()->count;

        return $count; // Return the count instead of echoing it
    }
    function total_profit()
    {
        $id_sales = $this->userdata->id_sales;
        $this->db->select('COUNT(*) as count');
        $this->db->from('transaksi');
        $this->db->join('event', 'event.id_event = transaksi.id_event');
        $this->db->join('sales', 'event.id_sales_event = sales.id_sales');
        $this->db->where('sales.id_sales', $id_sales);
        $this->db->where('event.status_profit', 0);
        
        $query = $this->db->get();
        $count = $query->row()->count;

        return $count * 1000; // Return the count instead of echoing it
    }
}
