<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Prices extends AUTH_Controller
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
        $this->load->model('Prices_model');

    }

    public function index()
    {
        $id_user = $this->session->userdata('userdata')->id_user;
        $data['userdata']       = $this->userdata;
        $data['tittle']         = 'Menu Event Prices ';
        $data['bread']          = 'Event Prices';
        $data['content']        = 'page_admin/price/price_event';
        $data['script']         = 'page_admin/price/price_js';
        $this->load->view($this->template, $data);
    }

    public function list_price()
    {
        $id_user = $this->session->userdata('userdata')->id_user;
        $data['userdata']       = $this->userdata;
        $data['tittle']         = 'Menu Prices';
        $data['bread']          = 'Prices';
        $data['id_event']       = $this->Prices_model->get_idevent($id_user);
        $data['content']        = 'page_admin/price/price';
        $data['script']         = 'page_admin/price/price_js';
        $this->load->view($this->template, $data);
    }

    function get_ajax_event(){
        $query = $this->Perform_model->get_event();
        $data = "<option value=''>- Pilih Event -</option>";
        foreach ($query as $value) {
            $data .= "<option value='".$value->id_event."'>".$value->nm_event."</option>";
        }
        echo $data;

    }

    function get_dataprice() {
        $id_user = $this->session->userdata('userdata')->id_user;
        $privilage = $this->session->userdata('userdata')->privilage;
        $id_event = $this->uri->segment(3);

        $list = $this->Prices_model->get_datatablest($privilage, $id_user, $id_event);
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $prc) {

            // format harga rupiah
            $harga = $prc->harga;
            $Rp_harga = 'Rp. ' . number_format($harga, 0, ',', '.');

            if ($prc->status_bundling == '0') {
                $editButton = '<a data-toggle="modal" data-target="#ubah-harga" class="btn btn-outline-warning btn-xs btn-edit" title="Ubah"
                                data-id_price="'.$prc->id_price.'" data-id_event="'.$prc->id_event.'" data-kategori_price="'.$prc->kategori_price.'"
                                data-stock_tiket="'.$prc->stock_tiket.'" data-tiket="'.$prc->harga.'" data-akhir_promo="'.$prc->akhir_promo.'"
                                data-status="'.$prc->status.'" data-status_bundling="'.$prc->status_bundling.'" data-beli="'.$prc->beli.'"
                                data-gratis="'.$prc->gratis.'" data-tiket_bundling="'.$prc->tiket_bundling.'" data-status_bundling="'.$prc->status_bundling.'">
                                <i class="fa fa-edit"></i>
                            </a>';
            } elseif ($prc->status_bundling == '1') {
                $editButton = '<a data-toggle="modal" data-target="#ubah-bundling" class="btn btn-outline-info btn-xs btn-edit" title="Ubah"
                                data-id_price="'.$prc->id_price.'" data-id_event="'.$prc->id_event.'" data-kategori_price="'.$prc->kategori_price.'"
                                data-stock_tiket="'.$prc->stock_tiket.'" data-tiket="'.$prc->harga.'" data-akhir_promo="'.$prc->akhir_promo.'"
                                data-status="'.$prc->status.'" data-status_bundling="'.$prc->status_bundling.'" data-beli="'.$prc->beli.'"
                                data-gratis="'.$prc->gratis.'" data-tiket_bundling="'.$prc->tiket_bundling.'" data-status_bundling="'.$prc->status_bundling.'">
                                <i class="fa fa-edit"></i>
                            </a>';
            }

            // tombol Hapus
            $hapusButton = ' &nbsp; <a href="#" onclick="confirmDelete('.$prc->id_price.');"  class="btn btn-outline-danger btn-xs" title="Hapus"><i class="fa fa-trash-o"></i></a>';

            // label status
            $status = '';

            if ($prc->stock_tiket == '0') {
                $status = '<td class="font-weight-medium"><div class="badge badge-danger shadow bg-danger text-light rounded">Sold Out</div></td>';
            } elseif ($prc->stock_tiket < ($prc->beli + $prc->gratis)) {
                $status = '<td class="font-weight-medium"><div class="badge badge-warning shadow bg-warning rounded text-dark">Stok Kurang</div></td>';
            } elseif ($prc->status == '0') {
                $status = '<td class="font-weight-medium"><div class="badge badge-success shadow bg-white rounded">Stock Ready</div></td>';
            } elseif ($prc->status == '1') {
                $status = '<td class="font-weight-medium"><div class="badge badge-primary shadow bg-white rounded">Promo Active</div></td>';
            } elseif ($prc->status == '2') {
                $status = '<td class="font-weight-medium"><div class="badge badge-danger shadow bg-white rounded">Sold Out</div></td>';
            }


            $kategori_price = '<p class="c_name">' . $prc->kategori_price;
            if ($prc->tiket_bundling > 0) {
                $kategori_price .= '<span class="l-salmon text-dark m-l-10 hidden-sm-down rounded"> Bundling ' . $prc->tiket_bundling . ' </span>';
            } elseif ($prc->beli > 1) {
                $kategori_price .= '<span class="l-green text-dark m-l-10 hidden-sm-down rounded"> Buy ' . $prc->beli . ' Free ' . $prc->gratis . ' </span>';
            } elseif ($prc->status == 1 && $prc->beli == 1) {
                $kategori_price .= '<span class=" l-blue text-dark m-l-10 hidden-sm-down rounded"> Promo </span>';
            }
            $kategori_price .= '</p>';



            $no++;
            $row    = array();
            $row[]  = $no.".";
            $row[]  = ' &nbsp; ' . '<td class="font-weight-medium"><div class="badge badge-dark shadow-lg rounded">' . $prc->nm_event . '</div></td>';
            $row[]  = $kategori_price;
            $row[]  = $Rp_harga;
            $row[]  = $prc->stock_tiket;
            $row[]  = $prc->akhir_promo;
            $row[]  = $status;
            $row[]  = $editButton. $hapusButton  ;
            $data[] = $row;
        }
        $output = array(
                    "draw" => @$_POST['draw'],
                    "recordsTotal" => $this->Prices_model->count_all_trx($privilage, $id_user, $id_event),
                    "recordsFiltered" => $this->Prices_model->count_filtereds($privilage, $id_user, $id_event),
                    "data" => $data,
        );

        echo json_encode($output);
    }

    function input_price()
    {
        $status = $this->input->post('status');
        $buyInput = $this->input->post('buy');
        $beli = ($status == 1 && $buyInput != '') ? $buyInput : 1;


        $data = array(
            'id_event' => $this->input->post('id_event'),
            'kategori_price' => $this->input->post('kategori_price'),
            'harga' => $this->input->post('harga'),
            'stock_tiket' => $this->input->post('stock_tiket'),
            'status' => $this->input->post('status'),
            'akhir_promo' => $this->input->post('akhir_promo'),
            'beli' => $beli,
            'gratis' => $this->input->post('free')
        );

        $result = $this->Prices_model->save_price($data);

        if ($result) {
            $response = array('status' => 'success', 'message' => 'Data berhasil disimpan.');
        } else {
            $response = array('status' => 'error', 'message' => 'Gagal menyimpan data.');
        }

        echo json_encode($response);
    }

    function hapus($params = '')
    {
        $response = array('status' => false, 'message' => '');

        if ($params !== '') {
            $result = $this->Prices_model->hapus_price($params);

            if ($result) {
                $response['status'] = true;
                $response['message'] = 'Data berhasil dihapus.';
            } else {
                $response['message'] = 'Gagal menghapus data.';
            }
        } else {
            $response['message'] = 'Data tidak valid untuk dihapus.';
        }

        echo json_encode($response);

    }

    public function edit_price() {

        $id_price = $this->input->post('id_price');
        $id_event = $this->input->post('id_event');
        $kategori_price = $this->input->post('kategori_price');
        $harga = $this->input->post('harga');
        $stock_tiket = $this->input->post('stock_tiket');
        $akhir_promo = $this->input->post('akhir_promo');
        $status = $this->input->post('status');

                // var_dump($_POST);

            if (!empty($id_price)) {
                $data = array(
                    'id_price' => $id_price,
                    'id_event' => $id_event,
                    'kategori_price' => $kategori_price,
                    'harga' => $harga,
                    'stock_tiket' => $stock_tiket,
                    'akhir_promo' =>$akhir_promo,
                    'status' => $status
                );

                $update_status = $this->Prices_model->update_data('price', $data, $id_price);

                if ($update_status) {
                    $response['status'] = true;
                    $response['message'] = 'Data berhasil diperbarui.';
                } else {
                    $response['status'] = false;
                    $response['message'] = 'Terjadi kesalahan saat memperbarui data di database.';
                }
            } else {
                $response['status'] = false;
                $response['message'] = 'ID tidak valid. Data tidak dapat diperbarui.';
            }

            $this->output->set_content_type('application/json');
            $this->output->set_output(json_encode($response));
    }

