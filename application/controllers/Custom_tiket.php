<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Custom_tiket extends AUTH_Controller
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
        $this->load->model('Custom_tiket_model');

    }

    public function kastemisasi()
    {
        $id_event                = $this->uri->segment(3);
        $data['userdata']        = $this->userdata;
        $data['tittle']          = 'Custom Tiket';
        $data['bread']           = 'Kustomisasi Tampilan Tiket';
        $data['kustomisasi']     = $this->Custom_tiket_model->get_datacustom($id_event);
        $data['content']         = 'page_admin/custom_tiket/tiket';
        $data['script']          = 'page_admin/custom_tiket/tiket_js';
        $this->load->view($this->template, $data);
    }

    public function get_color($id_event) {
        $color_data = $this->Custom_tiket_model->get_color_by_id_event($id_event);
        header('Content-Type: application/json');
        echo json_encode($color_data);
    }

    public function save_custom()
    {
        $config['upload_path'] = "./upload/backround_tiket";
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 1024 * 1;
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('filePhoto')) {
            $upload_data = $this->upload->data();
            $background = $upload_data['file_name'];
        } else {
            $background = 'default_upload.png';
        }

        $id_event = $this->input->post('id_event');

        $existing_data = $this->Custom_tiket_model->get_datacustom($id_event);

        if ($existing_data) {

            $data = array(
                'color_nama'        => $this->input->post('color_nama'),
                'color_email'       => $this->input->post('color_email'),
                'color_kategori'    => $this->input->post('color_kategori'),
                'color_code_tiket'  => $this->input->post('color_code_tiket'),
                'background'        => $background
            );

            $result = $this->Custom_tiket_model->update_design($id_event, $data);

        } else {

            $data = array(
                'id_event'          => $id_event,
                'color_nama'        => $this->input->post('color_nama'),
                'color_email'       => $this->input->post('color_email'),
                'color_kategori'    => $this->input->post('color_kategori'),
                'color_code_tiket'  => $this->input->post('color_code_tiket'),
                'background'        => $background
            );

            $result = $this->Custom_tiket_model->save_design($data);
        }

        if ($result) {
            $response = array('status' => 'success', 'message' => 'Data berhasil disimpan.');
        } else {
            $response = array('status' => 'error', 'message' => 'Gagal menyimpan data ke database.');
        }

        echo json_encode($response);
    }


}