<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends AUTH_Controller
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
        $this->load->model('User_model');

    }

    public function index()
    {
        $data['userdata']       = $this->userdata;
        $data['tittle']         = 'Halaman Kelola User';
        $data['bread']          = 'User';
        $data['content']        = 'page_admin/user/user';
        $data['script']         = 'page_admin/user/user_js';
        $this->load->view($this->template, $data);
    }

    function get_datauser() {
        // $id = $this->session->userdata('userdata')->id_user;
        // $privilage = $this->session->userdata('userdata')->privilage;

        $list = $this->User_model->get_datatablest();
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $usr) {

            // tombol edit
            $editButton = '<a data-toggle="modal" data-target="#ubah-user" class="btn btn-outline-warning btn-xs btn-edit" title="Ubah"
            data-id_user="'.$usr->id_user.'" data-agency="'.$usr->agency.'" data-nama="'.$usr->nm_user.'" data-alamat="'.$usr->alamat.'" data-email="'.$usr->email.'" data-password="'.$usr->password.'" data-kontak="'.$usr->kontak.'" data-privilage="'.$usr->privilage.'" ><i class="fa fa-edit"></i></a>';


            // tombol Hapus
            $hapusButton = ' &nbsp; <a href="#" onclick="confirmDelete('.$usr->id_user.');"  class="btn btn-outline-danger btn-xs" title="Hapus"><i class="fa fa-trash-o"></i></a>';

            // label
            $privilage = '';
            if ($usr->privilage == 'User') {
                $privilage = '<td class="font-weight-medium"><div class="badge badge-info shadow bg-white rounded">User</div></td>';
            } elseif ($usr->privilage == 'Admin') {
                $privilage = '<td class="font-weight-medium"><div class="badge badge-success shadow bg-white rounded">Admin</div></td>';
            }

            $no++;
            $row = array();
            $row[] = $no.".";
            $row[] = ' &nbsp; ' . '<td class="font-weight-medium"><div class="badge badge-dark shadow-lg rounded">' . $usr->agency . '</div></td>';
            $row[] = $usr->nm_user;
            $row[] = $usr->alamat;
            $row[] = $usr->email;
            $row[] = $usr->kontak;
            $row[] =$privilage;
            $row[] =$editButton. $hapusButton  ;
            $data[] = $row;
        }
        $output = array(
                    "draw" => @$_POST['draw'],
                    "recordsTotal" => $this->User_model->count_all_trx(),
                    "recordsFiltered" => $this->User_model->count_filtereds(),
                    "data" => $data,
                );

        echo json_encode($output);
    }

    function hapus($params = '')
    {
        $response = array('status' => false, 'message' => '');

        if ($params !== '') {
            $result = $this->User_model->hapus_user($params);

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

    function input_user()
    {
        $data = array(
            'agency'     => $this->input->post('agency'),
            'nm_user'    => $this->input->post('nama'),
            'alamat'     => $this->input->post('alamat'),
            'email'      => $this->input->post('email'),
            'kontak'     => $this->input->post('kontak'),
            'password'   => md5($this->input->post('password')),
            'privilage'  => $this->input->post('privilage'),
            'fot_profil' => 'default.jpg'
        );

        $result = $this->User_model->save_user($data);

        if ($result) {
            $response = array('status' => 'success', 'message' => 'Data berhasil disimpan.');
        } else {
            $response = array('status' => 'error', 'message' => 'Gagal menyimpan data.');
        }

        echo json_encode($response);
    }

    public function edit_data() {
        $id = $this->input->post('id');
        $agency = $this->input->post('agency');
        $nm_user = $this->input->post('nama');
        $alamat = $this->input->post('alamat');
        $email = $this->input->post('email');
        $kontak = $this->input->post('kontak');
        $password = $this->input->post('password');
        $privilage = $this->input->post('privilage');

            // var_dump($_POST);

        if (!empty($id)) {
            $data = array(
                'agency' => $agency,
                'nm_user' => $nm_user,
                'alamat' => $alamat,
                'email' => $email,
                'kontak' => $kontak,
                'password' => md5($this->input->post('password')),
                'privilage' => $privilage,
            );

            $update_status = $this->User_model->update_data('user', $data, $id);

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