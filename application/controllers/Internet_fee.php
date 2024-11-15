<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Internet_fee extends AUTH_Controller
{
    var $template = 'tmpt_admin/index';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Fee_model');

    }

    public function index()
    {
        $data['userdata']       = $this->userdata;
        $data['tittle']         = 'Internet Fee Event ';
        $data['bread']          = 'Internet Fee Event';
        $data['content']        = 'page_admin/internet_fee/fee';
        $data['script']         = 'page_admin/internet_fee/fee_js';
        $this->load->view($this->template, $data);
    }

    public function fetch()
    {
        $output = '';

        $limit = $this->input->post('limit');
        $start = $this->input->post('start');
        $search = $this->input->post('search');

        $data = $this->Fee_model->get_event_menu($limit, $start, $search);

        if ($data->num_rows() > 0) {
            foreach ($data->result() as $event) {

                $nominal_fee    = !empty($event->nominal) ? $event->nominal : 0;
                $nominal_rupiah = 'Rp ' . number_format($nominal_fee, 0, ',', '.');
                $kategori       = !empty($event->kategori) ? $event->kategori : 'Kosong';

                $output .= '
                    <div class="col-lg-3 col-md-4 col-sm-12 p-0 m-0">
                        <div class="card product_item" style="max-width: 90%;">
                            <div class="body m-1 p-1">
                                <div class="cp_img">
                                    <img src="' . base_url('upload/event/' . $event->poster) . '" alt="Product" class="img-fluid" style="max-width: 75%; height: auto; display: block; margin: 0 auto;">
                                    <div class="hover">
                                        ' . (empty($event->id_fee) ? '
                                            <button class="btn btn-primary custom-btn-small" data-placement="top" title="Setting Fee" data-toggle="modal"
                                            data-target="#setting-fee" data-id="' . $event->id_event . '">
                                                <i class="fa fa-cc-diners-club"> Setting Fee</i>
                                            </button>
                                        ' : '
                                            <button type="button" class="btn btn-success custom-btn-small btn-edit" data-placement="top" data-toggle="modal"
                                            data-target="#ubah-fee" title="Ubah Fee" data-id="' . $event->id_fee . '" data-kategori="' . $event->kategori . '" data-nominal="' . $event->nominal . '">
                                                <i class="fa fa-cc-diners-club"> Ubah Fee</i>
                                            </button>
                                        ') . '
                                    </div>
                                </div>
                                <div class="product_details mt-1">
                                    <h5><span class="badge badge-primary bg-warning text-dark">' . $event->nm_event . '</span></h5>
                                    <ul class="product_price list-unstyled mt-1">
                                        <li class="old_price">Agency</li>
                                        <li class="new_price">' . $event->agency .'</li>
                                    </ul>
                                    <ul class="product_price list-unstyled mt-1">
                                        <li class="old_price">Internet Fee</li>
                                        <li class="new_price">' . $nominal_rupiah . '</li>
                                    </ul>
                                    <ul class="product_price list-unstyled mt-1">
                                        <li class="old_price">Kategori</li>
                                        <li class="new_price">' . $kategori . '</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>';
            }
            echo $output;
        }
    }

    function setting_fee()
    {
        $data = array(
            'id_event' => $this->input->post('id_event'),
            'kategori' => $this->input->post('kategori'),
            'nominal' => $this->input->post('nominal')
        );

        $result = $this->Fee_model->save_fee($data);

        if ($result) {
            $response = array('status' => 'success', 'message' => 'Data berhasil disimpan.');
        } else {
            $response = array('status' => 'error', 'message' => 'Gagal menyimpan data.');
        }

        echo json_encode($response);
    }

    public function edit_fee() {

        $id_fee     = $this->input->post('id_fee');
        $kategori   = $this->input->post('kategori');
        $nominal    = $this->input->post('nominal');

            if (!empty($id_fee)) {
                $data = array(
                    'id_fee'     => $id_fee,
                    'kategori'   => $kategori,
                    'nominal'    => $nominal,
                );

                $update_status = $this->Fee_model->update_data('internet_fee', $data, $id_fee);

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