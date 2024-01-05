<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Perform extends AUTH_Controller
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
        $this->load->model('Perform_model');

    }

    public function index()
    {
        $data['userdata']       = $this->userdata;
        $data['tittle']         = 'Menu Perform';
        $data['bread']          = 'Perform';
        $data['content']        = 'page_admin/perform/perform';
        $data['script']         = 'page_admin/perform/perform_js';
        $this->load->view($this->template, $data);
    }

    function get_ajax_event(){
        $id_user = $this->session->userdata('userdata')->id_user;
        $privilage = $this->session->userdata('userdata')->privilage;

        $query = $this->Perform_model->get_event($privilage, $id_user);
        $data = "<option value=''>- Pilih Event -</option>";
        foreach ($query as $value) {
            $data .= "<option value='".$value->id_event."'>".$value->nm_event."</option>";
        }
        echo $data;

    }

    function get_dataperform() {
        $id_user = $this->session->userdata('userdata')->id_user;
        $privilage = $this->session->userdata('userdata')->privilage;

        $list = $this->Perform_model->get_datatablest($privilage, $id_user);
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $prfm) {

            // tombol edit
            $editButton = '<a data-toggle="modal" data-target="#ubah-perform" class="btn btn-outline-warning btn-xs btn-edit" title="Ubah"
            data-id_perform="'.$prfm->id_perform.'" data-id_event="'.$prfm->id_event.'" data-nama_artis="'.$prfm->nama_artis.'" data-status_perform="'.$prfm->status_perform.'"><i class="fa fa-edit"></i></a>';


            // tombol Hapus
            $hapusButton = ' &nbsp; <a href="#" onclick="confirmDelete('.$prfm->id_perform.');"  class="btn btn-outline-danger btn-xs" title="Hapus"><i class="fa fa-trash-o"></i></a>';

            // label
            $status_perform = '';
            if ($prfm->status_perform == '1') {
                $status_perform = '<td class="font-weight-medium"><div class="badge badge-info shadow l-parpl text-white rounded ">Special Perfomence</div></td>';
            } elseif ($prfm->status_perform == '2') {
                $status_perform = '<td class="font-weight-medium"><div class="badge badge-info shadow l-green text-dark rounded">Also Perfoming</div></td>';
            }

            $no++;
            $row = array();
            $row[] = $no.".";
            $row[] = ' &nbsp; ' . '<td class="font-weight-medium"><div class="badge badge-dark shadow-lg rounded">' . $prfm->nm_event . '</div></td>';
            $row[] = $prfm->nama_artis;
            $row[] = $status_perform;
            $row[] =$editButton. $hapusButton  ;
            $data[] = $row;
        }
        $output = array(
                    "draw" => @$_POST['draw'],
                    "recordsTotal" => $this->Perform_model->count_all_trx($privilage, $id_user),
                    "recordsFiltered" => $this->Perform_model->count_filtereds($privilage, $id_user),
                    "data" => $data,
                );

        echo json_encode($output);
    }

    function input_perform()
    {
        $data = array(
            'id_event' => $this->input->post('id_event'),
            'nama_artis' => $this->input->post('nama_artis'),
            'status_perform' => $this->input->post('status_perform')
        );

        $result = $this->Perform_model->save_perform($data);

        if ($result) {
            $response = array('status' => 'success', 'message' => 'Data berhasil disimpan.');
        } else {
            $response = array('status' => 'error', 'message' => 'Gagal menyimpan data.');
        }

        echo json_encode($response);
    }

    function hapus($params = '')
    {
        $this->Perform_model->hapus_perform($params);
        $this->session->set_flashdata('sukses', 'Data berhasil dihapus.');
        return redirect('Perform');
    }

    public function edit_data() {

        $id_perform = $this->input->post('id_perform');
        $id_event = $this->input->post('id_event');
        $nama_artis = $this->input->post('nama_artis');
        $status_perform = $this->input->post('status_perform');

                // var_dump($_POST);

            if (!empty($id_perform)) {
                $data = array(
                    'id_perform' => $id_perform,
                    'id_event' => $id_event,
                    'nama_artis' => $nama_artis,
                    'status_perform' => $status_perform,
                );

                $update_status = $this->Perform_model->update_data('perform', $data, $id_perform);

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