// kode untuk membuat bundling
    public function get_ajax_tiket()
    {
        $privilage = $this->session->userdata('userdata')->privilage;
        $id_event = $this->input->post('id_event_bundle');
        $query = $this->Prices_model->get_tiket($id_event, $privilage);

        header('Content-Type: application/json');
        echo json_encode($query);
    }


    function create_bundling()
    {
        $id_event = $this->input->post('id_event');
        $kategori_price = $this->input->post('kategori_price');
        $harga = $this->input->post('harga');
        $stock_tiket = $this->input->post('stock_tiket');
        $id_price = $this->input->post('id_price');
        $isi_bundle = $this->input->post('isi_bundle');

        $data = array(
            'id_event' => $id_event,
            'kategori_price' => $kategori_price,
            'harga' => $harga,
            'stock_tiket' => $stock_tiket,
            'status_bundling' => 1,
            'tiket_bundling' => $isi_bundle
        );

        // var_dump($data);

        $update = array(
            'stock_tiket' => $this->input->post('tiket_reg'),
        );

        $result = $this->Prices_model->save_bundle($data);
        $update_status = $this->Prices_model->update_data('price', $update, $id_price);

        if ($result && $update_status) {
            $response = array('status' => 'success', 'message' => 'Data berhasil disimpan.');
        } else {
            $response = array('status' => 'error', 'message' => 'Gagal menyimpan data.');
        }

        echo json_encode($response);
    }

    public function fetch()
    {
        $output = '';

        $id_user = $this->session->userdata('userdata')->id_user;
        $limit = $this->input->post('limit');
        $start = $this->input->post('start');
        $search = $this->input->post('search');

        $data = $this->Prices_model->get_event_menu($limit, $start, $id_user, $search);

        if ($data->num_rows() > 0) {
            foreach ($data->result() as $event) {
                $output .= '
                    <div class="col-lg-3 col-md-4 col-sm-12 p-0 m-0">
                        <div class="card product_item" style="max-width: 90%;">
                            <div class="body m-1 p-1">
                                <div class="cp_img">
                                    <img src="' . base_url('upload/event/' . $event->poster) . '" alt="Product" class="img-fluid" style="max-width: 75%; height: auto; display: block; margin: 0 auto;">
                                    <div class="hover">
                                        <a href="' . base_url('Prices/list_price/' . $event->id_event) . '" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Lihat">
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
        }
    }

}