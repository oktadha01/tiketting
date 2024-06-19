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

        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0755, true);
        }

        $this->load->library('upload', $config);
        $default_background = 'default_upload.png';

        $id_event = $this->input->post('id_event');
        $existing_data = $this->Custom_tiket_model->get_datacustom($id_event);

        // var_dump($existing_data);

        $background = null;

        if (!empty($_FILES['filePhoto']['name'])) {
            if (!empty($existing_data) && is_array($existing_data) && isset($existing_data[0]) && is_object($existing_data[0]) && property_exists($existing_data[0], 'background')) {
                $old_background = $existing_data[0]->background;
                $old_file_path = $config['upload_path'] . '/' . $old_background;

                if (file_exists($old_file_path)) {
                    unlink($old_file_path);
                }
            }

            if ($this->upload->do_upload('filePhoto')) {
                $upload_data = $this->upload->data();
                $background = $upload_data['file_name'];
            } else {
                $response = array('status' => 'error', 'message' => $this->upload->display_errors());
                echo json_encode($response);
                return;
            }
        } else {
            if (!empty($existing_data) && is_array($existing_data) && isset($existing_data[0]) && is_object($existing_data[0]) && property_exists($existing_data[0], 'background')) {
                $background = $existing_data[0]->background;
            } else {
                $background = $default_background;
            }
        }

        // var_dump($background);
        // exit;

        $update = array(
            'color_nama'        => $this->input->post('color_nama'),
            'color_email'       => $this->input->post('color_email'),
            'color_kategori'    => $this->input->post('color_kategori'),
            'color_code_tiket'  => $this->input->post('color_code_tiket'),
            'background'        => $background
        );

        $input = array(
            'color_nama'        => $this->input->post('color_nama'),
            'color_email'       => $this->input->post('color_email'),
            'color_kategori'    => $this->input->post('color_kategori'),
            'color_code_tiket'  => $this->input->post('color_code_tiket'),
            'background'        => $background
        );

        if ($existing_data) {
            $result = $this->Custom_tiket_model->update_design($id_event, $update);
        } else {
            $input['id_event'] = $id_event;
            $result = $this->Custom_tiket_model->save_design($input);
        }

        if ($result) {
            $response = array('status' => 'success', 'message' => 'Data berhasil disimpan.');
        } else {
            $response = array('status' => 'error', 'message' => 'Gagal menyimpan data ke database.');
        }

        echo json_encode($response);
    }

}