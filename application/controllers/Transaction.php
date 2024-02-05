<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Transaction extends CI_Controller
{
    public $M_transaksi;
    public $db;
    public $uri;
    public $session;
    public $input;
    var $template = 'tmpt_client/index';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_transaksi');
    }
    function CB()
    {
        $email = $this->input->cookie('session');
        $code_bayar = $this->uri->segment(3);
        $data['tittle']          = 'Status Pembayaran';
        $data['script1']          = 'Detail Event';
        $data['transaksi']        = $this->M_transaksi->m_paynow($email, $code_bayar);
        $data['content']         = 'client/transaction/transaction';
        $data['script']         = 'client/transaction/transaction_js';
        $this->load->view($this->template, $data);
    }
    function data()
    {

        $email = $this->input->cookie('session');
        $transaksi        = $this->M_transaksi->m_data_transaksi($email);
        $num_rows_transaksi = $transaksi['num_rows'];
        if ($num_rows_transaksi > 0) {

            foreach ($transaksi['result'] as $data_transaksi) {
                $currentDateTime = date($data_transaksi->tgl_transaksi);
                $newDateTime = date('d-m-Y H:i:s', strtotime($currentDateTime . ' +1 hours'));

                if (date('d-m-Y H:i:s') >= $newDateTime && $data_transaksi->status_transaksi == '0') {
                    // echo 'delete';
                    $sql = "SELECT * FROM tiket WHERE code_bayar = '$data_transaksi->code_bayar'";
                    $query = $this->db->query($sql);
                    if ($query->num_rows() > 0) {
                        foreach ($query->result() as $file) {

                            unlink('./upload/pdf/pdf-' . $file->code_tiket . '.pdf');
                            unlink('./upload/qr/qr-' . $file->code_tiket . '.png');
                        }
                    }
                    $code_bayar = $data_transaksi->code_bayar;
                    $this->M_transaksi->m_delete_transaksi_tiket($code_bayar);
                    echo '<span>No transactions</span>';
                } else {
                    // code status
                    $status_transaksi = '';
                    if ($data_transaksi->status_transaksi == '0') {
                        $status_transaksi = '<td class="font-weight-medium ml-0"><div class="badge badge-info shadow l-parpl text-white rounded ">Panding</div></td>';
                    } elseif ($data_transaksi->status_transaksi == '1') {
                        $status_transaksi = '<td class="font-weight-medium"><div class="badge badge-info shadow l-green text-dark rounded">Lunas</div></td>';
                    }

                    // code tombol
                    if ($data_transaksi->status_transaksi == '0') {
                        $actionButton = '<div class="col-6">
                                                <button type="button" class="col-12 btn btn-sm bg-w-blue text-light btn-detail-trans-m" data-cb="' . $data_transaksi->code_bayar . '" data-toggle="modal" data-target="#detail-transaksi">Detail</button>
                                            </div>
                                            <div class="col-6">
                                                <a href="' . base_url('Transaction/CB/') . $data_transaksi->code_bayar . '">
                                                    <button type="button" class="col-12 btn btn-sm bg-w-orange">Pay Now</button>
                                                </a>
                                            </div>';
                    } elseif ($data_transaksi->status_transaksi == '1') {
                        $actionButton = ' <div class="col-6">
                                                <button type="button" class="col-12 btn btn-sm bg-w-blue text-light btn-detail-trans-m" data-cb="' . $data_transaksi->code_bayar . '" data-toggle="modal" data-target="#detail-transaksi">Detail</button>
                                              </div>';
                    }

                    echo '<div class="card box-shadow">
                    <div class="card-body">
                    <div class="row">
                        <div class="col-lg-1 col-md-2 col-5">
                            <img src="' . base_url('upload/event/') . $data_transaksi->poster . '" class="img-fluid size-poster">
                        </div>
                        <div class="col-lg-8 col-md-10 col-7 p-table-inv">
                            <div class="row">
                                <div class="col-lg-4">
                                <div style="display:grid;">
                                        <span class="smal">Invoice Number</span>
                                        <span class="font-weight-bold">INV-#' . $data_transaksi->code_bayar . '</span>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div style="display:grid;">
                                        <span class="smal">Buy At</span>
                                        <span class="font-weight-bold">' . $data_transaksi->tgl_transaksi . '</span>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div style="display:grid;">
                                        <span class="smal">Total</span>
                                        <span class="font-weight-bold">Rp ' . number_format($data_transaksi->nominal, 0, ',', '.') . '</span>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div style="display:grid;">
                                        <span class="smal">Status</span>
                                        <span class="font-weight-bold"> ' . $status_transaksi . '</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 p-table-inv">
                            <hr class="hr">
                            <div class="row">' . $actionButton . '</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
                }
            }
        } else {
            echo '<span>Tidak Ada Transaksi</span>';
        }
    }
    function detail_trans()
    {
        $code_bayar = $_POST['code_bayar'];
        $data['detail_tiket']                 = $this->M_transaksi->m_detail_tiket($code_bayar);
        $data['detail_tiket_bundling']        = $this->M_transaksi->m_detail_tiket_bundling($code_bayar);
        $data['detail_trans']                 = $this->M_transaksi->m_detail_trans($code_bayar);
        $data['detail_buyer']                 = $this->M_transaksi->m_detail_buyer($code_bayar);
        $data['detail_event']                 = $this->M_transaksi->m_detail_event($code_bayar);

        echo '<span class="font-weight-bold">Event Details</span>';
        foreach ($data['detail_event'] as $data_event) {
            echo '<div class="card box-shadow">
                    <div class="card-body p-1" style="background: #00000008;">
                        <ul class="mb-0" style="display: flex;">
                            <li>
                                <img src="' . base_url('upload/event/') . $data_event->poster . '" class="img-fluid" style="width: 5rem; border-radius: 6px;">
                            </li>
                            <li>
                                <table class="ml-3">
                                    <thead>
                                        <tr>
                                            <th>' . $data_event->nm_event . '</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <p class="small mb-0"><i class="fa fa-calendar"></i> ' . $data_event->tgl_event . ' | ' .  $data_event->jam_event . '</p>
                                                <p class="small mb-0"><i class="fa fa-map-marker"></i> ' .  $data_event->lokasi . '</p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </li>
                        </ul>
                    </div>
                </div>';
        }

        echo '<span class="font-weight-bold">Ticket Details</span>';
        echo '<div class="card box-shadow">
            <div class="card-body">
                <div class="row">';
        foreach ($data['detail_tiket'] as $data_tiket) {
            $count = $data_tiket->total_rows - $data_tiket->jumlah_free;

            echo '<div class="col-6">
                    <p class="small mb-0">' . $data_tiket->tiket . '</p>';
            if ($data_tiket->jumlah_free > '0') {
                echo '<p class="medium font-weight-bold mb-0">Rp. ' . number_format($data_tiket->harga_tiket, 0, ',', '.') . ' x ' . $count . '<sup> Free x ' . $data_tiket->jumlah_free . '</sup></p>';
            } else {
                echo '<p class="medium font-weight-bold mb-0">Rp. ' . number_format($data_tiket->harga_tiket, 0, ',', '.') . ' x ' . $count . '</p>';
            }

            echo '</div>
                <div class="col-6">
                    <p class="medium font-weight-bold mb-0 float-right pt-3">Rp. ' . number_format($data_tiket->harga_tiket * $count, 0, ',', '.') . '</p>
                </div>';
        }
        foreach ($data['detail_tiket_bundling'] as $data_tiket) {
            echo '<div class="col-6">
                    <p class="small mb-0">' . $data_tiket->tiket . '</p>
                    <p class="medium font-weight-bold mb-0">Rp. ' . number_format($data_tiket->harga_tiket, 0, ',', '.') . ' x 1<sup> Bundling x ' . $data_tiket->jumlah . '</sup></p>
                </div>
                <div class="col-6">
                    <p class="medium font-weight-bold mb-0 float-right pt-3">Rp. ' . number_format($data_tiket->harga_tiket, 0, ',', '.') . '</p>
                </div>';
        }
        echo '</div>
                </div>
            </div>';
        echo '<span class="font-weight-bold">Purchase Details</span>';
        foreach ($data['detail_trans'] as $data_trans) {
            echo '<div class="card box-shadow">
            <div class="card-body">
            <div class="row">
            <div class="col-lg-6 col-md-6 col-12">
                <p class="small mb-0">Invoice Number</p>
                <p class="medium font-weight-bold">INV-#' . $data_trans->code_bayar . '</p>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
                <p class="small mb-0">Buy At</p>
                <p id="text-tiket" class="medium font-weight-bold">' . $data_trans->tgl_transaksi . '</p>
            </div>
            <div class="col-lg-6 col-md-6 col-6">
            <p class="small mb-0">Payment</p>
            <p id="text-file" class="medium mb-0 font-weight-bold">' . $data_trans->bank . '</p>
            </div>
            <div class="col-lg-6 col-md-6 col-6">
            <p class="small mb-0">Total</p>
            <p id="text-file" class="medium mb-0 font-weight-bold">Rp. ' . number_format($data_trans->nominal, 0, ',', '.') . '</p>
            </div>
            </div>
            </div>
            </div>';
            // code tombol modal footer
            if ($data_trans->status_transaksi == '0') {
                $modalButton = '<div class="row">
                                        <div class="col pl-0">
                                            <button id="" type="button" class="btn bg-w-orange btn-btl-trans" data-dismiss="modal">Batalkan
                                                Transaksi</button>
                                        </div>
                                        <div class="col pr-0">
                                            <a href="' . base_url('Transaction/CB/') . $data_trans->code_bayar . '">
                                                <button type="button" class="btn bg-w-blue text-light float-right">Bayar Sekarang</button>
                                            </a>
                                        </div>
                                    </div>';
            } elseif ($data_trans->status_transaksi == '1') {
                $modalButton = '';
            }
        }
        echo '<span class="font-weight-bold">Buyer Details</span>';
        $no = 1;
        $counter = 0;
        foreach ($data['detail_buyer'] as $data_buyer) {
            if ($data_buyer->status_bundling == '1') {
                $counter++;
                if ($counter == '1') {
                    echo '<div class="card box-shadow">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-1">
                                <span class="num-tiket">' . $no++ . '</span>
                            </div>
                            <div class="col-lg-4">
                                <p class="small mb-0">Name</p>
                                <p class="medium mb-0 font-weight-bold">' . $data_buyer->nama . '</p>
                            </div>
                            <div class="col-lg-4">
                                <p class="small mb-0">Email</p>
                                <p class="medium mb-0 font-weight-bold">' . $data_buyer->email . '</p>
                            </div>
                            <div class="col-lg-3">
                                <p class="small mb-0">Ticket</p>
                                <p class="medium mb-0 font-weight-bold">' . $data_buyer->kategori_price . '</p>
                            </div>
                        </div>
                    </div>
                </div>';
                }
            } else {
                echo '<div class="card box-shadow">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-1">
                                    <span class="num-tiket">' . $no++ . '</span>
                                </div>
                                <div class="col-lg-4">
                                    <p class="small mb-0">Name</p>
                                    <p class="medium mb-0 font-weight-bold">' . $data_buyer->nama . '</p>
                                </div>
                                <div class="col-lg-4">
                                    <p class="small mb-0">Email</p>
                                    <p class="medium mb-0 font-weight-bold">' . $data_buyer->email . '</p>
                                </div>
                                <div class="col-lg-3">
                                    <p class="small mb-0">Ticket</p>
                                    <p class="medium mb-0 font-weight-bold">' . $data_buyer->kategori_price . '</p>
                                </div>
                            </div>
                        </div>
                    </div>';
            }
        }


        echo ' <div class="modal-footer" style="display: block;">' . $modalButton . '</div>';
        echo '<input type="text" id="del-code_transaksi" value="' . $code_bayar . '" hidden>';
    }
    function batalkan_transaksi()
    {
        $email = $this->input->cookie('session');
        $tiketCounts = array();
        $code_bayar = $this->input->post('code-bayar');
        $data['tiket'] = $this->M_transaksi->m_select_tiket($code_bayar);
        foreach ($data['tiket'] as $file) {
            $id_price = $file->id_price;

            if (isset($tiketCounts[$id_price])) {
                $tiketCounts[$id_price]++;
            } else {
                $tiketCounts[$id_price] = 1;
            }
            unlink('./upload/pdf/pdf-' . $file->code_tiket . '.pdf');
            unlink('./upload/qr/qr-' . $file->code_tiket . '.png');
        }
        $this->M_transaksi->m_delete_transaksi_tiket($code_bayar);
        foreach ($tiketCounts as $id_price => $count) {
            $this->db->select("*");
            $this->db->where('id_price', $id_price);
            $query_ = $this->db->get('price');
            if ($query_->num_rows() <> 0) {
                $data_ = $query_->row();
                $id_price = $data_->id_price;
                $stock_tiket = $data_->stock_tiket + $count;
                // echo 'id:' . $data_->id_price . 'count :' . $stock_tiket;
                $this->M_transaksi->m_update_stock_tiket($id_price, $stock_tiket);
            }
        }
    }
}
