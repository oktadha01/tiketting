<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sales_tiket extends AUTH_Controller
{
    var $template = 'tmpt_admin/index';

    public $userdata;
    public $M_client;
    public $M_dashboard;
    public $session;
    public $input;
    public $output;
    public $upload;
    public $db;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Sales_model');

    }

    public function index()
    {
        $data['userdata']       = $this->userdata;
        $data['tittle']         = 'List Event ';
        $data['bread']          = 'List Penjualan Tiket';
        $data['content']        = 'page_admin/sales/event_sales';
        $data['script']         = 'page_admin/sales/sales_tiket_js';
        $this->load->view($this->template, $data);
    }

    public function data_penjualan()
    {
        $data['userdata']       = $this->userdata;
        $data['tittle']         = 'Penjualan Tiket';
        $data['bread']          = 'Penjualan Tiket';
        $data['content']        = 'page_admin/sales/sales_tiket';
        $data['script']         = 'page_admin/sales/sales_tiket_js';
        $this->load->view($this->template, $data);
    }

    function get_datasales() {
        $id_event = $this->uri->segment(3);
        $list = $this->Sales_model->get_datatablest($id_event);
        $data = array();
        $no = @$_POST['start'];
        $totalTiket = 0;

        $previlage = $this->session->userdata('privilage');

        foreach ($list as $sal) {

            $status_tiket = '';
            if ($sal->status_transaksi == '0') {
                $status_tiket = '<td class="font-weight-medium"><div class="badge badge-warning shadow bg-white rounded">Menunggu Pembayaran</div></td>';
            } elseif ($sal->status_transaksi == '1') {
                $status_tiket = '<td class="font-weight-medium"><div class="badge badge-success shadow bg-white rounded">Lunas</div></td>';
            }

            $no++;
            $row = array();
            $row[]  = $no . ".";
            $row[]  = $sal->tgl_transaksi;
            $row[]  = $sal->nm_customer;
            $row[]  = $sal->code_bayar;
            $row[] = '<div class="badge badge-primary shadow bg-white rounded">' . $sal->jumlah_tiket . ' Tiket</div>';
            $row[]  =  $status_tiket;

            $data[] = $row;
            $totalTiket += $sal->jumlah_tiket;
        }

        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->Sales_model->count_all($id_event),
            "recordsFiltered" => $this->Sales_model->count_filtereds($id_event),
            "data" => $data,
            "totalTiket" => $totalTiket
        );

        echo json_encode($output);
    }

    public function fetch()
    {
        $output = '';

        $id_user = $this->session->userdata('userdata')->id_user;
        $limit = $this->input->post('limit');
        $start = $this->input->post('start');
        $search = $this->input->post('search');

        $data = $this->Sales_model->get_event_menu($limit, $start, $id_user,$search);

        if ($data->num_rows() > 0) {
            foreach ($data->result() as $event) {

                $tiket_terjual = $this->Sales_model->get_tiket_terjual($event->id_event);

                $output .= '
                    <div class="col-lg-3 col-md-4 col-sm-12 p-0 m-0">
                        <div class="card product_item" style="max-width: 90%;">
                            <div class="body m-1 p-1">
                                <div class="cp_img">
                                    <img src="' . base_url('upload/event/' . $event->poster) . '" alt="Product" class="img-fluid" style="max-width: 75%; height: auto; display: block; margin: 0 auto;">
                                    <div class="hover">
                                        <a href="' . base_url('Sales_tiket/data_penjualan/' . $event->id_event) . '" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Lihat">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="product_details mt-1">
                                    <h5><span class="badge badge-primary bg-warning text-dark">' . $event->nm_event . '</span></h5>
                                    <ul class="product_price list-unstyled mt-1">
                                        <li class="old_price">Agency</li>
                                        <li class="new_price">' . $event->agency . '</li>
                                    </ul>
                                    <h6><span class="mt-1 badge badge-warning bg-primary text-white">Tiket Terjual: ' .  $tiket_terjual . ' </span></h6>
                                </div>
                            </div>
                        </div>
                    </div>';
            }
            echo $output;
        }
    }


}