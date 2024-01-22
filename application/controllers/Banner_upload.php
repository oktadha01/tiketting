<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Banner_upload extends AUTH_Controller
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
        $this->load->model('Banner_kat_model');

    }

    public function index()
    {
        $data['userdata']        = $this->userdata;
        $data['tittle']          = 'Upload Banner';
        $data['bread']           = 'Header';
        // $data['option']          = $this->Banner_kat_model->get_agency();
        $data['content']         = 'page_admin/banner_kat/upload_banner';
        $data['script']          = 'page_admin/banner_kat/upload_js';
        $this->load->view($this->template, $data);
    }

    function upload_banner()
    {
        $config['upload_path'] = "./upload/banner";
        $config['allowed_types'] = 'gif|jpg|png';
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('header')) {
            $upload_data = $this->upload->data();
            $header = $upload_data['file_name'];
        } else {
            $header = '';
        }

        $data = array(
            'header'         => $header
        );

        $result = $this->Banner_kat_model->save_banner($data);

        if ($result) {
            $response = array('status' => 'success', 'message' => 'Data berhasil disimpan.');
        } else {
            $response = array('status' => 'error', 'message' => 'Gagal menyimpan data.');
        }

        echo json_encode($response);
    }

    function get_banner() {

        $list = $this->Banner_kat_model->get_datatablest();
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $bnr) {

            // tombol edit
            $editButton = '<a data-toggle="modal" data-target="#ubah-banner" class="btn btn-outline-warning btn-xs btn-edit" title="Ubah"
            data-id_banner="'.$bnr->id_banner.'" data-header="'.$bnr->header.'"><i class="fa fa-edit"></i></a>';

            // tombol Hapus
            $hapusButton = ' &nbsp; <a href="#" onclick="confirmDelete('.$bnr->id_banner.');"  class="btn btn-outline-danger btn-xs" title="Hapus"><i class="fa fa-trash-o"></i></a>';

            $no++;
            $row = array();
            $row[] = $no.".";
            $row[] = '<td class="header-column"><img src="' . base_url('upload/banner/') . $bnr->header . '" alt="Header Acara" class="border border-success m-0 p-0 img-thumbnail max-height-7rem img-fluid"></td>';
            $row[] = $editButton. $hapusButton  ;
            $data[] = $row;
        }
        $output = array(
                    "draw" => @$_POST['draw'],
                    "recordsTotal" => $this->Banner_kat_model->count_all_trx(),
                    "recordsFiltered" => $this->Banner_kat_model->count_filtereds(),
                    "data" => $data,
                );

        echo json_encode($output);
    }

    public function delete_banner($banner_id) {
        $response = array('status' => false, 'message' => '');
        $banner_data = $this->Banner_kat_model->get_banner_data($banner_id);

        if ($banner_data) {
            if ($banner_data['header'] != null) {
                $header_file = FCPATH . 'upload/banner/' . $banner_data['header'];
                if (file_exists($header_file)) {
                    if (unlink($header_file)) {
                        $this->Banner_kat_model->delete_banner($banner_id);
                        $response['status'] = true;
                    } else {
                        $response['message'] = 'Gagal menghapus file poster.';
                    }
                }
            }
        } else {
            $response['message'] = 'Data tidak ditemukan.';
        }

        echo json_encode($response);
    }

    function edit_data()
    {
        $id_banner = $this->input->post('id_banner');

        // Konfigurasi upload gambar baru
        $config['upload_path'] = "./upload/banner";
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size']      = 1024;
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);

        $edit_header = '';

        // Proses upload gambar baru untuk header
        if ($this->upload->do_upload('edit_header')) {
            $upload_data = $this->upload->data();
            $edit_header = $upload_data['file_name'];

            $this->hapus_gambar_lama($id_banner, 'header');
        }

        // Tambahkan gambar baru ke dalam data jika diunggah

        if ($edit_header != '') {
            $data['header'] = $edit_header;
        }

        // Update data
        $update_status = $this->Banner_kat_model->update_data('banner', $data, $id_banner);

        if ($update_status) {
            $response['status'] = true;
            $response['message'] = 'Data berhasil diperbarui.';
        } else {
            $response['status'] = false;
            $response['message'] = 'Terjadi kesalahan saat memperbarui data di database.';
        }

        echo json_encode($response);
    }

    function hapus_gambar_lama($banner_id, $header)
    {
        $banner_data = $this->Banner_kat_model->get_banner_data($banner_id);

        if (!empty($banner_data)) {
            $gambar_lama = $banner_data[$header];

            if (!empty($gambar_lama)) {
                $path_gambar = "./upload/banner/" . $gambar_lama;
                if (file_exists($path_gambar)) {
                    unlink($path_gambar);
                }
            }
        }
    }

}