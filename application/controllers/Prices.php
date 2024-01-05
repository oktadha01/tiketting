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
        $data['userdata']       = $this->userdata;
        $data['tittle']         = 'Menu Prices';
        $data['bread']          = 'Prices';
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
        // $status_trans = $this->input->post('status');

        $list = $this->Prices_model->get_datatablest($privilage, $id_user);
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $prc) {

            // format harga rupiah
            $harga = $prc->harga;
            $Rp_harga = 'Rp. ' . number_format($harga, 0, ',', '.');

            // tombol edit
            $editButton = '<a data-toggle="modal" data-target="#ubah-harga" class="btn btn-outline-warning btn-xs btn-edit" title="Ubah"
            data-id_price="'.$prc->id_price.'" data-id_event="'.$prc->id_event.'" data-kategori_price="'.$prc->kategori_price.'" data-jumlah_tiket="'.$prc->jumlah_tiket.'" data-stock_tiket="'.$prc->stock_tiket.'" data-tiket="'.$prc->harga.'" data-akhir_promo="'.$prc->akhir_promo.'" data-status="'.$prc->status.'"><i class="fa fa-edit"></i></a>';

            // tombol Hapus
            $hapusButton = ' &nbsp; <a href="#" onclick="confirmDelete('.$prc->id_price.');"  class="btn btn-outline-danger btn-xs" title="Hapus"><i class="fa fa-trash-o"></i></a>';

            // label status
            $status = '';
            if ($prc->status == '0') {
                $status = '<td class="font-weight-medium"><div class="badge badge-danger shadow bg-white rounded">Non Active</div></td>';
            } elseif ($prc->status == '1') {
                $status = '<td class="font-weight-medium"><div class="badge badge-success shadow bg-white rounded">Active</div></td>';
            }

            $no++;
            $row    = array();
            $row[]  = $no.".";
            $row[]  = ' &nbsp; ' . '<td class="font-weight-medium"><div class="badge badge-dark shadow-lg rounded">' . $prc->nm_event . '</div></td>';
            $row[]  = $prc->kategori_price;
            $row[]  = $Rp_harga;
            $row[]  = $prc->jumlah_tiket;
            $row[]  = $prc->stock_tiket;
            $row[]  = $prc->akhir_promo;
            $row[]  = $status;
            $row[]  = $editButton. $hapusButton  ;
            $data[] = $row;
        }
        $output = array(
                    "draw" => @$_POST['draw'],
                    "recordsTotal" => $this->Prices_model->count_all_trx($privilage, $id_user),
                    "recordsFiltered" => $this->Prices_model->count_filtereds($privilage, $id_user),
                    "data" => $data,
        );

        echo json_encode($output);
    }

    function input_price()
    {
        $data = array(
            'id_event' => $this->input->post('id_event'),
            'kategori_price' => $this->input->post('kategori_price'),
            'harga' => $this->input->post('harga'),
            'jumlah_tiket' => $this->input->post('jumlah_tiket'),
            'stock_tiket' => $this->input->post('stock_tiket'),
            'status' => $this->input->post('status'),
            'akhir_promo' => $this->input->post('akhir_promo')
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
        $this->Prices_model->hapus_price($params);
        $this->session->set_flashdata('sukses', 'Data berhasil dihapus.');
        return redirect('Prices');
    }

    public function edit_price() {

        $id_price = $this->input->post('id_price');
        $id_event = $this->input->post('id_event');
        $kategori_price = $this->input->post('kategori_price');
        $harga = $this->input->post('harga');
        $jumlah_tiket = $this->input->post('jumlah_tiket');
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
                    'jumlah_tiket' => $jumlah_tiket,
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


}