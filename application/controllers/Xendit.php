<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Xendit extends AUTH_Controller
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
        $this->load->model('Xendit_model');

    }

    public function index()
    {
        $data['userdata']       = $this->userdata;
        $data['tittle']          = 'Data Key';
        $data['bread']          = 'Xendit Setting';
        $data['content']        = 'page_admin/xendit/xendit';
        $data['script']         = 'page_admin/xendit/xendit_js';
        $this->load->view($this->template, $data);
    }

    function get_dataxendit() {
        // $id = $this->session->userdata('userdata')->id_rtrw;
        // $role = $this->session->userdata('userdata')->role;
        // $status_trans = $this->input->post('status');

        $list = $this->Xendit_model->get_datatablest();
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $xnd) {

            // tombol edit
            $editButton = '<a data-toggle="modal" data-target="#setting" class="btn btn-outline-warning btn-xs btn-edit" title="Ubah"
            data-id="'.$xnd->id.'" data-name="'.$xnd->name.'" data-value="'.$xnd->value.'" data-akun="'.$xnd->akun.'" data-status="'.$xnd->status.'" ><i class="fa fa-edit"></i></a>';


            // // tombol Hapus
            $hapusButton = ' &nbsp; <a href="#" onclick="confirmDelete('.$xnd->id.');"  class="btn btn-outline-danger btn-xs" title="Hapus"><i class="fa fa-trash-o"></i></a>';

            // label
            $status = '';
            if ($xnd->status == '0') {
                $status = '<td class="font-weight-medium"><div class="badge badge-info shadow l-amber text-dark rounded">Non Active</div></td>';
            } elseif ($xnd->status == '1') {
                $status = '<td class="font-weight-medium"><div class="badge badge-success shadow l-blue text-dark rounded">Active</div></td>';
            }

            $akun = '';
            if ($xnd->akun == '0') {
                $akun = '<td class="font-weight-medium"><div class="badge badge-info shadow l-blush text-white rounded">Demo</div></td>';
            } elseif ($xnd->akun == '1') {
                $akun = '<td class="font-weight-medium"><div class="badge badge-success shadow l-seagreen text-dark rounded">Live</div></td>';
            }

            $no++;
            $row = array();
            $row[] = $no.".";
            $row[] = $xnd->name;
            $row[] = $xnd->value;
            $row[] = $akun;
            $row[] = $status;
            $row[] = $editButton. $hapusButton  ;
            $data[] = $row;
        }
        $output = array(
                    "draw" => @$_POST['draw'],
                    "recordsTotal" => $this->Xendit_model->count_all(),
                    "recordsFiltered" => $this->Xendit_model->count_filtereds(),
                    "data" => $data,
                );

        echo json_encode($output);
    }

    function hapus($params = '')
    {
        $response = array('status' => false, 'message' => '');

        if ($params !== '') {
            $result =  $this->Xendit_model->hapus($params);

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

    public function edit_data() {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $value = $this->input->post('value');
        $akun= $this->input->post('akun');
        $status = $this->input->post('status');

        if (!empty($id)) {
            $data = array(
                'name' => $name,
                'value' => $value,
                'akun' => $akun,
                'status' => $status,
            );

            $update_status = $this->Xendit_model->update_data('pengaturan', $data, $id);

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