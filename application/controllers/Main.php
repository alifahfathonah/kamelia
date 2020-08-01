<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('date');
        $this->load->model("artikel_model");
    }

    public function index()
    {

        $this->load->view("main/index.php");
    }

    public function calendar()
    {
        // menampilkan halaman index di depan
        $data['defaultDate'] = mdate("%Y-%m-%d");
        $this->load->view("main/calendar.php", $data);
    }

    public function artikel()
    {
        $artikel = $this->artikel_model;

        //konfigurasi pagination
        $this->load->library('pagination');
        $per_page = 6;
        $page = (isset($_GET['page'])) ? $_GET['page'] : 0;
        $this->pagination->initialize($this->configPagination($per_page));

        // $start = $page * $per_page;
        // print_r($start); die();

        $data['pagination'] = $this->pagination->create_links();
        $data['artikel']    = $artikel->allPagination($per_page, $page);

        $this->load->view("main/artikel.php", $data);
    }

    private function configPagination($per_page)
    {
        $config['base_url']             = site_url('/artikel');
        $config['total_rows']           = count($this->artikel_model->all()); //total row
        $config['per_page']             = $per_page; //show record per halaman
        $choice                         = $config["total_rows"] / $config["per_page"];
        $config["num_links"]            = floor($choice);
        $config['page_query_string']    = true;
        // $config['use_page_numbers']     = true;
        $config['query_string_segment'] = 'page';
        // $config["uri_segment"]          = 2; // uri parameter

        // Membuat Style pagination untuk BootStrap v4
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';

        return $config;
    }

    public function artikelSingle($slug)
    {
        $artikel         = $this->artikel_model;
        $data["artikel"] = $artikel->getBySlug($slug);
        $this->load->view("main/singleartikel.php", $data);
    }
}
