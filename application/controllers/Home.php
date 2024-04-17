<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Home extends CI_Controller
{
    public $M_home;
    var $template = 'tmpt_client/index';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_home');
        $this->load->model('Article_model');
    }
    function index()
    {
        $data['tittle']             = 'Wisdil.com';
        $data['event_data_ready']   = $this->M_home->data_event_ready();
        $data['banner']             = $this->M_home->data_banner();
        $data['content']            = 'client/home/home';
        $data['script']             = 'client/home/home_js';
        $this->load->view($this->template, $data);
    }

    // data berita
    public function berita()
    {
        $output = '';

        $limit = $this->input->post('limit');
        $start = $this->input->post('start');
        $search = $this->input->post('search');

        $data = $this->Article_model->get_data_artikel($limit, $start, $search);

        if ($data->num_rows() > 0) {
            foreach ($data->result() as $berita) {
                $tgl_parts = explode('/', $berita->tgl_article);
                $day = $tgl_parts[0];
                $month = $tgl_parts[1];
                $year = $tgl_parts[2];

                $formatted_date = date('d F Y', mktime(0, 0, 0, $month, $day, $year));

                $judul_berita = $berita->judul_article;
				$tittle_news = preg_replace("![^a-z0-9]+!i", "-", $judul_berita);

                $output .= '
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="single_post">
                                    <li class="clearfix">
                                        <a class="row add-view" href="' . base_url('Berita/page_berita/' . $tittle_news) . '" data-id_article="'.$berita->id_article.'">
                                            <div class="icon-box col-md-4 col-4"><img class="img-fluid img-thumbnail"
                                                    src="' . base_url('upload/artikel/' . $berita->gambar) . '" alt="Awesome Image">
                                            </div>
                                            <div class="text-box col-md-8 col-8 p-l-0 p-r0 text-dark">
                                                <p>' . $berita->judul_article . '</p>
                                            </div>
                                        </a>
                                        <div class="footer col-12 pb-0">
                                            <ul class="stats">
                                                <li></li>
                                                <li><a href="javascript:void(0);">' . $formatted_date . '</a></li>
                                                <li><a href="javascript:void(0);" class="fas fa-eye"></a> ' . $berita->views . '</li>
                                            </ul>
                                        </div>
                                    </li>
                                </div>
                            </div>';

            }
            echo $output;
        }
    }



}