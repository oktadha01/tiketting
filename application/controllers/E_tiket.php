<?php
defined('BASEPATH') or exit('No direct script access allowed');


class E_tiket extends CI_Controller
{
    public $M_tiket;
    public $db;
    public $uri;
    public $session;
    public $input;
    var $template = 'tmpt_client/index';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_tiket');
    }

    function data()
    {
        $email                  = $this->input->cookie('session');
        $tiket                  = $this->M_tiket->m_data_tiket($email);

        $num_rows_tiket = $tiket['num_rows'];
        $no = 1;
        // echo '<div class="row">';
        if ($num_rows_tiket > 0) {
            foreach ($tiket['result'] as $data_tiket) {
                $jumlah = "1";

                echo '<div class="card box-shadow">
                                <div class="card-header etic-header bg-w-orange">
                                <span>' . $data_tiket->nm_event . ' | ' . $data_tiket->tgl_transaksi . '</span>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                    <div class="col-lg-1 col-md-1 col-2">
                                    <span class="num-tiket">' . $no++ . '</span>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-5">
                                            <p class="small mb-0">Name</p>
                                            <p class="medium mb-0 font-weight-bold">' . implode(" ", array_slice(explode(" ", $data_tiket->nama), 0, $jumlah)) . '</p>
                                        </div>
                                        <div class="col-lg-2 col-md-4 col-5">
                                            <p class="small mb-0">Ticket</p>
                                            <p class="medium mb-0 font-weight-bold">' . $data_tiket->kategori_price . '</p>
                                        </div>
                                        <div class="code-tiket col-lg-3 col-md-3 col-3">
                                            <p class="small mb-0">Code Ticket</p>
                                            <p class="medium mb-0 font-weight-bold">' . $data_tiket->code_tiket . '</p>
                                        </div>
                                        <div class="col-lg-4 col-md-5 col-12">
                                            <div class="row">
                                                <div class="col">
                                                    <button class="btn bg-w-blue font-weight-bold text-light col-12 detail-e-tiket" data-toggle="modal" data-target="#detail-e-tiket" data-event="' . $data_tiket->nm_event . '" data-file="' . $data_tiket->code_tiket . '" data-link="' . $data_tiket->code_tiket . '_' . $data_tiket->kategori_price . '">Detail</button>
                                                </div>
                                                <div class="col">
                                                    <button id="" class="btn bg-w-orange font-weight-bold col-12 download-file" data-file="' . $data_tiket->code_tiket . '" data-link="' . $data_tiket->code_tiket . '_' . $data_tiket->kategori_price . '">Download E-Tiket</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>';
            }
        } else {
            echo '<span>No tickets</span>';
        }
        // echo '</div>';
    }
    function detail_tiket()
    {
        $code_tiket = $_POST['code_tiket'];

        $email = $this->input->cookie('session');
        $data['detail_tiket']        = $this->M_tiket->m_detail_tiket($email, $code_tiket);
        foreach ($data['detail_tiket'] as $data_tiket) {

            echo '<div class="card box-shadow">
                    <div class="card-body">
                    <div class="row">
                    <div class="col-lg-3 col-md-3 col-6">
                    <p class="small mb-0">Name</p>
                    <p class="medium mb-0 font-weight-bold">' . implode(" ", array_slice(explode(" ", $data_tiket->nama), 0, 1))  . '</p>
                    </div>
                    <div class="col-lg-3 col-md-3 col-6">
                    <p class="small mb-0">Ticket</p>
                    <p class="medium mb-0 font-weight-bold">' . $data_tiket->kategori_price . '</p>
                    </div>
                    <div class="col-lg-6 col-md-6 col-6">
                    <p class="small mb-0">Code Ticket</p>
                    <p class="medium mb-0 font-weight-bold">' . $data_tiket->code_tiket . '</p>
                    </div>
                    </div>
                    </div>
                    </div>
                    <div class="card box-shadow">
                    <div class="card-body">
                    <div class="row">
                    <div class="col">
                    <img src="' . base_url('upload/qr/') . 'qr-' . $data_tiket->code_tiket . '.png" class="img-fluid" style="min-width: -webkit-fill-available;">
                    </div>
                    </div>
                    </div>
                    </div>
                    </div>';
        }
    }
}
