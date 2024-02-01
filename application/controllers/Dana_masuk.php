<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dana_masuk extends AUTH_Controller
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
        $this->load->model('Dana_masuk_model');

    }

    public function index()
    {
        $data['userdata']       = $this->userdata;
        $data['tittle']         = 'List Event ';
        $data['bread']          = 'List Saldo Event';
        $data['content']        = 'page_admin/transaksi/event_saldo';
        $data['script']         = 'page_admin/transaksi/dana_masuk_js';
        $this->load->view($this->template, $data);
    }

    public function data_dana_masuk()
    {
        $data['userdata']       = $this->userdata;
        $data['tittle']         = 'Dana Masuk';
        $data['bread']          = 'Data Dana MAsuk';
        $data['content']        = 'page_admin/transaksi/dana_masuk';
        $data['script']         = 'page_admin/transaksi/dana_masuk_js';
        $this->load->view($this->template, $data);
    }

    function get_datasaldo() {
        $id_event = $this->uri->segment(3);
        $list = $this->Dana_masuk_model->get_datatablest($id_event);
        $data = array();
        $no = @$_POST['start'];
        $saldo = 0;
        $totalNominal = 0;

        foreach ($list as $sal) {
            $Rp_nominal = 'Rp. ' . number_format($sal->nominal, 0, ',', '.');

            $no++;
            $row = array();
            $row[]  = $no.".";
            $row[]  = $sal->tanggal;
            $row[]  = $sal->code_bayar;
            $row[]  = $sal->bank;
            $row[]  = $Rp_nominal;

            $saldo += $sal->nominal;
            $saldoFormatted = 'Rp. ' . number_format($saldo, 0, ',', '.');
            $row[] = $saldoFormatted;

            $data[] = $row;

            $totalNominal += $sal->nominal;
        }

        $totalNominalFormatted = 'Rp. ' . number_format($totalNominal, 0, ',', '.');

        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->Dana_masuk_model->count_all($id_event),
            "recordsFiltered" => $this->Dana_masuk_model->count_filtereds($id_event),
            "data" => $data,
            "totalNominal" => $totalNominalFormatted
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

        $data = $this->Dana_masuk_model->get_event_menu($limit, $start, $id_user,$search);

        if ($data->num_rows() > 0) {
            foreach ($data->result() as $event) {

                $total_nominal = $this->Dana_masuk_model->get_total_nominal($event->id_event);

                $totalNominalRP = 'Rp. ' . number_format($total_nominal, 0, ',', '.');

                $output .= '
                    <div class="col-lg-3 col-md-4 col-sm-12 p-0 m-0">
                        <div class="card product_item" style="max-width: 90%;">
                            <div class="body m-1 p-1">
                                <div class="cp_img">
                                    <img src="' . base_url('upload/event/' . $event->poster) . '" alt="Product" class="img-fluid" style="max-width: 75%; height: auto; display: block; margin: 0 auto;">
                                    <div class="hover">
                                        <a href="' . base_url('Dana_masuk/data_dana_masuk/' . $event->id_event) . '" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Lihat">
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
                                    <h6><span class="mt-1 badge badge-warning bg-primary text-white">Saldo: ' .  $totalNominalRP . ' </span></h6>
                                </div>
                            </div>
                        </div>
                    </div>';
            }
            echo $output;
        }
    }


}