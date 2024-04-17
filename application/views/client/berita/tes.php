<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Berita extends CI_Controller
{
    var $template = 'tmpt_client/index';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Article_model');

    }

public function detail_article()
    {
    $output = '';

    $tittle = $this->uri->segment(3);
    if ($tittle) {
    $judul_article = preg_replace("![^a-z0-9]+!i", " ", $tittle);
    $query = $this->db->get_where('article', array('judul_article' => $judul_article));

    if ($query->num_rows() > 0) {
    $meta_desk = '';
    foreach ($query->result() as $meta) {
    $meta_desk = $meta->meta_desc;
    }

    $limit = $this->input->post('limit');
    $start = $this->input->post('start');

    $data = $this->Article_model->get_detail_artikel($limit, $start, $judul_article);

    if ($data->num_rows() > 0) {
    foreach ($data->result() as $berita) {
    $id_article = $berita->id_article;

    $tgl_parts = explode('/', $berita->tgl_article);
    $day = $tgl_parts[0];
    $month = $tgl_parts[1];
    $year = $tgl_parts[2];

    $formatted_date = date('d F Y', mktime(0, 0, 0, $month, $day, $year));

    $data_content = $this->Article_model->get_data_content();
    $data_foto = $this->Article_model->get_foto_berita();

    $output .= '
    <div class="card single_post">
        <div class="body pb-0 pl-2 pr-2">
            <div class="img-post">
                <img class="d-block img-fluid" src="' . base_url('upload/artikel/' . $berita->gambar) . '"
                    alt="First slide">
            </div>
            <h3><a href="">' . $berita->judul_article . '</a></h3>';


            foreach ($data_content->result() as $content) {
            $id_data_article = $content->id_content;
            if ($id_article == $content->id_article) {

            $num_images = 0;

            $output .= '<div class="row">';
                $num_images = 0;
                foreach ( $data_foto->result() as $foto_content)
                if ($id_data_article = $foto_content->id_content) {
                $num_images++;
                $output .= '
                <div class="col-lg-6">
                    <div class="img-post pb-2 mb-1 pt-1 mt-1">
                        <img src="' . base_url('upload/artikel/content/' . $foto_content->gambar_content) . '"
                            class="img-content">
                    </div>
                </div>';
                }

                $output .= '
            </div>';
            if ($num_images == 1) {
            $output = str_replace('col-lg-6', 'col-lg-12', $output);
            }
            $output .= '
        </div>';
        } else {
        }
        $output .= '<p>' . $content->content . '</p>';
        }
        }

        $output .= '
    </div>
    <div class="footer pl-1 pt-1 pb-0">
        <div class="row align-items-center">
            <div class="col-md-6">
            </div>
            <div class="col-md-6 pr-0">
                <ul class="stats pt-2 mt-2">
                    <li><a href="javascript:void(0);">' . $formatted_date . '</a></li>
                </ul>
            </div>
        </div>
    </div>
    </div>';
    }
    echo $output;
    } else {
    echo "Tidak ada artikel yang ditemukan untuk judul yang diberikan.";
    }
    } else {
    echo "Judul tidak ditemukan dalam segmen URL.";
    }
    }
}