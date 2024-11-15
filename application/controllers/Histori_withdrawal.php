<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Histori_withdrawal extends AUTH_Controller
{
    var $template = 'tmpt_admin/index';
    public $userdata;
    public $db;
    public $input;
    public $M_histori_withdrawal;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_histori_withdrawal');
    }

    public function index()
    {
        $data['userdata']        = $this->userdata;
        $data['tittle']          = 'histori Withdrawal';
        $data['bread']           = 'histori Withdrawal';
        $data['content']         = 'page_sales/histori-withdrawal/histori';
        $data['script']          = 'page_sales/histori-withdrawal/histori_js';
        $this->load->view($this->template, $data);
    }
    function get_histori_withdrawal()
    {
        // $id_user = $this->session->userdata('userdata')->id_user;
        // $privilage = $this->session->userdata('userdata')->privilage;

        $list = $this->M_histori_withdrawal->get_datatablest();
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $trans) {

            $no++;
            $row = array();
            $row[] = $no . ".";
            $row[] = '<a href="javascript:void(0)" class="font-weight-bold btn-no-wd" data-id-event="' . $trans->event_id . '" data-nominal="' .  number_format($trans->nominal_transaksi, 0, ',', '.') . '" data-biaya="' .  number_format($trans->biaya_transaksi, 0, ',', '.') . '" data-total="' .  number_format($trans->total_transaksi, 0, ',', '.') . '" data-toggle="modal" data-target="#exampleModalCenter">' . $trans->no_wd . '</a>';
            $row[] = $trans->tgl_pengajuan . ' - ' . $trans->tgl_pembayaran;
            $row[] = '<span class="text-info">Rp. ' . number_format($trans->nominal_transaksi, 0, ',', '.') . '</span>';
            $row[] = '<span class="text-danger">Rp. ' . number_format($trans->biaya_transaksi, 0, ',', '.') . '</span>';
            $row[] = '<span class="text-success">Rp. ' . number_format($trans->total_transaksi, 0, ',', '.') . '</span>';
            $data[] = $row;
        }
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->M_histori_withdrawal->count_all_trx(),
            "recordsFiltered" => $this->M_histori_withdrawal->count_filtereds(),
            "data" => $data,
        );

        echo json_encode($output);
    }

    function detail_withdrawal_event()
    {
        $event_id = $this->input->post('event_id');

        $list = $this->M_histori_withdrawal->get_event_withdrawal($event_id);
        $output = '';
        foreach ($list as $event) {
            $output .= '<tr>' .
                '<td>' . $event->nm_event . '</td>' .
                '<td>' . $event->count . '</td>' .
                '<td>Rp. ' . number_format($event->count * 1000, 0, ',', '.') . '</td>' .
                '</tr>';
        }
        echo $output;
    }
}
