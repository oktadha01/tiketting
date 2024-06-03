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

    public function index()
    {

        $data['tittle']             = 'Detail Berita ';
        $data['event_data_ready']   = $this->Article_model->data_event_ready();
        $data['bread']              = 'Detail Berita';
        $data['content']            = 'client/berita/berita';
        $data['script']             = 'client/berita/berita_js';
        $this->load->view($this->template, $data);
    }

    public function detail_berita()
    {

        $data['tittle']         = 'Detail Berita ';
        $data['bread']          = 'Detail Berita';
        $data['content']        = 'client/berita/detail_berita';
        $data['script']         = 'client/berita/berita_js';
        $this->load->view($this->template, $data);
    }

    // data article
    public function berita_article()
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
                        <div class="card single_post">
                            <div class="body pb-0 pl-1 pr-1">
                                <div class="img-post">
                                    <img class="d-block img-fluid"
                                        src="' . base_url('upload/artikel/' . $berita->gambar) . '"
                                        alt="First slide">
                                </div>
                                <h3><a href="">' . $berita->judul_article . '</a></h3>
                            </div>
                            <div class="footer pl-1 pt-1 pb-0">
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <div class="actions">
                                        <a href="' . base_url('Berita/page_berita/') . $tittle_news . '" data-id_article="'.$berita->id_article.'" class="btn btn-outline-warning add-view">Lanjut Baca</a>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <ul class="stats pt-2 mt-2">
                                            <li><a href="javascript:void(0);">' . $formatted_date . '</a></li>
                                            <li><a href="javascript:void(0);" class="fas fa-eye"></a> ' . $berita->views . '</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </div>';

            }
            echo $output;
        }
    }

    public function popular_post()
    {
        $output = '';

        $limit = $this->input->post('limit');
        $start = $this->input->post('start');

        $data = $this->Article_model->get_popular_post($limit, $start);

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
                        <div class="single_post">
                            <div class="img-post mb-1">
                                <img src="' . base_url('upload/artikel/' . $berita->gambar) . '" alt="Awesome Image">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <small>' . $formatted_date . '</small>
                                    </div>
                                    <div class="col-lg-6 text-right">
                                        <small class="view-count">' . $berita->views . ' Views</small>
                                    </div>
                                </div>
                            </div>
                            <a href="' . base_url('Berita/page_berita/' . $tittle_news) . '" data-id_article="'.$berita->id_article.'" class="add-view">
                                <p class="mb-0 mt-0 pb-3 text-dark">' . $berita->judul_article . '</p>
                            </a>
                        </div>';
            }
            echo $output;
        }
    }

    public function data_tags()
    {
        $output = '';

        $limit = $this->input->post('limit');
        $start = $this->input->post('start');

        $data = $this->Article_model->get_tags($limit, $start);

        if ($data->num_rows() > 0) {
            foreach ($data->result() as $berita) {
                $tags = preg_replace("![^a-z0-9]+!i", "-", $berita->tags);

                $output .= '<a href="' . base_url('Berita/tags_berita/' . $tags) . '" class=" btn btn-warning btn-custom mr-2"><i class="text-light"></i> '. $berita->tags .'</a>';
            }
        echo $output;
        }
    }

    public function more_berita()
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
                <div class="col-lg-6 col-md-6 pl-2 pr-2">
                    <div class="single_post">
                        <li class="clearfix">
                            <a href="' . base_url('Berita/page_berita/' . $tittle_news) . '" data-id_article="'.$berita->id_article.'" class="row add-view">
                                <div class="icon-box col-md-4 col-4"><img class="img-fluid img-thumbnail"
                                        src="' . base_url('upload/artikel/' . $berita->gambar) . '" alt="Awesome Image">
                                </div>
                                <div class="text-box col-md-8 col-8 p-l-0 p-r0 text-dark">
                                    <p>' . $berita->judul_article . '</p>
                                </div>
                            </a>
                            <div class="footer col-12 pb-0 pr-0 pt-1">
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

    function page_berita()
	{
		$tittle = $this->uri->segment(3);
		$judul_article = preg_replace("![^a-z0-9]+!i", " ", $tittle);

		$sql = "SELECT * FROM article WHERE judul_article ='$judul_article'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $meta) {
			$meta_desk = $meta->meta_desc;
			}
		}

		$data['tittle'] = $judul_article;
		$data['description'] = 'Wisdil ' . $judul_article . ' - ' . $meta_desk;
        $data['content']            = 'client/berita/detail_berita';
        $data['script']             = 'client/berita/berita_js';
        $this->load->view($this->template, $data);
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

                        $output .= '<div class="row">
                                        <div class="col-12">
                                            <div class="single_post mb-0 pb-0">
                                                <div class="img-post mb-0 pb-0">
                                                    <img class="img-fluid mb-0 pb-0" src="' . base_url('upload/artikel/' . $berita->gambar) . '" class="img-fluid border-radius img-berita" alt="First slide">
                                                </div>
                                            </div>
                                            <div class= single_post>
                                                <div class="footer pl-0 pt-0 pb-0">
                                                    <div class="row align-items-center">
                                                        <div class="col-md-6"></div>
                                                        <div class="col-md-6 pr-0">
                                                            <ul class="stats pt-0 mt-0">
                                                                <li><a href="javascript:void(0);">' . $formatted_date . '</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <h3 style="font-family: auto;">' . $berita->judul_article . '</h3>';

                                            foreach ($data_content->result() as $content) {
                                                $id_data_article = $content->id_content;
                                                if ($id_article == $content->id_article) {

                                                    $num_images = 0;
                                                    $content_images = '';

                                                    $output .= '<div class="row mr-1 ml-1 pt-0">';
                                                    foreach ($data_foto->result() as $foto_content) {
                                                        if ($id_data_article == $foto_content->id_content) {
                                                            $num_images++;
                                                            $content_images .= '<div class="col-lg-6">
                                                                                    <div class="img-post pb-2 mb-1 pt-1 mt-1">
                                                                                        <img src="' . base_url('upload/artikel/content/' . $foto_content->gambar_content) . '" class="img-content">
                                                                                    </div>
                                                                                </div>';
                                                        }
                                                    }

                                                    if ($num_images == 1) {
                                                        $content_images = str_replace('col-lg-6', 'col-lg-12', $content_images);
                                                    }
                                                    $output .= '<div class="row">' . $content_images . '</div>';

                                                    $output .= '</div>
                                                                <p>' . $content->content . '</p>';
                                                }
                                            }

                        $output .= '</div>
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

    public function tags_berita()
    {
        $tag = $this->uri->segment(3);
		$tag_berita = preg_replace("![^a-z0-9]+!i", " ", $tag);

        $data['tittle']         = 'Tags Berita ';
        $data['content']        = 'client/berita/tags_berita';
        $data['script']         = 'client/berita/berita_js';
        $this->load->view($this->template, $data);
    }

    public function get_data_tags()
    {
        $output = '';

        $tags = $this->uri->segment(3);
        if ($tags) {

            $tags_article = preg_replace("![^a-z0-9]+!i", " ", $tags);
            $query = $this->db->get_where('article', array('tags' => $tags_article));

                // Ambil data dari model
                $limit = $this->input->post('limit');
                $start = $this->input->post('start');

                $data = $this->Article_model->get_tags_artikel($limit, $start, $tags_article);

                if ($data->num_rows() > 0) {
                    foreach ($data->result() as $berita) {
                        // Format tanggal
                        $formatted_date = date('d F Y', strtotime($berita->tgl_article));
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
                                    <div class="footer col-12 pb-0 pr-0 pt-2">
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
        } else {
            echo "Tags tidak ditemukan dalam segmen URL.";
        }
    }

    public function add_views()
    {
        $id_article = $this->input->post('id_article');
        // $id_article = 39;

        $sql = "SELECT * FROM article WHERE id_article = ?";
        $query = $this->db->query($sql, array($id_article));
        if ($query->num_rows() > 0) {
            $data_view = $query->row();
            $add_view = $data_view->views + 1;

            $update_view = $this->db->set('views', $add_view)
                ->where('id_article', $id_article)
                ->update('article');

            if ($update_view) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('success' => false));
            }
        } else {
            echo json_encode(array('success' => false));
        }
        die();
    }

}