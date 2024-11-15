<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Scan_tiket extends AUTH_Controller
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
        $this->load->model('Scan_model');
    }

    public function index()
    {
        $data['userdata']       = $this->userdata;
        $data['tittle']         = 'Menu Scan Tiket';
        $data['bread']          = 'Scan Tiket';

        $id_event               = $this->session->userdata('userdata')->id_event;
        $tiket_status           = $this->Scan_model->get_tiket_status($id_event);
        $diambil                = number_format($tiket_status->jumlah_tiket_1, 0, ',', '.');
        $belum                  = number_format($tiket_status->jumlah_tiket_0, 0, ',', '.');
        $tiket                  = number_format($tiket_status->jumlah_total_tiket, 0, ',', '.');

        $data['total_tiket']    = $tiket;
        $data['tiket_diambil']  = $diambil;
        $data['tiket_belum']    = $belum;

        $data['content']        = 'page_admin/scan_tiket/scan';
        $data['script']         = 'page_admin/scan_tiket/scan_js';
        $this->load->view($this->template, $data);
    }

    public function get_data_from_qr()
    {
        $qrCodeMessage = $this->input->get('qrCodeMessage');
        $manualCode = $this->input->get('manualCode');

        $data['result'] = $this->Scan_model->get_data_tiket($qrCodeMessage, $manualCode);

        if (is_array($data['result'])) {
            foreach ($data['result'] as &$tiket) {

                $tiket->status_tiket = ($tiket->status_tiket == 1) ? 'Sudah Diambil' : 'Belum Diambil';
            }
        }

        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function update_tiket()
    {
        $codeTiket = $this->input->post('code_tiket');
        $result = $this->Scan_model->update_status_tiket($codeTiket);

        header('Content-Type: application/json');
        echo json_encode($result);
    }

    public function data_scan()
    {
        $data['userdata']       = $this->userdata;
        $data['tittle']         = 'Menu Tiket Event';
        $data['bread']          = 'Scan Tiket Event';
        $data['content']        = 'page_admin/scan_tiket_adm/data_scan_event';
        $data['script']         = 'page_admin/scan_tiket_adm/datascan_js';
        $this->load->view($this->template, $data);
    }

    public function list_scan()
    {
        $data['userdata']       = $this->userdata;
        $data['tittle']         = 'Menu Tiket Event';
        $data['bread']          = 'Data Tiket Event';
        $data['content']        = 'page_admin/scan_tiket_adm/data_scan';
        $data['script']         = 'page_admin/scan_tiket_adm/datascan_js';
        $this->load->view($this->template, $data);
    }

    function get_datatiket()
    {
        $id_event = $this->uri->segment(3);
        $status_filter = $this->input->post('status_filter');

        $list = $this->Scan_model->get_datatablest($id_event, $status_filter);
        $nm_event = $this->Scan_model->get_nama_event($id_event);
        $data = array();
        $no = @$_POST['start'];

        foreach ($list as $tkt) {

            // label status
            $status_tiket = '';
            if ($tkt->status_tiket == '0') {
                $status_tiket = '<td class="font-weight-medium"><div class="badge badge-danger shadow bg-white rounded">Belum Diambil</div></td>';
            } elseif ($tkt->status_tiket == '1') {
                $status_tiket = '<td class="font-weight-medium"><div class="badge badge-success shadow bg-white rounded">Sudah Diambil</div></td>';
            }

            $no++;
            $row    = array();
            $row[]  = $no . ".";
            $row[]  = $tkt->code_tiket;
            $row[]  = $tkt->nama;
            $row[]  = $tkt->gender;
            $row[]  = $tkt->email;
            $row[]  = $tkt->kontak;
            $row[]  = $tkt->no_identitas;
            $row[]  = $status_tiket;
            $data[] = $row;
        }

        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->Scan_model->count_all($id_event, $status_filter),
            "recordsFiltered" => $this->Scan_model->count_filtereds($id_event, $status_filter),
            "data" => $data,
            "nm_event" => $nm_event,
        );

        echo json_encode($output);
    }

    public function fetch()
    {
        $output = '';
        $this->load->model('Scan_model');
        $limit = $this->input->post('limit');
        $start = $this->input->post('start');
        $search = $this->input->post('search');

        $id_user = $this->session->userdata('userdata')->id_user;
        $privilage = $this->session->userdata('userdata')->privilage;


        $data = $this->Scan_model->get_event_menu($limit, $start, $search, $id_user, $privilage);

        if ($data->num_rows() > 0) {
            foreach ($data->result() as $event) {
                $output .= '
                    <div class="col-lg-3 col-md-4 col-sm-12 p-0 m-0">
                        <div class="card product_item" style="max-width: 90%;">
                            <div class="body m-1 p-1">
                                <div class="cp_img">
                                    <img src="' . base_url('upload/event/' . $event->poster) . '" alt="Product" class="img-fluid" style="max-width: 75%; height: auto; display: block; margin: 0 auto;">
                                    <div class="hover">
                                        <a href="' . base_url('Scan_tiket/list_scan/' . $event->id_event) . '" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Lihat">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="product_details mt-1">
                                    <h5><span class="badge badge-danger bg-info text-white">' . $event->nm_event . '</span></h5>
                                    <ul class="product_price list-unstyled mt-1">
                                        <li class="old_price">Agency</li>
                                        <li class="new_price">' . $event->agency . '</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>';
            }
            echo $output;
        }else{
            $output .= '';
            echo $output;

        }
    }
}