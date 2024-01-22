<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Event extends AUTH_Controller
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
        $this->load->model('Event_model');

    }

    public function index()
    {
        $id_user = $this->session->userdata('userdata')->id_user;
        $privilage = $this->session->userdata('userdata')->privilage;

        $data['userdata']        = $this->userdata;
        $data['tittle']          = 'Event';
        $data['bread']           = 'Daftar Event';
        $data['option']          = $this->Event_model->get_agency($privilage, $id_user);
        $data['content']         = 'page_admin/event/event';
        $data['script']          = 'page_admin/event/event_js';
        $this->load->view($this->template, $data);
    }

    function get_dataevent() {
        $id_user = $this->session->userdata('userdata')->id_user;
        $privilage = $this->session->userdata('userdata')->privilage;

        $list = $this->Event_model->get_datatablest($privilage, $id_user);
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $evn) {

            // tombol edit
            $editButton = '<a data-toggle="modal" data-target="#ubah-event" class="btn btn-outline-warning btn-xs btn-edit" title="Ubah"
            data-id_event="'.$evn->id_event.'" data-id_user="'.$evn->id_user.'" data-nm_event="'.$evn->nm_event.'" data-tgl_event="'.$evn->tgl_event.'" data-jam_event="'.$evn->jam_event.'" data-batas_pesan="'.$evn->batas_pesan.'" data-lokasi="'.$evn->lokasi.'" data-kota="'.$evn->kota.'" data-alamat="'.$evn->alamat.'" data-kategori_event="'.$evn->kategori_event.'" data-desc_event="'.$evn->desc_event.'" data-mc_by="'.$evn->mc_by.'" data-poster="'.$evn->poster.'" data-header="'.$evn->header.'"><i class="fa fa-edit"></i></a>';

            // tombol Hapus
            $hapusButton = ' &nbsp; <a href="#" onclick="confirmDelete('.$evn->id_event.');"  class="btn btn-outline-danger btn-xs" title="Hapus"><i class="fa fa-trash-o"></i></a>';

            $no++;
            $row = array();
            $row[] = $no.".";
            $row[] = '<td class="poster-column"><img src="' . base_url('upload/event/') . $evn->poster . '" alt="Poster Acara" class="border border-primary m-0 p-0 img-thumbnail max-height-7rem img-fluid"></td>';
            $row[] = '<td class="header-column"><img src="' . base_url('upload/event/') . $evn->header . '" alt="Header Acara" class="border border-success m-0 p-0 img-thumbnail max-height-7rem img-fluid"></td>';
            $row[] = ' &nbsp; ' . '<td class="font-weight-medium"><div class="badge badge-info shadow l-khaki text-dark rounded">' . $evn->agency . '</div></td>';
            $row[] = $evn->nm_event;
            $row[] = $evn->tgl_event;
            $row[] = $evn->jam_event;
            $row[] = $evn->batas_pesan;
            $row[] = $evn->lokasi;
            $row[] = $evn->nama;
            $row[] = $evn->alamat;
            $row[] = $evn->kategori_event;
            $row[] = $evn->desc_event;
            $row[] = $evn->mc_by;
            $row[] = $editButton. $hapusButton  ;
            $data[] = $row;
        }
        $output = array(
                    "draw" => @$_POST['draw'],
                    "recordsTotal" => $this->Event_model->count_all_trx($privilage, $id_user),
                    "recordsFiltered" => $this->Event_model->count_filtereds($privilage, $id_user),
                    "data" => $data,
                );

        echo json_encode($output);
    }

    function get_ajax_kab(){
        $query = $this->Event_model->get_kabupaten();
        $data = "<option value=''>- Pilih Kota -</option>";
        foreach ($query as $value) {
            $data .= "<option value='".$value->id."'>".$value->nama."</option>";
        }
        echo $data;

    }

    function input_event()
    {
        $config['upload_path'] = "./upload/event";
        $config['allowed_types'] = 'gif|jpg|png';
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('poster')) {
            $upload_data = $this->upload->data();
            $poster = $upload_data['file_name'];
        } else {
            $poster = '';
        }

        if ($this->upload->do_upload('header')) {
            $upload_data = $this->upload->data();
            $header = $upload_data['file_name'];
        } else {
            $header = '';
        }

        $data = array(
            'id_user'        => $this->input->post('id_user'),
            'nm_event'       => $this->input->post('nm_event'),
            'tgl_event'      => $this->input->post('tgl_event'),
            'jam_event'      => $this->input->post('jam_event'),
            'batas_pesan'    => $this->input->post('batas_pesan'),
            'lokasi'         => $this->input->post('lokasi'),
            'kota'           => $this->input->post('kota'),
            'alamat'         => $this->input->post('alamat'),
            'kategori_event' => $this->input->post('kategori_event'),
            'desc_event'     => $this->input->post('desc_event'),
            'mc_by'          => $this->input->post('mc_by'),
            'poster'         => $poster,
            'header'         => $header
        );

        $result = $this->Event_model->save_event($data);

        if ($result) {
            $response = array('status' => 'success', 'message' => 'Data berhasil disimpan.');
        } else {
            $response = array('status' => 'error', 'message' => 'Gagal menyimpan data.');
        }

        echo json_encode($response);
    }

    function delete_event($event_id) {
        $response = array('status' => false, 'message' => '');
        $event_data = $this->Event_model->get_event_data($event_id);

        if ($event_data) {
            if ($event_data['poster'] != null) {
                $poster_file = FCPATH . 'upload/event/' . $event_data['poster'];
                if (file_exists($poster_file)) {
                    if (unlink($poster_file)) {
                        if ($event_data['header'] != null) {
                            $header_file = FCPATH . 'upload/event/' . $event_data['header'];
                            if (file_exists($header_file)) {
                                unlink($header_file);
                            }
                        }

                        $this->Event_model->delete_event($event_id);
                        $response['status'] = true;
                    } else {
                        $response['message'] = 'Gagal menghapus file poster.';
                    }
                }
            } else {

                if ($event_data['header'] != null) {
                    $header_file = FCPATH . 'upload/event/' . $event_data['header'];
                    if (file_exists($header_file)) {
                        unlink($header_file);
                    }
                }

                $this->Event_model->delete_event($event_id);
                $response['status'] = true;
            }
        } else {
            $response['message'] = 'Data tidak ditemukan.';
        }

        echo json_encode($response);
    }

    function edit_data()
    {
        $id_event = $this->input->post('id_event');

        // Konfigurasi upload gambar baru
        $config['upload_path'] = "./upload/event";
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size']      = 2048;
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);

        $edit_poster = '';
        $edit_header = '';

        // Proses upload gambar baru untuk poster
        if ($this->upload->do_upload('edit_poster')) {
            $upload_data = $this->upload->data();
            $edit_poster = $upload_data['file_name'];

            $this->hapus_gambar_lama($id_event, 'poster');
        }

        // Proses upload gambar baru untuk header
        if ($this->upload->do_upload('edit_header')) {
            $upload_data = $this->upload->data();
            $edit_header = $upload_data['file_name'];

            $this->hapus_gambar_lama($id_event, 'header');
        }

        // Data untuk diupdate
        $data = array(
            'id_user'        => $this->input->post('id_user'),
            'nm_event'       => $this->input->post('nm_event'),
            'tgl_event'      => $this->input->post('tgl_event'),
            'batas_pesan'    => $this->input->post('batas_pesan'),
            'lokasi'         => $this->input->post('lokasi'),
            'kota'           => $this->input->post('kota'),
            'alamat'         => $this->input->post('alamat'),
            'kategori_event' => $this->input->post('kategori_event'),
            'mc_by'          => $this->input->post('mc'),
            'desc_event'     => $this->input->post('desc_event'),
        );

        // Tambahkan gambar baru ke dalam data jika diunggah
        if ($edit_poster != '') {
            $data['poster'] = $edit_poster;
        }

        if ($edit_header != '') {
            $data['header'] = $edit_header;
        }

        // Update data
        $update_status = $this->Event_model->update_data('event', $data, $id_event);

        if ($update_status) {
            $response['status'] = true;
            $response['message'] = 'Data berhasil diperbarui.';
        } else {
            $response['status'] = false;
            $response['message'] = 'Terjadi kesalahan saat memperbarui data di database.';
        }

        echo json_encode($response);
    }

    function hapus_gambar_lama($event_id, $jenis)
    {
        $event_data = $this->Event_model->get_event_data($event_id);

        if (!empty($event_data)) {
            $gambar_lama = $event_data[$jenis];

            if (!empty($gambar_lama)) {
                $path_gambar = "./upload/event/" . $gambar_lama;
                if (file_exists($path_gambar)) {
                    unlink($path_gambar);
                }
            }
        }
    }


}