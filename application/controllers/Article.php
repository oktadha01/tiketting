<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Article extends AUTH_Controller
{
    var $template = 'tmpt_admin/index';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Article_model');

    }

    public function index()
    {

        $data['userdata']       = $this->userdata;
        $data['tittle']         = 'Data Article ';
        $data['bread']          = 'List Article';
        $data['content']        = 'page_admin/article/article';
        $data['script']         = 'page_admin/article/article_js';
        $this->load->view($this->template, $data);
    }

    public function get_data_gambar() {

        $id_content = $this->input->post('id_content');
        $gambar_content = $this->Article_model->get_gbr_content($id_content);

        $image_urls = array();
        foreach ($gambar_content as $foto) {
            $image_urls[] = array(
                'id_gambar' => $foto->id_foto_content,
                'url' => base_url('upload/artikel/content/') . $foto->gambar_content
            );
        }

        echo json_encode($image_urls);
    }

    public function get_data_article() {
        // $id_article = 39;

        $id_article = $this->input->post('id_article');
        $article = $this->Article_model->get_article($id_article);

        echo json_encode($article);
    }

    public function fetch()
    {
        $output = '';

        $limit = $this->input->post('limit');
        $start = $this->input->post('start');
        $search = $this->input->post('search');

        $data = $this->Article_model->get_data_artikel($limit, $start, $search);

        if ($data->num_rows() > 0) {
            foreach ($data->result() as $artikel) {
                $output .= '
                <li class="row clearfix pt-1">
                    <div class="icon-box col-md-2 col-4"><img class="img-fluid img-thumbnail"
                    src="' . base_url('upload/artikel/' . $artikel->gambar) . '"alt="Gambar Artikel"></div>
                        <div class="text-box col-md-10 col-8 p-l-0 p-r0">
                            <h5 class="mb-0"><b>' . $artikel->judul_article . '</b></h5>
                            <p class="mb-1"><small>' . $artikel->meta_desc . ' </small></p>
                            <ul class="list-inline">
                                <li class="font-weight-medium badge badge-dark shadow l-parpl text-white rounded">' . $artikel->tgl_article . '</a></li>
                                <li class="pr-1"><a class=" ml-3 fa fa-google btn-sm btn-outline-info" href="" > Lihat</a></li>
                                <li class="pr-1"><a data-toggle="modal" data-target="#ubah-artikel" class=" fa fa-pencil-square btn-sm btn-outline-primary pl-1 btn-edit" href="" data-id_article="'.$artikel->id_article.'" data-judul_article="'.$artikel->judul_article.'" data-tgl_article="'.$artikel->tgl_article.'" data-meta_desc="'.$artikel->meta_desc.'" data-tags="'.$artikel->tags.'" data-gambar="'.$artikel->gambar.'"> Edit Judul</a></li>';

                                if (empty($artikel->id_content_article)) {
                                    $output .= '<li class="pr-1"><a class="fa fa-pencil-square-o btn-sm btn-outline-success btn-content" data-toggle="modal" data-target="#tambah-content" href="" data-id_article="'.$artikel->id_article.'"> Isi Konten</a></li>';
                                } else {
                                    $output .= '<li class="p-1"><a class="fa fa-pencil-square-o btn-sm btn-outline-warning btn-edit-content" data-toggle="modal" data-target="#ubah-content" href="" data-id_content="'.$artikel->id_content.'" data-id_article="'.$artikel->id_content_article.'" data-content="'.htmlspecialchars($artikel->content, ENT_QUOTES, 'UTF-8').'"> Edit Konten</a></li>
                                                <li"><a class="pl-1 fa fa-plus-circle btn-sm btn-outline-success btn-content" data-toggle="modal" data-target="#tambah-content" href="" data-id_article="'.$artikel->id_article.'" data-id_content="'.$artikel->id_content.'"> Tambah Konten</a></li>';
                                }
                        $output .= '</ul>
                        </div>
                </li>';
             }
                echo $output;
        }
    }

    function select_data_tag()
    {

        $query = $this->Article_model->get_data_tag();
        $data = "<option value=''>- Pilih Tags -</option>";
        foreach ($query as $value) {
        $data .= "<option value='".$value->tags."'>".$value->tags."</option>";
        }
        echo $data;
        echo '<option value="add tag">Add Tag</option>';
        }

    function buat_artikel()
    {
        $config['upload_path'] = "./upload/artikel";
        $config['allowed_types'] = 'gif|jpg|png';
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('image')) {
            $upload_data = $this->upload->data();
            $image = $upload_data['file_name'];
        } else {
            $image = '';
        }

        $tags = $this->input->post('tags_input') ? $this->input->post('tags_input') : $this->input->post('tags');

        $data = array(
            'judul_article' => $this->input->post('judul'),
            'tgl_article' => $this->input->post('tanggal'),
            'tags' => $tags,
            'meta_desc' => $this->input->post('meta_desc'),
            'gambar' => $image
        );

            $result = $this->Article_model->save_article($data);

        if ($result) {
        $response = array('status' => 'success', 'message' => 'Data berhasil disimpan.');
        } else {
        $response = array('status' => 'error', 'message' => 'Gagal menyimpan data.');
        }

        echo json_encode($response);
    }

    function edit_judul()
    {
        $id_article = $this->input->post('id_article');

        // Konfigurasi upload gambar baru
        $config['upload_path'] = "./upload/artikel";
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size'] = 2048;
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);

        $edit_image = '';

        // Proses upload gambar baru untuk poster
        if ($this->upload->do_upload('edit_image')) {
            $upload_data = $this->upload->data();
            $edit_image = $upload_data['file_name'];

            $this->hapus_gambar_lama($id_article, 'gambar');
        }

        // Data untuk diupdate
        $data = array(
            'id_article' => $this->input->post('id_article'),
            'judul_article' => $this->input->post('judul'),
            'tgl_article' => $this->input->post('tanggal'),
            'meta_desc' => $this->input->post('meta_desc'),
            'tags' => $this->input->post('tags'),
        );

        // var_dump($data);

        // Tambahkan gambar baru ke dalam data jika diunggah
        if ($edit_image != '') {
            $data['gambar'] = $edit_image;
        }

        // Update data
        $update_article = $this->Article_model->update_data('article', $data, $id_article);

        if ($update_article) {
            $response['status'] = true;
            $response['message'] = 'Data berhasil diperbarui.';
        } else {
            $response['status'] = false;
            $response['message'] = 'Terjadi kesalahan saat memperbarui data di database.';
        }

        echo json_encode($response);
    }

    function hapus_gambar_lama($article_id)
    {
        $article_data = $this->Article_model->get_article_data($article_id);

        if (!empty($article_data)) {
                $gambar_lama = $article_data['gambar'];

            if (!empty($gambar_lama)) {
                    $path_gambar = "./upload/artikel/" . $gambar_lama;
                if (file_exists($path_gambar)) {
                    unlink($path_gambar);
                }
            }
        }
    }

    function isi_content()
    {
        $data = array(
            'id_article' => $this->input->post('id_article'),
            'content' => $this->input->post('content_article')
        );

        $result = $this->Article_model->save_content($data);

        if ($result) {
            $response = array('status' => 'success', 'message' => 'Data berhasil disimpan.');
        } else {
            $response = array('status' => 'error', 'message' => 'Gagal menyimpan data.');
        }

        echo json_encode($response);
    }

    function edit_content()
    {
        $id_content = $this->input->post('id_content');

        // Data untuk diupdate
        $data = array(
            'id_article' => $this->input->post('id_article'),
            'content' => $this->input->post('edit_content'),
        );

        // Update data
        $update_content = $this->Article_model->update_content('content_article', $data, $id_content);

        if ($update_content) {
            $response['status'] = true;
            $response['message'] = 'Data berhasil diperbarui.';
        } else {
            $response['status'] = false;
            $response['message'] = 'Terjadi kesalahan saat memperbarui data di database.';
        }

        echo json_encode($response);
    }

    function tambah_gambar()
    {
        $config['upload_path'] = "./upload/artikel/content";
        $config['allowed_types'] = 'gif|jpg|png';
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('gambar')) {
            $upload_data = $this->upload->data();
            $image = $upload_data['file_name'];
        } else {
            $image = '';
        }

        $data = array(
            'id_content' => $this->input->post('id_content'),
            'gambar_content' => $image
        );

            $result = $this->Article_model->tambah_gambar($data);

        if ($result) {
        $response = array('status' => 'success', 'message' => 'Data berhasil disimpan.');
        } else {
        $response = array('status' => 'error', 'message' => 'Gagal menyimpan data.');
        }

        echo json_encode($response);
    }

    public function hapus_gambar() {
        $id_gambar = $this->input->post('id_gambar');

        $gambar_info = $this->Article_model->get_gambar_data($id_gambar);

        if ($gambar_info) {
            if ($gambar_info['gambar_content'] != null) {
                $gambar_file = FCPATH . 'upload/artikel/content/' . $gambar_info['gambar_content'];

                if (file_exists($gambar_file)) {
                    if (unlink($gambar_file)) {

                        $this->Article_model->hapus_gambar($id_gambar);
                        echo json_encode(array('status' => 'success', 'message' => 'Gambar berhasil dihapus.'));
                    } else {
                        echo json_encode(array('status' => 'error', 'message' => 'Gagal menghapus gambar.'));
                    }
                } else {
                    echo json_encode(array('status' => 'error', 'message' => 'File gambar tidak ditemukan.'));
                }
            } else {
                echo json_encode(array('status' => 'error', 'message' => 'Nama file gambar tidak tersedia.'));
            }
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'Data gambar tidak ditemukan.'));
        }
    }




}